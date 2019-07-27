<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryRound extends Model
{
    protected $fillable = ['round_date', 'user_id'];

    public function needyPeople()
    {
        return $this->belongsToMany(NeedyPerson::class, 'delivery_round_needy_person');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
