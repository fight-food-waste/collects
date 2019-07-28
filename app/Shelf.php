<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpUnitsOfMeasure\PhysicalQuantity\Mass;
use PhpUnitsOfMeasure\Exception\NonStringUnitName;
use PhpUnitsOfMeasure\Exception\NonNumericValue;


class Shelf extends Model
{
    public static $max_weight = 1000; // grams
    protected $fillable = ['number', 'warehouse_id'];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Convert weight integer as a Mass object in grams
     *
     * @return Mass
     * @throws NonNumericValue
     * @throws NonStringUnitName
     */
    public function weightAsMass(): Mass
    {
        return new Mass($this->weight(), 'g');
    }

    /**
     * Get total weight on the Shelf by adding up all the products' weight
     *
     * @return int
     */
    public function weight(): int
    {
        $weight = 0;

        foreach ($this->products as $product) {
            $weight += $product->weight;
        }

        return $weight;
    }

    public function availableWeight(): int
    {
        return Shelf::$max_weight - $this->weight();
    }
}
