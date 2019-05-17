<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tightenco\Parental\HasChildren;


class User extends Authenticatable
{
    use HasChildren;
    use Notifiable;

    /**
     * Don't want to store raw class names in the type column
     *
     * @var array
     */
    protected $childTypes = [
        'donor' => Donor::class,
        'storekeeper' => Storekeeper::class,
        'needy_person' => NeedyPerson::class,
    ];

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
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the address record associated with the user.
     */
    public function address()
    {
        return $this->hasOne('App\Address');
    }

    /**
     * Get the address record associated with the user.
     */
    public function agency()
    {
        return $this->hasOne('App\Agency');
    }
}
