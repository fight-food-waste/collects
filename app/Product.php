<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpUnitsOfMeasure\PhysicalQuantity\Mass;

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

    public function weightAsMass()
    {
        return new Mass($this->weight, 'g');
    }
}
