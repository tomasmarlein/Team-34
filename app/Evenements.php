<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evenements extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function eventvereniging()
    {
        return $this->belongsToMany('App\Verenigings');
    }


    public function eventTshirt()
    {
        return $this->belongsToMany('App\TshirtType');
    }

    public function eventTijd()
    {
        return $this->hasMany('App\Tijdsregistratie');
    }
}
