<?php

namespace App;

use Tightenco\Parental\HasParent;

class NeedyPerson extends User
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
        'type',
        'address_id',
        'application_filename',
    ];

    public function deliveryRequests()
    {
        return $this->hasMany(DeliveryRequest::class);
    }
}
