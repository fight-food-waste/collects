<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpUnitsOfMeasure\PhysicalQuantity\Mass;
use PhpUnitsOfMeasure\Exception\NonStringUnitName;
use PhpUnitsOfMeasure\Exception\NonNumericValue;

class Warehouse extends Model
{
    protected $fillable = ['name', 'address'];

    public function shelves()
    {
        return $this->hasMany(Shelf::class);
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
     * Get total weight in the Warehouse by adding up all the shelves' weight
     *
     * @return int
     */
    public function weight(): int
    {
        $weight = 0;

        foreach ($this->shelves as $shelf) {
            $weight += $shelf->weight();
        }

        return $weight;
    }

    public function availableWeight(): int
    {
        return $this->maxWeight() - $this->weight();
    }

    /**
     * Calculate the maximum weight according to the number of shelves and their maximum weight
     *
     * @return int
     */
    public function maxWeight(): int
    {
        return count($this->shelves) * Shelf::$max_weight;
    }
}
