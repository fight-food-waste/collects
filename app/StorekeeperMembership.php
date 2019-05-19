<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StorekeeperMembership extends Model
{
    public function storekeeper()
    {
        return $this->belongsTo(Storekeeper::class);
    }
}
