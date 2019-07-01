<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\CollectionRound
 *
 * @property-read Collection|Bundle[] $bundles
 * @property-read Employee $employee
 * @method static Builder|CollectionRound newModelQuery()
 * @method static Builder|CollectionRound newQuery()
 * @method static Builder|CollectionRound query()
 * @mixin Eloquent
 */
class CollectionRound extends Model
{
    protected $fillable = ['round_date', 'user_id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public static function employeeFullName($id)
    {
        $employee = Employee::where('id', $id)->first();

        return $employee->first_name . ' ' . $employee->last_name;
    }

    public function bundles()
    {
        return $this->hasMany(Bundle::class);
    }
}
