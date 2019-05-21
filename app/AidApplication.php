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
     * Get the user that owns the application.
     */
    public function aidApplication()
    {
        return $this->belongsTo(AidApplication::class);
    }
}
