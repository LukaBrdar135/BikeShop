<?php

namespace App;


class KorpaSession
{
  public $proizvodi;
  public $totalCena=0;
  public $totalKolicina=0;

 public function dodajUKopru($proizvod)
 {
     $postojeciProizvod= ["kolicina"=> 0, "proizvod"=>$proizvod];
     if($this->proizvodi){
         if(array_key_exists($proizvod->id, $this->proizvodi)){
            $postojeciProizvod = $this->proizvodi[$proizvod->id];
         }
     }
     $postojeciProizvod["kolicina"]++;
     $this->proizvodi[$proizvod->id]= $postojeciProizvod;
     $this->totalKolicina++;
     $this->totalCena += $proizvod->cena;
 }

 function smanjiKolicinu($proizvod)
 {
        $postojeciProizvod = $this->proizvodi[$proizvod->id];
        if($postojeciProizvod["kolicina"]>1){
        $postojeciProizvod["kolicina"]--;
        $this->proizvodi[$proizvod->id]= $postojeciProizvod;
        $this->totalKolicina--;
        $this->totalCena -= $proizvod->cena;
        }
 }

 function izbaci($proizvod)
 {
    $postojeciProizvod = $this->proizvodi[$proizvod->id];
    $this->totalKolicina-=$postojeciProizvod["kolicina"];
    $this->totalCena -= $proizvod->cena * $postojeciProizvod["kolicina"] ;
    unset($this->proizvodi[$proizvod->id]);
 }
}

