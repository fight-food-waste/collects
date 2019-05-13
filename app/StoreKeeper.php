<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreKeeper extends Model
{
    use \Tightenco\Parental\HasParent;

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
        'membership'
    ];
}
