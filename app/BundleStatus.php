<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BundleStatus extends Model
{
    public function bundles()
    {
        return $this->hasMany(Bundle::class);
    }
}
