<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Bundle
 *
 * @property-read BundleStatus $bundleStatus
 * @property-read CollectionRound $collectionRound
 * @property-read Collection|Product[] $products
 * @method static Builder|Bundle newModelQuery()
 * @method static Builder|Bundle newQuery()
 * @method static Builder|Bundle query()
 * @mixin Eloquent
 */
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
        return BundleStatus::where('id', $id)->value('name');
    }

    public static function bundleUserName($id)
    {
        return User::where('id', $id)->value('first_name') . ' ' . User::where('id', $id)->value('last_name');
    }
}
