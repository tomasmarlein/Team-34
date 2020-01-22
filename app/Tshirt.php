<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    public function gebruikertshirt()
    {
        return $this->hasMany('App\Gebruikers');
    }
}
