<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
