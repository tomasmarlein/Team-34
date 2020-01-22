<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gebruikers extends Model
{


    public function tshirt()
    {
        return $this->belongsTo('App\Tshirt')->withDefault();
    }

    public function rol()
    {
        return $this->hasOne('App\Rol');
    }

    public function persoon()
    {
        return $this->hasOne('App\Verenigings');
    }

    public function lid()
    {
        return $this->hasMany('App\LidVan');
    }

    public function tijd()
    {
        return $this->hasMany('App\Tijdsregistratie');
    }


}
