<?php

namespace App\Http\Controllers;

use App\Racun;
use App\Reklamacija;
use Illuminate\Http\Request;

class ReklamacijaController extends Controller
{
    public function index(){
        return view('reklamacije.reklamacija');
    }

    public function reklamacijaPost(Request $request){
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'ime'=>'required|max:255',
            'prezime'=>'required|max:255',
            'proizvodi'=>'required|max:255',
            'id_racuna'=>'required|max:255',
            'poruka'=>'required|max:65535',
        ]);

        $racun =Racun::find($request->input('id_racuna'));
        if($racun == null){
            return redirect()->back()->with('greska', 'Kod racuna koji ste uneli ne postoji!');
        }else
        if($racun->ime != $request->input('ime') || $racun->prezime !=  $request->input('prezime')){
            return redirect()->back()->with('greska', 'Ime i prezime koje ste uneli ne odgovaraju racunu!');
        }else{
            $reklamacija = new Reklamacija;
            $reklamacija->email = $request->input('email');
            $reklamacija->ime = $request->input('ime');
            $reklamacija->prezime = $request->input('prezime');
            $reklamacija->id_racuna = $request->input('id_racuna');
            $reklamacija->proizvodi = $request->input('proizvodi');
            $reklamacija->poruka = $request->input('poruka');
            $reklamacija->pregledana = false;
            $reklamacija->save();

            return redirect()->back()->with('uspeh', 'Vasa poruka je uspesno poslata! Odgovor ce Vam biti poslan na e-mail adresu.');
        }
    }
}
