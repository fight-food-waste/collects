<?php

namespace App\Http\Controllers\Api;

use App\Bundle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BundleController extends Controller
{
    // TODO: validation

    public function open(Request $request) {
        return Bundle::create($request->all());
    }

    public function show(int $id) {
        // TODO: Verify the user owns this bundle
        return Bundle::where('id', $id);
    }

    public function close(Request $request) {
        // TODO: Verify the user owns this bundles
        $bundle = Bundle::where('id', $request->id);
        $bundle->status = "closed";
        $bundle->save();

        // return ok
    }
}
