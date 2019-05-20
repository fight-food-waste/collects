<?php

namespace App;

use Tightenco\Parental\HasParent;

class Employee extends User
{
    use HasParent;

    public function collectionRounds()
    {
        return $this->hasMany(CollectionRound::class);
    }
}
