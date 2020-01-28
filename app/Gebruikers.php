<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gebruikers extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function tshirt()
    {
        return $this->belongsTo('App\Tshirt')->withDefault();
    }

    public function rol()
    {
        return $this->hasOne('App\Rol');
    }

    public function lid()
    {
        return $this->belongsToMany('App\Verenigings');
    }

    public function tijd()
    {
        return $this->hasMany('App\Tijdsregistratie');
    }


}
