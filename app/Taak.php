<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taak extends Model
{
    public function taak()
    {
        return $this->belongsToMany('App\Verenigings');
    }
}
