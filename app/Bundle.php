<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    public function bundleStatus()
    {
        return $this->belongsTo(BundleStatus::class);
    }

    public function collectionRound()
    {
        return $this->belongsTo(CollectionRound::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
