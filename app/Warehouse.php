<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpUnitsOfMeasure\PhysicalQuantity\Mass;

class Warehouse extends Model
{
    protected $fillable = ['name', 'address'];

    public function shelves()
    {
        return $this->hasMany(Shelf::class);
    }

    public function weight()
    {
        $weight = 0;

        foreach ($this->shelves as $shelf) {
            $weight += $shelf->weight();
        }

        return $weight;
    }

    public function weightAsMass()
    {
        return new Mass($this->weight(), 'g');
    }

    public function maxWeight()
    {
        return count($this->shelves) * Shelf::$max_weight;
    }

    public function availableWeight()
    {
        return $this->maxWeight() - $this->weight();
    }
}
