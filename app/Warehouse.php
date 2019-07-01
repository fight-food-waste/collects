<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Warehouse
 *
 * @property-read Collection|Shelf[] $shelves
 * @method static Builder|Warehouse newModelQuery()
 * @method static Builder|Warehouse newQuery()
 * @method static Builder|Warehouse query()
 * @mixin Eloquent
 */
class Warehouse extends Model
{
    protected $fillable = ['name'];

    public function shelves()
    {
        return $this->hasMany(Shelf::class);
    }
}
