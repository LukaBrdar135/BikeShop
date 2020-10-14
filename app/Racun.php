<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Racun extends Model
{
    //
    public function StavkeRacuna(){
        return $this->hasMany(StavkaRacuna::class);
    }
}
