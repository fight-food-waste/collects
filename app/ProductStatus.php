<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductStatus
 *
 * @property-read Collection|Product[] $products
 * @method static Builder|ProductStatus newModelQuery()
 * @method static Builder|ProductStatus newQuery()
 * @method static Builder|ProductStatus query()
 * @mixin Eloquent
 */
class ProductStatus extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
