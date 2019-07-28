<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpUnitsOfMeasure\PhysicalQuantity\Mass;
use PhpUnitsOfMeasure\Exception\NonStringUnitName;
use PhpUnitsOfMeasure\Exception\NonNumericValue;

class CollectionRound extends Model
{
    protected $fillable = ['round_date', 'user_id', 'warehouse_id'];

    private $max_weight = 100000; // 100 kg

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function bundles()
    {
        return $this->hasMany(Bundle::class);
    }

    public function truck()
    {
        return $this->hasOne(Truck::class);
    }

    /**
     * Get a human-readable name for all possible statuses
     *
     * @return string
     */
    public function getStatusName(): string
    {
        switch ($this->status) {
            case 0:
                return "Not ready";
            case 1:
                return "Ready";
            case 2:
                return "In progress";
            case 3:
                return "Done";
            default:
                return "Unknown";
        }
    }

    /**
     * Convert weight integer as a Mass object in grams
     *
     * @return Mass
     * @throws NonNumericValue
     * @throws NonStringUnitName
     */
    public function weightAsMass()
    {
        return new Mass($this->weight(), 'g');
    }

    /**
     * Get total CollectionRound weight by adding up all the Bundles' weight
     *
     * @return int
     */
    public function weight()
    {
        $weight = 0;

        foreach ($this->bundles as $bundle) {
            $weight += $bundle->weight();
        }

        return $weight;
    }

    /**
     * Calculate available weight
     *
     * @return int
     */
    public function availableWeight(): int
    {
        return $this->max_weight - $this->weight();
    }
}
