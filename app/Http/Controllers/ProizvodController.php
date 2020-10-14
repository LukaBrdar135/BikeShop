<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\KorpaSession;
use App\Proizvod;
use Illuminate\Contracts\Session\Session as SessionSession;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProizvodController extends Controller
{
    public function index()
    {
        $proizvods = Proizvod::all();
        $brendovi= Proizvod::distinct()->get('brend');
        return view('proizvodi', compact('proizvods','brendovi'));
    }//index()


    public function sviPoKategoriji($kategorija)
    {
        $proizvods = Proizvod::where('kategorija','=',$kategorija)->get();
        $potkategorije= Proizvod::where('kategorija','=',$kategorija)->distinct()->get('potkategorija');
        $brendovi=  Proizvod::where('kategorija','=',$kategorija)->distinct()->get('brend');
        $kategorijaProizvoda = $kategorija;

        if($proizvods->count()<1){
            return abort('404');
        }


        return view('proizvodi.sviPoKategoriji', compact('potkategorije','proizvods','kategorijaProizvoda','brendovi'));
    }//sviPoKategoriji()


    public function sviPoPotkategoriji($kategorija,$potkategorija)
    {
        $proizvods = Proizvod::where('kategorija','=',$kategorija)->where('potkategorija','=', $potkategorija)->get();
        $brendovi=  Proizvod::where('kategorija','=',$kategorija, 'and', 'potkategorija','=', $potkategorija)->distinct()->get('brend');
        $potkategorijaProizvoda = $potkategorija;
        $kategorijaProizvoda = $kategorija;
        if($proizvods->count()<1){
            return abort('404');
        }

        return view('proizvodi.sviPoPotkategoriji', compact('proizvods','brendovi','potkategorijaProizvoda','kategorijaProizvoda'));
    }//sviPoPotkategoriji()


    public function sviPoBrendu($brend)
    {
        $proizvods = Proizvod::where('brend','=',$brend)->get();
        $brendovi=  Proizvod::distinct()->get('brend');

        if($proizvods->count()<1){
            return abort('404');
        }

        $activeBrend = $brend;

        return view('proizvodi.sviPoBrendu',compact('proizvods','brendovi','activeBrend'));
    }//sviPoBrendu()

    public function potkategorijaPoBrendu($kategorija,$potkategorija,$brend)
    {
        $proizvods = Proizvod::where('kategorija','=',$kategorija)->where('potkategorija','=', $potkategorija)->where('brend','=', $brend)->get();
        $brendovi=  Proizvod::where('kategorija','=',$kategorija)->where('potkategorija','=', $potkategorija)->distinct()->orderBy('brend', 'asc')->get('brend');
        $potkategorijaProizvoda = $potkategorija;
        $activeBrend = $brend;
        $kategorijaProizvoda = $kategorija;
        if($proizvods->count()<1){
            return abort('404');
        }

        return view('proizvodi.potkategorijaPoBrendu',compact('proizvods','brendovi','kategorijaProizvoda','potkategorijaProizvoda','activeBrend'));
    }//potkategorijaPoBrendu


    public function kategorijaPoBrendu($kategorija,$brend)
    {
        $proizvods = Proizvod::where('kategorija','=',$kategorija)->where('brend','=', $brend)->get();
        $brendovi=  Proizvod::where('kategorija','=',$kategorija)->distinct()->get('brend');
        $activeBrend = $brend;
        $kategorijaProizvoda = $kategorija;

        if($proizvods->count()<1){
            return abort('404');
        }

        return view('proizvodi.kategorijaPoBrendu',compact('proizvods','brendovi','kategorijaProizvoda','activeBrend'));
    }//kategorijaPoBrendu()


    public function rezultatPretrage(Request $request)
    {
        $pretraga= $request->input('pretraga');
        $proizvods = Proizvod::where('naziv','like','%'.$pretraga.'%')->get();

        return view('proizvodi.rezultatPretrage', compact('proizvods','pretraga'));
    }//rezultatPretrage()


    public function detaljiProizvoda($proizvodId)
    {   
        $proizvod = Proizvod::find($proizvodId);
        if($proizvod){
            return view('proizvodi.detaljiProizvoda', compact('proizvod'));
        }

        return redirect()->action('ProizvodController@index');
    }//detaljiProizvoda()
}