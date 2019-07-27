<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpUnitsOfMeasure\PhysicalQuantity\Mass;

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

    public function getStatusName()
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

    public function weightAsMass()
    {
        return new Mass($this->weight(), 'g');
    }

    public function weight()
    {
        $weight = 0;

        foreach ($this->bundles as $bundle) {
            $weight += $bundle->weight();
        }

        return $weight;
    }

    public function availabeWeight()
    {
        return $this->max_weight - $this->weight();
    }
}
