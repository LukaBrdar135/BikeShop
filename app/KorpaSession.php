<?php

namespace App;


class KorpaSession
{
  public $proizvodi;
  public $totalCena=0;
  public $totalKolicina=0;

 public function dodajUKopru($proizvod)
 {
     $postojeciProizvod= ["kolicina"=> 0, "proizvod"=>$proizvod, "cena"=>0];
     if($this->proizvodi){
         if(array_key_exists($proizvod->id, $this->proizvodi)){
            $postojeciProizvod = $this->proizvodi[$proizvod->id];
         }
     }
     $postojeciProizvod["kolicina"]++;
     $postojeciProizvod["cena"]=$proizvod->cena;
     $this->proizvodi[$proizvod->id]= $postojeciProizvod;
     $this->totalKolicina++;
     $this->totalCena += $proizvod->cena;
 }//dodajUKorpu

 function smanjiKolicinu($proizvod)
 {
   $postojeciProizvod = $this->proizvodi[$proizvod->id];

   if($postojeciProizvod["kolicina"]>1){
        $postojeciProizvod["kolicina"]--;
        $this->proizvodi[$proizvod->id]= $postojeciProizvod;
        $this->totalKolicina--;
        $this->totalCena -= $proizvod->cena;
   }
 }//smanjiKolicinu()

 function izbaci($proizvod)
 {
    $postojeciProizvod = $this->proizvodi[$proizvod->id];
    $this->totalKolicina-=$postojeciProizvod["kolicina"];
    $this->totalCena -= $proizvod->cena * $postojeciProizvod["kolicina"] ;
    unset($this->proizvodi[$proizvod->id]);
 }//izbaci()

function izbaciObrisanProizvod($proizvod)
 {
    $postojeciProizvod = $this->proizvodi[$proizvod];

    if($this->totalKolicina>$postojeciProizvod["kolicina"]){
    $this->totalKolicina-=$postojeciProizvod["kolicina"];
    $this->totalCena -= ($postojeciProizvod["cena"] * $postojeciProizvod["kolicina"]);
    }
    else{
       $this->totalCena=0;
       $this->totalKolicina=0;
    }
    unset($this->proizvodi[$proizvod]);
 }//izbaciObrisanProizvod()
}

