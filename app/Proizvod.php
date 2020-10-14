<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proizvod extends Model
{
    //
    public $timestamps = false;


    public function biciklSpec(){
        return $this->hasOne(BiciklSpec::class);
    }
}
