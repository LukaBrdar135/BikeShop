<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StavkaRacuna extends Model
{
    //

    public $timestamps = false;
    
    public function racun()
    {
        return $this->belongsTo(Racun::class);
    }
}
