<?php

namespace App\Http\Controllers\Admin;

use App\Bundle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function approve(Request $request)
    {
        $bundle = Bundle::find($request->input('bundle_id'));
        $bundle->status = 1;
        $bundle->save();

        return redirect(route('admin.bundles.index'))
            ->with('success', 'Bundle ' . $request->input('bundle_id') . ' has been approved.');
    }

    public function reject(Request $request)
    {
        $bundle = Bundle::find($request->input('bundle_id'));
        $bundle->status = -1;
        $bundle->save();

        return redirect(route('admin.bundles.index'))
            ->with('success', 'Bundle ' . $request->input('bundle_id') . ' has been rejected.');
    }
}
