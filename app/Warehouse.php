<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = ['name'];

    public function shelves()
    {
        return $this->hasMany(Shelf::class);
    }
}
