<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpUnitsOfMeasure\PhysicalQuantity\Mass;
use PhpUnitsOfMeasure\Exception\NonNumericValue;
use PhpUnitsOfMeasure\Exception\NonStringUnitName;

class DeliveryRequest extends Model
{
    protected $fillable = [
        'user_id',
    ];

    public function deliveryRound()
    {
        return $this->belongsTo(DeliveryRound::class);
    }

    public function needyPerson()
    {
        return $this->belongsTo(NeedyPerson::class, 'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Is the request read-only?
     *
     * @return bool
     */
    public function isClosed(): bool
    {
        return $this->status != 0;
    }

    /**
     * Get a human-readable name for all possible statuses
     *
     * @return string
     */
    public function getStatusName(): string
    {
        switch ($this->status) {
            case -1:
                return "Rejected";
            case 0:
                return "Waiting approval";
            case 1:
                return "Approved";
            case 2:
                return "Being delivered";
            case 3:
                return "Delivered";
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
    public function weightAsMass(): Mass
    {
        return new Mass($this->weight(), 'g');
    }

    /**
     * Get total Bundle weight by adding up all the products' weight
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
}
