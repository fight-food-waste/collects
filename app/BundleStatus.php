<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\BundleStatus
 *
 * @property-read Collection|Bundle[] $bundles
 * @method static Builder|BundleStatus newModelQuery()
 * @method static Builder|BundleStatus newQuery()
 * @method static Builder|BundleStatus query()
 * @mixin Eloquent
 */
class BundleStatus extends Model
{
    public function bundles()
    {
        return $this->hasMany(Bundle::class);
    }
}
