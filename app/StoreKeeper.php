<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Tightenco\Parental\HasParent;

/**
 * App\Storekeeper
 *
 * @property-read Collection|StorekeeperMembership[] $memberships
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @method static Builder|Storekeeper newModelQuery()
 * @method static Builder|Storekeeper newQuery()
 * @method static Builder|Storekeeper query()
 * @mixin Eloquent
 */
class Storekeeper extends User
{
    use HasParent;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'address_id',
        'type',
        'membership'
    ];

    public function memberships()
    {
        return $this->hasMany(StorekeeperMembership::class);
    }
}
