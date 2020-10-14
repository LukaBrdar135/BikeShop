<?php

namespace App\Http\Controllers;

use App\Racun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RacunController extends Controller
{
   public function pregledStarihRacuna(){
       if(Auth::check()){
        $racuni = Racun::where("email","=", Auth::user()->email)->get();
        
        return view('racuni.stariRacuni', compact('racuni'));
       }
       else{
        return view('racuni.nemaProfil');
       }
    }//pregledStarihRacuna()

    public function detaljiRacuna($id){
        if(Auth::check()){
            $racun = Racun::where('email','=',Auth::user()->email)->where('id','=',$id)->first();
            if($racun!=null){
                $stavkeRacuna= $racun->StavkeRacuna;
                return view('racuni.detaljiRacuna', compact('racun','stavkeRacuna'));
            }
            else{
                return abort('404');   
            }   
        }
        else{
            return abort('404');
        }
    }
}
