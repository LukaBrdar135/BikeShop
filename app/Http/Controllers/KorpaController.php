<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Korpa;
use App\KorpaSession;
use App\Proizvod;
use App\ProizvodUKorpi;
use App\Racun;
use App\StavkaRacuna;
use Illuminate\Contracts\Session\Session as SessionSession;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\Zahvalnica;
use Illuminate\Support\Facades\Mail;

class KorpaController extends Controller
{
    public function dodajUKorpu($id)
    {
        $proizvod= Proizvod::find($id);
        
        if($proizvod != null){
            if (!Auth::check()) {
                $korpa = Session::has('korpa') ? Session::get('korpa') : new KorpaSession();
                $korpa->dodajUKopru($proizvod);
                Session::put('korpa', $korpa);
            }
            else{
                $korpa = Korpa::where('user_id','=',Auth::id())->first();
                if(!$korpa){
                    $korpa = new Korpa;
                    $korpa->totalnaKolicina=0;
                    $korpa->totalnaCena=0;
                    $korpa->user_id = Auth::id();
                }
                $korpa->totalnaKolicina++;
                $korpa->totalnaCena+=$proizvod->cena;
                $korpa->save();
                
    
                
                $proizvodUKorpi = ProizvodUKorpi::where('proizvod_id','=',$id)->where('korpa_id','=',$korpa->id)->first();
                if(!$proizvodUKorpi){
                    $proizvodUKorpi= new ProizvodUKorpi;
                    $proizvodUKorpi->proizvod_id=$id;
                    $proizvodUKorpi->korpa_id=$korpa->id;
                    $proizvodUKorpi->kolicina=1;
                }
                else{
                    $proizvodUKorpi->kolicina++;
                }
    
                $proizvodUKorpi->save();
            }
        }
            return redirect()->action('KorpaController@korpa');
        
    }//dodajUKorpu()


    public function korpa()
    {
        if (!Auth::check()) {
            $korpaSession = Session::has('korpa') ? Session::get('korpa') : null;
            $korpa= null;
            if($korpaSession){
                foreach($korpaSession->proizvodi as $proizvod){
                    $p = Proizvod::where('id','=',$proizvod['proizvod']['id'])->first();
                    if($p==null){
                        $korpaSession->izbaciObrisanProizvod($proizvod['proizvod']['id']);
                    }
                }
               Session::put('korpa',$korpaSession);
            }

            return view('korpa', compact('korpaSession','korpa'));
        }
        else{
            $korpa = Korpa::where('user_id','=',Auth::id())->first();
            
            $korpaSession= null;
            

            return view('korpa', compact('korpa','korpaSession'));
        }
    }//korpa()

    public function smanjiKolicinu($id)
    {
        $proizvod = Proizvod::find($id);

        if($proizvod != null){
            if (!Auth::check()) {
                $korpa = Session::get('korpa');
                $korpa->smanjiKolicinu($proizvod);
                Session::put('korpa',$korpa);
            }
            else{
                $korpa = Korpa::where('user_id','=',Auth::id())->first();
                $proizvodUKorpi = ProizvodUKorpi::where('proizvod_id','=',$id)->where('korpa_id','=',$korpa->id)->first();
                if($proizvodUKorpi->kolicina>1){
                    $proizvodUKorpi->kolicina--;
                    $korpa->totalnaKolicina--;
                    $korpa->totalnaCena-=$proizvod->cena;
                }
                $korpa->save();
                $proizvodUKorpi->save();
            }
        }
        
        

        return redirect()->action('KorpaController@korpa');
    }//smanjiKolicinu()

    public function izbaciIzKorpe($id)
    {
         $proizvod = Proizvod::find($id);

        if($proizvod != null){
            if (!Auth::check()) {
                $korpa = Session::get('korpa');
                $korpa->izbaci($proizvod);
                Session::put('korpa',$korpa);
            }
            else{
                $korpa = Korpa::where('user_id','=',Auth::id())->first();
                $proizvodUKorpi= ProizvodUKorpi::where('proizvod_id','=',$id)->where('korpa_id','=',$korpa->id)->first();
                $korpa->totalnaKolicina-=$proizvodUKorpi->kolicina;
                $korpa->totalnaCena-=$proizvod->cena * $proizvodUKorpi->kolicina;
                $proizvodUKorpi->delete();
                $korpa->save();
            }
        }   
        
        return redirect()->action('KorpaController@korpa');
    }//obrisiIzKorpe()


