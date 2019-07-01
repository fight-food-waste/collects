<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Shelf
 *
 * @property-read Collection|Product[] $products
 * @property-read Warehouse $warehouse
 * @method static Builder|Shelf newModelQuery()
 * @method static Builder|Shelf newQuery()
 * @method static Builder|Shelf query()
 * @mixin Eloquent
 */
class Shelf extends Model
{
    protected $fillable = ['number', 'warehouse_id'];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
