<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiciklSpec extends Model
{
    //

    public $timestamps = false;

    public function proizvod()
    {
        return $this->belongsTo(Proizvod::class);
    }
}
