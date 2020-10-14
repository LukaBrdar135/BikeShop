<?php

namespace App\Http\Controllers;

use App\BiciklSpec;
use App\Http\Controllers\Controller;
use App\Korpa;
use App\Proizvod;
use App\ProizvodUKorpi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }//index()

    public function sviProizvodi(){
        $proizvodi = Proizvod::all();
        return view('admin.sviProizvodi', compact('proizvodi'));
    }//sviProizvodi()

    public function azurirajProizvod($proizvodId)
    {
        $proizvod= Proizvod::find($proizvodId);
        return view('admin.azurirajProizvod',compact('proizvod'));
    }//azurirajProizvod()

    public function azurirajProizvodPost(Request $request)
    {
        $request->validate([
            'brend'=>'required|max:255',
            'kategorija'=>'required|max:255',
            'potkategorija'=>'required|max:255',
            'cena'=>'required|max:255',
            'opis'=>'required|max:65535',
            'slika'=>'nullable|mimes:jpg,jpeg,png',
        ]);

        $proizvod = Proizvod::find($request->input('id'));
        if($proizvod->naziv!=$request->input('naziv'))
        {   
            $request->validate([
            'naziv' => 'required|unique:proizvods|max:255',
            ]);
        }
        dodajProizvod($proizvod,$request);

        $proizvod->save();
        return redirect(action('AdminController@sviProizvodi'));
    }//azurirajProizvodPost()

    public function azurirajProizvodSpec($proizvodId)
    {
        $proizvod= Proizvod::find($proizvodId);
        $spec= $proizvod->biciklSpec();
        return view('admin.azurirajProizvodSpec',compact('proizvod','spec'));
    }//azurirajProizvodSpec()

    public function azurirajProizvodSpecPost(Request $request)
    {
        $spec= BiciklSpec::find($request->input('id'));
        $proizvod = Proizvod::find($spec->proizvod_id);
        validirajSpec($request); 
        dodajSpec($proizvod,$spec,$request);
        $spec->save();

        return redirect(action('AdminController@sviProizvodi'));
    }//azurirajProizvodSpecPost()

    public function dodajProizvod()
    {
        return view('admin.dodajProizvod');
    }//dodajProizvod()

    public function dodajProizvodPost(Request $request)
    {
        validirajProizvod($request);
        
        $proizvod=new Proizvod;
        dodajProizvod($proizvod,$request);
        
        if($proizvod->kategorija=="bicikli"){
            validirajSpec($request);
            $proizvod->save();
            $spec = new BiciklSpec;
            dodajSpec($proizvod,$spec,$request);
            $spec->save();
        }
        else{
            $proizvod->save();
        }          
        
        return redirect(action('AdminController@sviProizvodi'));
    }//dodajProizvodPost()


    public function obrisiProizvod($id)
    {
        $proizvod=Proizvod::find($id);
        $korpe = Korpa::all();
        if(!$proizvod->kategorija=="bicikli"){
            unlink(storage_path($proizvod->slika));
            foreach($korpe as $korpa){
                if($korpa->totalnaKolicina>0){
                    foreach($korpa->ProizvodiUKorpi as $p){
                        if($p->proizvod_id == $id){
                            $proizvodUkorpi= ProizvodUKorpi::where('proizvod_id','=',$id)->first();
                            $korpa->totalnaKolicina-=$proizvodUkorpi->kolicina;
                            $korpa->totalnaKolicina-=$proizvod->cena * $proizvodUkorpi->kolicina;
                            dd($proizvodUkorpi);
                            $proizvodUkorpi->delete();
                            $korpa->save();
                        }
                    }
                }
            }
            $proizvod->delete();
        }
        else{
            $spec= BiciklSpec::where('proizvod_id','=',$proizvod->id);
            $spec->delete();
            unlink(storage_path($proizvod->slika));
            foreach($korpe as $korpa){
                if($korpa->totalnaKolicina>0){
                    foreach($korpa->ProizvodiUKorpi as $p){
                        if($p->proizvod_id == $id){
                            $proizvodUkorpi= ProizvodUKorpi::where('proizvod_id','=',$id)->first();
                            $korpa->totalnaKolicina-=$proizvodUkorpi->kolicina;
                            $korpa->totalnaCena-=$proizvod->cena * $proizvodUkorpi->kolicina;
                            $proizvodUkorpi->delete();
                            $korpa->save();
                        }
                    }
                }
            }
            $proizvod->delete();
        }

        return redirect(action('AdminController@sviProizvodi'));
    }//obrisiProizvodPost();

}//controller


//Reusable functions
function validirajProizvod($request){
    return $request->validate([
         'naziv' => 'required|unique:proizvods|max:255',
         'brend'=>'required|max:255',
         'kategorija'=>'required|max:255',
         'potkategorija'=>'required|max:255',
         'cena'=>'required|max:255',
         'opis'=>'required|max:65535',
         'slika'=>'required|mimes:jpg,jpeg,png',
     ]);
}

function validirajSpec($request){
    return $request->validate([
        'ram' => 'required|max:255',
        'boja'=>'required|max:255',
        'viljuska'=>'required|max:255',
        'zadnjiAmort'=>'required|max:255',
        'kocnice'=>'required|max:255',
        'menjacZadnji'=>'required|max:255',
        'menjacPrednji'=>'required|max:255',
    ]);
}

function dodajProizvod($proizvod,$request){
    $proizvod->naziv= $request->input('naziv');
    $proizvod->brend= $request->input('brend');
    $proizvod->kategorija= strtolower($request->input('kategorija'));
    $proizvod->potkategorija= strtolower($request->input('potkategorija'));
    $proizvod->opis= $request->input('opis');
    $proizvod->cena= $request->input('cena');
    if($request->hasFile('slika'))
        $proizvod->slika = "app/". $request->file('slika')->store('/public/images/proizvodi');

    return $proizvod;
}

function dodajSpec($proizvod,$spec,$request){
    $spec->ram= $request->input('ram');
    $spec->boja= $request->input('boja');
    $spec->viljuska= $request->input('viljuska');
    $spec->zadnjiAmortizer= $request->input('zadnjiAmort');
    $spec->kocnice= $request->input('kocnice');
    $spec->menjacZadnji= $request->input('menjacZadnji');
    $spec->menjacPrednji= $request->input('menjacPrednji');
    $spec->proizvod_id= $proizvod->id;

    return $spec;
}
        