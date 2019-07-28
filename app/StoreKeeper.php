<?php

namespace App;

use Tightenco\Parental\HasParent;

class Storekeeper extends User
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
        'membership',
    ];

    public function memberships()
    {
        return $this->hasMany(StorekeeperMembership::class);
    }
}
