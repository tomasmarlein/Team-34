<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gebruiker extends Model
{

    public function GebruikerThsirt()
    {
        return $this->belongsTo('App\Tshirt')->withDefault();   // an order belongs to a user
    }

}
