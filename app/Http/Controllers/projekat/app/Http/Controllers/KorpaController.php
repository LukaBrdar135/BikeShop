<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Korpa;
use App\KorpaSession;
use App\Proizvod;
use App\ProizvodUKorpi;
use Illuminate\Contracts\Session\Session as SessionSession;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KorpaController extends Controller
{
    public function dodajUKorpu($id)
    {
        $proizvod= Proizvod::find($id);

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
        return redirect()->action('KorpaController@korpa');
    }//dodajUKorpu()


    public function korpa()
    {
        if (!Auth::check()) {
            $korpaSession = Session::has('korpa') ? Session::get('korpa') : null;
            $korpa= null;

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
        

        return redirect()->action('KorpaController@korpa');
    }//smanjiKolicinu()

    public function izbaciIzKorpe($id)
    {
         $proizvod = Proizvod::find($id);

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
        

        return redirect()->action('KorpaController@korpa');
    }//obrisiIzKorpe()
}