<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tijdsregistratie extends Model
{
    public function gebruikerstijd()
    {
        return $this->hasOne('App\Gebruikers');
    }
}
