<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Product
 *
 * @property-read Bundle $bundle
 * @property-read DeliveryRound $deliveryRound
 * @property-read ProductStatus $productStatus
 * @property-read Shelf $shelf
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @mixin Eloquent
 */
class Product extends Model
{
    public function bundle()
    {
        return $this->belongsTo(Bundle::class);
    }

    public function shelf()
    {
        return $this->belongsTo(Shelf::class);
    }

    public function deliveryRound()
    {
        return $this->belongsTo(DeliveryRound::class);
    }

    public function productStatus()
    {
        return $this->belongsTo(ProductStatus::class);
    }

    public static function productStatusName($id)
    {
        return ProductStatus::where('id', $id)->value('name');
    }
}
