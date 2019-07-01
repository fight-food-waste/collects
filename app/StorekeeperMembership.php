<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\StorekeeperMembership
 *
 * @property-read Storekeeper $storekeeper
 * @method static Builder|StorekeeperMembership newModelQuery()
 * @method static Builder|StorekeeperMembership newQuery()
 * @method static Builder|StorekeeperMembership query()
 * @mixin Eloquent
 */
class StorekeeperMembership extends Model
{
    public function storekeeper()
    {
        return $this->belongsTo(Storekeeper::class);
    }
}
