<?php

namespace App\Http\Controllers;

use App\Bundle;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Exception;

class BundleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the Donor's Bundles
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        return view('bundle.index', [
            'bundles' => $request->user()->bundles,
        ]);
    }

    /**
     * Show a specific Bundle
     *
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    public function show(Request $request)
    {
        $bundle = Bundle::findOrFail($request->route('id'));

        if (!$request->user()->bundles->contains($bundle->id)) {
            return redirect()->route('bundle.index')
                ->with('error', __('flash.bundle_controller.access_forbidden'));
        }

        return view('bundle.show', compact('bundle'));
    }

    /**
     * Delete Bundle and all its Products
     *
     * @param Request $request
     *
     * @return Response
     * @throws Exception
     */
    public function destroy(Request $request)
    {
        $bundle = Bundle::findOrFail($request->input('bundle_id'));

        foreach ($bundle->products as $product) {
            $product->categories()->detach();
            $product->delete();
        }

        try {
            $bundle->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', __('flash.bundle_controller.destroy_error'));
        }

        return redirect()->back()->with('success', __('flash.bundle_controller.destroy_success'));
    }
}
