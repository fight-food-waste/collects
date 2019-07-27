<?php

namespace App\Http\Controllers\Admin;

use App\Warehouse;
use App\Http\Controllers\Controller;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $warehouses = Warehouse::all();

        return view('admin.warehouses.index', compact('warehouses'));
    }
}
