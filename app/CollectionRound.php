<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectionRound extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function bundles()
    {
        return $this->hasMany(Bundle::class);
    }
}
