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
        return $this->belongsToMany('App\Gebruikers');
    }

    public function verenigingtaak()
    {
        return $this->belongsToMany('App\Taak');
    }

    public function vereniginggebruiker()
    {
        return $this->hasOne('App\Gebruikers');
    }
}
