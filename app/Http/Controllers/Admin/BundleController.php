<?php

namespace App\Http\Controllers\Admin;

use App\Bundle;
use App\Http\Controllers\Controller;

class BundleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bundles = Bundle::all();

        return view('admin.bundles.index', compact('bundles'));
    }
}
