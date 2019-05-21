<?php

namespace App;

use Tightenco\Parental\HasParent;

class NeedyPerson extends User
{
    use HasParent;

    public $table = 'users';

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
        'address_id',
        'type',
        'aid_application_id'
    ];

    public function deliveryRounds()
    {
        return $this->belongsToMany(DeliveryRound::class, 'delivery_round_needy_person')->withTimestamps();
    }
}
