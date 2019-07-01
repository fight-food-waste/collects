<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\DeliveryRound
 *
 * @property-read Employee $employee
 * @property-read Collection|NeedyPerson[] $needyPeople
 * @method static Builder|DeliveryRound newModelQuery()
 * @method static Builder|DeliveryRound newQuery()
 * @method static Builder|DeliveryRound query()
 * @mixin Eloquent
 */
class DeliveryRound extends Model
{
    protected $fillable = ['round_date', 'user_id'];

    public function needyPeople()
    {
        return $this->belongsToMany(NeedyPerson::class, 'delivery_round_needy_person');
    }

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

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
