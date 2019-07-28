<?php

namespace App;

use Tightenco\Parental\HasParent;

class Donor extends User
{
    use HasParent;

    public function bundles()
    {
        return $this->hasMany('App\Bundle');
    }
}
