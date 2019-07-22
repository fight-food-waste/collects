<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Bundle
 *
 * @property-read CollectionRound $collectionRound
 * @property-read Collection|Product[] $products
 * @method static Builder|Bundle newModelQuery()
 * @method static Builder|Bundle newQuery()
 * @method static Builder|Bundle query()
 * @mixin Eloquent
 */
class Bundle extends Model
{

    protected $fillable = [
        'user_id',
    ];

    public function collectionRound()
    {
        return $this->belongsTo(CollectionRound::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function isOpen()
    {
        return $this->status == 0;
    }

    public function isClosed()
    {
        return $this->status != 0;
    }
}
