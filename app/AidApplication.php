<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\AidApplication
 *
 * @property-read AidApplication $aidApplication
 * @method static Builder|AidApplication newModelQuery()
 * @method static Builder|AidApplication newQuery()
 * @method static Builder|AidApplication query()
 * @mixin Eloquent
 */
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
