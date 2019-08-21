<?php

namespace App\Http\Controllers\Api;

use App\Bundle;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BundleController extends Controller
{
    /**
     * Create bundle
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $bundle = Bundle::create(['user_id' => $request->user()->value('id')]);

        if ($bundle->exists) {

            Mail::raw('Your bundle #' . $bundle->id . ' has been successfully posted',
            function ($message) use ($request) {
                $message->from('noreply@fight-food-waste.com', 'Fight Food Waste')
                    ->to($request->user()->email)
                    ->subject('You added a new bundle');
            });

            return response()->json(['success' => true, 'id' => $bundle->id], 200);
        } else {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    /**
     * Return bundle if it belongs to the user
     *
     * @param Request $request
     *
     * @return Bundle|Bundle[]|Collection|Model|JsonResponse|null
     */
    public function show(Request $request)
    {
        $bundle = Bundle::findOrFail($request->route('id'));

        if ($request->user()->bundles->contains($bundle)) {
            return $bundle;
        } else {
            return response()->json([
                'error' => 'You are not authorised to access this bundle',
            ], 403);
        }
    }
}
