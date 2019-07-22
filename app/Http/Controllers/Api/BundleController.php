<?php

namespace App\Http\Controllers\Api;

use App\Bundle;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BundleController extends Controller
{
    /**
     * Create bundle
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $bundle = Bundle::create(['user_id' => $request->user()->value('id')]);

        if ($bundle->exists) {
            return response()->json(['success' => true, 'id' => $bundle->id], 200);
        } else {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    /**
     * Return bundle if it belongs to the user
     *
     * @param Request $request
     * @return Bundle|Bundle[]|Collection|Model|JsonResponse|null
     */
    public function show(Request $request)
    {
        $bundle = Bundle::find($request->route('id'));

        if ($request->user()->bundles->contains($bundle)) {
            return $bundle;
        } else {
            return response()->json([
                'error' => 'You are not authorised to access this bundle'
            ], 403);
        }
    }
}
