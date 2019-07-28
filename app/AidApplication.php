<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AidApplication extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_approved',
        'annual_income',
        'user_id',
    ];

    /**
     * Get the NeedyPerson that owns the application.
     */
    public function needyPerson()
    {
        return $this->belongsTo(NeedyPerson::class);
    }
}
