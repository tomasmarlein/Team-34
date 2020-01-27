<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verenigings extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function Verenigingevent()
    {
        return $this->hasMany('App\EvenementVereniging');
    }

    public function vereniginglid()
    {
        return $this->hasMany('App\LidVan');
    }

    public function verenigingtaak()
    {
        return $this->hasMany('App\TaakVan');
    }

    public function vereniginggebruiker()
    {
        return $this->hasOne('App\Gebruikers');
    }
}
