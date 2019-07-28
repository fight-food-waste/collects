<?php

namespace App\Http\Controllers\Admin;

use App\Warehouse;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display with with all the Warehouses
     *
     * @return Factory|View
     */
    public function index()
    {
        $warehouses = Warehouse::all();

        return view('admin.warehouses.index', compact('warehouses'));
    }
}
