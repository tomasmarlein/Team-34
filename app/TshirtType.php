<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tshirtType extends Model
{
    public function tshirtType()
    {
        return $this->hasMany('App\Tshirt');
    }

    public function tshirttypeEvenement()
    {
        return $this->hasOne('App\Evenement');
    }
}
