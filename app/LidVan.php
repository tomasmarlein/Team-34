<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LidVan extends Model
{
    public function gebruikerslid()
    {
        return $this->hasOne('App\Gebruikers');
    }

    public function vereniginglid()
    {
        return $this->hasOne('App\Verenigings');
    }

}
