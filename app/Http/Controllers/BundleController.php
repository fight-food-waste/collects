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
                ->with('error', "Access forbidden: you are not allowed to see this bundle.");
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

        $bundle->products->each->delete();

        try {
            $bundle->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong while deleting the bundle.');
        }

        return redirect()->back()->with('success', "The bundle has been successfully deleted.");
    }
}
