<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvenementVereniging extends Model
{
    public function event()
    {
        return $this->hasOne('App\Evenements');
    }

    public function vereniging()
    {
        return $this->hasOne('App\Verenigings');
    }
}
