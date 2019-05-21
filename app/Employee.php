<?php

namespace App;

use Tightenco\Parental\HasParent;

class Employee extends User
{
    use HasParent;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'agency_id',
    ];

    public function collectionRounds()
    {
        return $this->hasMany(CollectionRound::class);
    }

    public function deliveryRounds()
    {
        return $this->hasMany(DeliveryRound::class);
    }
}
