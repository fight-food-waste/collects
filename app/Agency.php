<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Agency
 *
 * @method static Builder|Agency newModelQuery()
 * @method static Builder|Agency newQuery()
 * @method static Builder|Agency query()
 * @mixin Eloquent
 */
class Agency extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}
