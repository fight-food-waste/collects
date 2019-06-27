<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'line_1',
        'line_2',
        'line_3',
        'city',
        'county_province',
        'region',
        'zip_postal_code',
        'country',
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
        $address = Address::where('id', $id)->first()->line_1 . ' ';
        $address .= Address::where('id', $id)->first()->line_2 . ' ';
        $address .= Address::where('id', $id)->first()->line_3 . ' ';
        $address .= Address::where('id', $id)->first()->city . ' ';
        $address .= Address::where('id', $id)->first()->county_province . ' ';
        $address .= Address::where('id', $id)->first()->region . ' ';
        $address .= Address::where('id', $id)->first()->zip_postal_code . ' ';
        $address .= Address::where('id', $id)->first()->country;

        return $address;
    }
}
