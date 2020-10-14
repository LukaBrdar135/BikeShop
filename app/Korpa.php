<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Korpa extends Model
{
    //
    public $timestamps = false;

    public function ProizvodiUKorpi(){
        return $this->hasMany(ProizvodUKorpi::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
