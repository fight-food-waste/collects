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

    public static function bundleStatusName($id)
    {
        return BundleStatus::where('id', $id)->first()->name;
    }

    public static function bundleUserName($id)
    {
        return User::where('id', $id)->first()->first_name . ' ' . User::where('id', $id)->first()->last_name;
    }
}
