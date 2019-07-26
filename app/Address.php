<?php

namespace App;

use Eloquent;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Address
 *
 * @property-read User $user
 * @method static Builder|Address newModelQuery()
 * @method static Builder|Address newQuery()
 * @method static Builder|Address query()
 * @mixin Eloquent
 */
class Address extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'street',
        'zip_postal_code',
        'city',
        'closest_warehouse_id',
    ];

    /**
     * Get the user that owns the address.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getFormatted()
    {
        return $this->street . ', ' . $this->zip_postal_code . ' ' . $this->city . ', France';
    }

    public function getDistance(String $origin, String $destination)
    {
        $client = new Client();
        $url = "http://www.mapquestapi.com/directions/v2/routematrix?key=" . config('app.mapquest_api_key');
        $responseStream = $client->post($url, [
            RequestOptions::JSON => ['locations' => [
                $origin,
                $destination,
            ]]
        ]);
        $responseString = (string)$responseStream->getBody();

        $distance = json_decode($responseString, true)['distance'][1];

        return $distance;
    }

    public function computeClosestWarehouse() {
        $warehouses = Warehouse::all();

        $closestWarehouse = [];
        $closestWarehouse['id'] = null;
        $closestWarehouse['distance'] = null;

        $destination = $this->getFormatted();

        foreach ($warehouses as $warehouse) {
            $origin = $warehouse->address;
            $distance = $this->getDistance($origin, $destination);

            // First item only
            if ($closestWarehouse['distance'] == null) {
                $closestWarehouse['distance'] = $distance;
                $closestWarehouse['id'] = $warehouse->id;

            } elseif ($distance < $closestWarehouse['distance']) {
                $closestWarehouse['distance'] = $distance;
                $closestWarehouse['id'] = $warehouse->id;
            }
        }

        return $closestWarehouse['id'];
    }
}
