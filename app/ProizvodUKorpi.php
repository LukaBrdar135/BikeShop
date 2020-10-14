<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProizvodUKorpi extends Model
{
    //
    public $timestamps = false;

    public function korpa(){
        return $this->belongsTo(Korpa::class);
    }

    public function proizvod(){
        return $this->belongsTo(Proizvod::class);
    }
}
