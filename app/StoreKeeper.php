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
        'address_id',
        'membership',
        'store_name',
        'membership_end_date',
    ];

    public function hasValidMembership()
    {
        if ($this->membership_end_date != null) {
            if (strtotime($this->membership_end_date) > strtotime('now')) {
                return true;
            }
        }

        return false;
    }
}
