<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Address
 *
 * @property-read User $user
 * @method static Builder|Address newModelQuery()
 * @method static Builder|Address newQuery()
 * @method static Builder|Address query()
 * @mixin Eloquent
 */
class Address extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'street',
        'zip_postal_code',
        'city',
    ];

    /**
     * Get the user that owns the address.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function fullAddress($id)
    {
        $address = Address::where('id', $id)->value('line_1') . ' ';
        $address .= Address::where('id', $id)->value('line_2') . ' ';
        $address .= Address::where('id', $id)->value('line_3') . ' ';
        $address .= Address::where('id', $id)->value('city') . ' ';
        $address .= Address::where('id', $id)->value('county_province') . ' ';
        $address .= Address::where('id', $id)->value('region') . ' ';
        $address .= Address::where('id', $id)->value('zip_postal_code') . ' ';
        $address .= Address::where('id', $id)->value('country');

        return $address;
    }
}
