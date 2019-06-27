<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;

class CollectionRoundAddressesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addressesList($id)
    {
        $addresses = Address::where('id', $id)->get();

        return view('collection_round.addresses_list.show', compact('addresses'));
    }
}
