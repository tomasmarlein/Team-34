<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    public function bebruikerrol()
    {
        return $this->hasMany('App\Gebruikers');
    }
}
