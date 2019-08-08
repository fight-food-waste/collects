<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    protected $fillable = [
        'warehouse_id',
        'collection_round_id',
        'delivery_round_id',
        'capacity',
    ];

    public function collectionRound()
    {
        return $this->belongsTo(CollectionRound::class);
    }

    public function deliveryRound()
    {
        return $this->belongsTo(DeliveryRound::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
