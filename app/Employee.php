<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Tightenco\Parental\HasParent;

/**
 * App\Employee
 *
 * @property-read Collection|CollectionRound[] $collectionRounds
 * @property-read Collection|DeliveryRound[] $deliveryRounds
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @method static Builder|Employee newModelQuery()
 * @method static Builder|Employee newQuery()
 * @method static Builder|Employee query()
 * @mixin Eloquent
 */
class Employee extends User
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
        'agency_id',
    ];

    public function collectionRounds()
    {
        return $this->hasMany(CollectionRound::class);
    }

    public function deliveryRounds()
    {
        return $this->hasMany(DeliveryRound::class);
    }
}
