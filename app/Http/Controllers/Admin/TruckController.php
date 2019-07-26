<?php

namespace App\Http\Controllers\Admin;

use App\Truck;
use App\Http\Controllers\Controller;

class TruckController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $trucks = Truck::all();

        return view('admin.trucks.index', compact('trucks'));
    }
}
