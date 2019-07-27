<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryRound extends Model
{
    protected $fillable = ['round_date', 'user_id'];

    public static function needyPersonAddress($id)
    {
        $address = Address::where('id', $id)->first();

        return $address->line_1 . ' '
            . $address->line_2 . ' '
            . $address->line_3 . ' '
            . $address->city . ' '
            . $address->county_province . ' '
            . $address->region . ' '
            . $address->zip_postal_code . ' '
            . $address->country;
    }

    public function needyPeople()
    {
        return $this->belongsToMany(NeedyPerson::class, 'delivery_round_needy_person');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
