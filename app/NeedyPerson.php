<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Tightenco\Parental\HasParent;

/**
 * App\NeedyPerson
 *
 * @property-read Collection|DeliveryRound[] $deliveryRounds
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @method static Builder|NeedyPerson newModelQuery()
 * @method static Builder|NeedyPerson newQuery()
 * @method static Builder|NeedyPerson query()
 * @mixin Eloquent
 */
class NeedyPerson extends User
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
        'aid_application_id'
    ];

    public function deliveryRounds()
    {
        return $this->belongsToMany(DeliveryRound::class, 'delivery_round_needy_person')->withTimestamps();
    }
}
