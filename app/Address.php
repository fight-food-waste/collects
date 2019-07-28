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
    ];

    /**
     * Get the user that owns the address.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Check address against MapQuest API
     *
     * @return bool
     */
    public function isReal(): bool
    {
        // The only reason we really need a real address is because we want to calculate
        // the closest warehouse afterwards using the MapQuest API. This API can't check
        // if an address exist or not and the geocoding API sometimes return coordinates
        // even if the routematrix API does not find the address.
        // Since we only care about MapQuest's routematrix API, we'll use this one to
        // check if the address is valid or not. To do so we use a known valid address
        // and try to get a route to it from or Address object.
        // If we can't get a route then it probably means the address is not valid,
        // and it means we can't use it since we rely on this API.
        // Here the "known valid address" is our School's (ESGI).

        $esgiAddress = "242 Rue du Faubourg Saint-Antoine, 75012 Paris, France";

        return $this->getDistance($esgiAddress) !== -1;
    }

    /**
     * Compare distances and return the closest Warehouse to this Address
     *
     * @return int|null
     */
    public function computeClosestWarehouse(): ?int
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

        $responseStr = (string) $responseStream->getBody();
        $responseArr = json_decode($responseStr, true);

        if (array_key_exists('distance', $responseArr)) {
            $distance = $responseArr['distance'][1];

            return intval($distance);
        } else {
            // Can't find a route. That usually one or both of the addresses are not valid.
            return -1;
        }
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
}
