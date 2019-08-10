<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpUnitsOfMeasure\PhysicalQuantity\Mass;
use PhpUnitsOfMeasure\Exception\NonNumericValue;
use PhpUnitsOfMeasure\Exception\NonStringUnitName;

class DeliveryRound extends Model
{
    protected $fillable = [
        'user_id',
        'warehouse_id',
    ];

    private $max_weight = 100000; // 100 kg

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function deliveryRequests()
    {
        return $this->hasMany(DeliveryRequest::class);
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
                return __('admin.delivery_rounds.statuses.not_ready');
            case 1:
                return __('admin.delivery_rounds.statuses.ready');
            case 2:
                return __('admin.delivery_rounds.statuses.in_progress');
            case 3:
                return __('admin.delivery_rounds.statuses.done');
            default:
                return __('admin.delivery_rounds.statuses.unknown');
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
     * Get total DeliveryRound weight by adding up all the Bundles' weight
     *
     * @return int
     */
    public function weight()
    {
        $weight = 0;

        foreach ($this->deliveryRequests as $deliveryRequest) {
            $weight += $deliveryRequest->weight();
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
