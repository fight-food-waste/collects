<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryRound extends Model
{
    public function needyPeople()
    {
        return $this->belongsToMany(NeedyPerson::class);
    }
}
