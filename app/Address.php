<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * Compare distances and return the closest Warehouse to this Address
     *
     * @return |null
     */
    public function computeClosestWarehouse()
    {
        $warehouses = Warehouse::all();

        $closestWarehouse = [];
        $closestWarehouse['id'] = null;
        $closestWarehouse['distance'] = null;

        foreach ($warehouses as $warehouse) {
            $distance = $this->getDistance($warehouse->address);

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

    /**
     * Return formatted address as string
     *
     * @return string
     */
    public function getFormatted()
    {
        return "{$this->street}, {$this->zip_postal_code} {$this->city}, France";
    }

    /**
     * Returns distance to a location
     *
     * @param String $location
     *
     * @return int
     */
    public function getDistance(String $location): int
    {
        $client = new Client();
        $url = "http://www.mapquestapi.com/directions/v2/routematrix?key=" . config('app.mapquest_api_key');
        $responseStream = $client->post($url, [
            RequestOptions::JSON => ['locations' => [
                $this->getFormatted(),
                $location,
            ]],
        ]);
        $response = (string) $responseStream->getBody();

        $distance = json_decode($response, true)['distance'][1];

        return intval($distance);
    }
}
