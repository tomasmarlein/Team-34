<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaakVan extends Model
{
    public function taakvan()
    {
        return $this->hasOne('App\Taak');
    }

    public function taakvanvereniging()
    {
        return $this->hasOne('App\Verenigings');
    }
}
