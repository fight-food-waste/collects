<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
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
        'needyperson' => NeedyPerson::class,
        'employee' => Employee::class,
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
        'type',
        'address_id',
        'status',
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
        return $this->belongsTo('App\Address');
    }

    /**
     * Generate random token, save it and return it
     *
     * @return string
     */
    public function renewToken(): string
    {
        $token = Str::random(60);

        $this->api_token = hash('sha256', $token);
        $this->save();

        return $token;
    }

    public function getFullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get a human-readable name for all possible statuses
     *
     * @return string
     */
    public function getStatusName(): string
    {
        switch ($this->status) {
            case -1:
                return "Rejected";
            case 0:
                return "Waiting approval";
            case 1:
                return "Approved";
            default:
                return "Unknown";
        }
    }
}
