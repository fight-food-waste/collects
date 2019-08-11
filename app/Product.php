<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpUnitsOfMeasure\PhysicalQuantity\Mass;
use PhpUnitsOfMeasure\Exception\NonStringUnitName;
use PhpUnitsOfMeasure\Exception\NonNumericValue;
use Carbon\Carbon;
use Exception;

class Product extends Model
{

    protected $fillable = [
        'expiration_date',
        'barcode',
        'name',
        'bundle_id',
        'status',
        'quantity',
    ];

    /**
     * Automatically cast these attributes to Carbon instances
     *
     * @var array
     */
    protected $dates = [
        'expiration_date',
    ];


    /**
     * Format expiration_date attribute
     *
     * @param $value
     * @return string
     */
    public function getExpirationDateAttribute($value)
    {
        try {
            return (new Carbon($value))->format('d/m/y');
        } catch (Exception $e) {
            return $value;
        }
    }

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

    public function categories()
    {
        return $this->belongsToMany(Category::class);
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
