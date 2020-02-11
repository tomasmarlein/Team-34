<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    public function gebruikertshirt()
    {
        return $this->belongsTo('App\Gebruikers');
    }
    public function tshirtType()
    {
        return $this->belongsTo('App\TshirtType', 'id');
    }
}
