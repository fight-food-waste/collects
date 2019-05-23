<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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

    public function productStatus()
    {
        return $this->belongsTo(ProductStatus::class);
    }
}