    public function naplata(){
        if (!Auth::check()) {
            $korpaSession = Session::has('korpa') ? Session::get('korpa') : null;
            $korpa= null;
            if($korpaSession){
                foreach($korpaSession->proizvodi as $proizvod){
                    $p = Proizvod::where('id','=',$proizvod['proizvod']['id'])->first();
                    if($p==null){
                        $korpaSession->izbaciObrisanProizvod($proizvod['proizvod']['id']);
                    }
                }
               Session::put('korpa',$korpaSession);
            }
        }
        else{
            $korpa = Korpa::where('user_id','=',Auth::id())->first();
            
            $korpaSession= null;
        }

        return view('korpa.naplata', compact('korpa','korpaSession'));
    }//naplata()

    public function naplataPost(Request $request){
        $request->validate([
            'email' => 'required|max:255',
            'ime'=>'required|max:255',
            'prezime'=>'required|max:255',
            'brojKartice'=>'required|max:255',
            'vaziMesec'=>'required|max:255',
            'vaziGodina'=>'required|max:255',
            'cvv'=>'required|max:255',
            'adresa'=> 'required|max:255',
        ]);

        if(Auth::check()){
            $korpa = Korpa::where('user_id','=',Auth::id())->first();
            $racun = new Racun;
            $racun->vrednost= $korpa->totalnaCena;
            $racun->kolicina= $korpa->totalnaKolicina;
            $racun->ime= $request->input('ime');
            $racun->prezime= $request->input('prezime');
            $racun->email= $request->input('email');
            $racun->save();

            foreach($korpa->proizvodiUKorpi as $proizvod){
                $stavkaRacuna= new StavkaRacuna;
                $stavkaRacuna->naziv= $proizvod->proizvod['naziv'];
                $stavkaRacuna->cena =$proizvod->proizvod['cena'] * $proizvod->kolicina;
                $stavkaRacuna->kolicina= $proizvod->kolicina;
                $stavkaRacuna->racun_id= $racun->id;
                $stavkaRacuna->save();
            }

            foreach($korpa->proizvodiUKorpi as $proizvod){
                $korpa = Korpa::where('user_id','=',Auth::id())->first();
                $proizvodUKorpi= ProizvodUKorpi::where('proizvod_id','=',$proizvod->proizvod['id'])->where('korpa_id','=',$korpa->id)->first();
                $korpa->totalnaKolicina-=$proizvodUKorpi->kolicina;
                $korpa->totalnaCena-=$proizvod->cena * $proizvodUKorpi->kolicina;
                $proizvodUKorpi->delete();
                $korpa->delete();
            }
        }
        else{
            $korpa = Session::get('korpa');
            $racun = new Racun;
            $racun->vrednost= $korpa->totalCena;
            $racun->kolicina= $korpa->totalKolicina;
            $racun->ime= $request->input('ime');
            $racun->prezime= $request->input('prezime');
            $racun->email= $request->input('email');
            $racun->save();

            foreach($korpa->proizvodi as $proizvod){
                $stavkaRacuna= new StavkaRacuna;
                $stavkaRacuna->naziv= $proizvod['proizvod']['naziv'];
                $stavkaRacuna->cena =$proizvod['proizvod']['cena'] * $proizvod['kolicina'];
                $stavkaRacuna->kolicina= $proizvod['kolicina'];
                $stavkaRacuna->racun_id= $racun->id;
                $stavkaRacuna->save();
            }

            Session::forget('korpa');
        }

        Mail::to($racun->email)->send(new Zahvalnica($racun));

        return redirect()->action('ProizvodController@index')->with('uspeh',"Vasa narudzbina je uspesna! Pogledajte email za kod racuna.");
    }//naplataPost()
    
}