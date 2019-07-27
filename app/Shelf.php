<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpUnitsOfMeasure\PhysicalQuantity\Mass;


class Shelf extends Model
{
    public static $max_weight = 1000;
    protected $fillable = ['number', 'warehouse_id'];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function weightAsMass()
    {
        return new Mass($this->weight(), 'g');
    }

    public function weight()
    {
        $weight = 0;

        foreach ($this->products as $product) {
            $weight += $product->weight;
        }

        return $weight;
    }

    public function availabeWeight()
    {
        return Shelf::$max_weight - $this->weight();
    }
}
