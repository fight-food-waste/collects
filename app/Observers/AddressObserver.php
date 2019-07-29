<?php

namespace App\Observers;

use App\Address;

class AddressObserver
{
    /**
     * Handle the address "creating" event.
     * Compute the closest warehouse if not provided
     *
     * @param Address $address
     * @return void
     */
    public function creating(Address $address)
    {
        if ($address->closest_warehouse_id === null) {
            if ($address->isReal()) {
                $address->closest_warehouse_id = $address->computeClosestWarehouse();
            }
        }
    }
}
