<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpUnitsOfMeasure\PhysicalQuantity\Mass;


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
