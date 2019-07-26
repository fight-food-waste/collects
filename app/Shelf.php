<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use PhpUnitsOfMeasure\PhysicalQuantity\Mass;

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

    public static $max_weight = 1000;

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function weight()
    {
        $weight = 0;

        foreach ($this->products as $product) {
            $weight += $product->weight;
        }

        return $weight;
    }

    public function weightAsMass()
    {
        return new Mass($this->weight(), 'g');
    }

    public function availabeWeight()
    {
        return Shelf::$max_weight - $this->weight();
    }
}
