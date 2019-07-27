<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpUnitsOfMeasure\PhysicalQuantity\Mass;
use PhpUnitsOfMeasure\Exception\NonStringUnitName;
use PhpUnitsOfMeasure\Exception\NonNumericValue;

class Product extends Model
{

    protected $fillable = [
        'details',
        'expiration_date',
        'barcode',
        'name',
        'bundle_id',
        'status',
        'quantity',
        'weight',
    ];

    public function bundle()
    {
        return $this->belongsTo(Bundle::class);
    }

    public function shelf()
    {
        return $this->belongsTo(Shelf::class);
    }

    public function deliveryRound()
    {
        return $this->belongsTo(DeliveryRound::class);
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
        return new Mass($this->weight, 'g');
    }
}
