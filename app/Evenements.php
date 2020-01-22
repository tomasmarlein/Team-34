<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evenements extends Model
{
    public function eventvereniging()
    {
        return $this->hasMany('App\EvenementVereniging');
    }
}
