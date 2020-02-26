<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tijdsregistratie extends Model
{


    public $timestamps = false;
    protected $guarded = [];
    protected $fillable = ['adminCheckIn', 'adminCheckUit'];



    public function gebruikerstijd()
    {
        return $this->belongsTo('App\Gebruikers', 'gebruikers_id');
    }

    public function verenigingTijd()
    {
        return $this->belongsTo('App\Verenigings', 'verenigings_id');
    }

    public function evenement()
    {
        return $this->belongsTo('App\Evenements', 'evenements_id');
    }
}
