<?php

namespace App\Http\Controllers;

use App\Bundle;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BundlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $bundles = Bundle::all()->where('user_id', Auth::user()->id);

        return view('bundle.index', compact('bundles'));
    }

    public function show(Request $request)
    {
        $bundle = Bundle::find($request->route('id'));

        if ($bundle->user_id !== Auth::user()->id) {
            return redirect()->route('bundle.index')->with('error', "Access forbidden: you are not allowed to see this bundle.");
        }

        $products = $bundle->products;

        return view('bundle.show', [
            'bundle' => $bundle,
            'products' => $products,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        $bundle = Bundle::find($request->input('bundle_id'));

        $bundle->products->each->delete();
        $bundle->delete();

        return redirect()->back()->with('success', "The bundle has been successfully deleted.");
    }
}
