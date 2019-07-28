<?php

namespace App\Http\Controllers\Admin;

use App\Truck;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;

class TruckController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display view with all the Trucks
     *
     * @return Factory|View
     */
    public function index()
    {
        $trucks = Truck::all();

        return view('admin.trucks.index', compact('trucks'));
    }
}
