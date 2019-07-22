<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Tightenco\Parental\HasParent;

/**
 * App\Donor
 *
 * @property-read Address $address
 * @property-read Agency $agency
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @method static Builder|Donor newModelQuery()
 * @method static Builder|Donor newQuery()
 * @method static Builder|Donor query()
 * @mixin Eloquent
 */
class Donor extends User
{
    use HasParent;

    public function bundles()
    {
        return $this->hasMany('App\Bundle');
    }
}