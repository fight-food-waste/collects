<?php

namespace App\Http\Controllers\Admin;

use App\Bundle;
use App\Http\Controllers\Controller;
use App\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;

class BundleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Show all bundles
     *
     * @return Factory|View
     */
    public function index()
    {
        $bundles = Bundle::all();

        return view('admin.bundles.index', compact('bundles'));
    }

    /**
     * Approve a Bundle
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function approve(Request $request)
    {
        $bundle = Bundle::find($request->input('bundle_id'));
        $bundle->status = 1;
        $bundle->save();

        return redirect()->back()
            ->with('success', 'Bundle ' . $request->input('bundle_id') . ' has been approved.');
    }

    /**
     * Reject a Bundle
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function reject(Request $request)
    {
        $bundle = Bundle::find($request->input('bundle_id'));
        $bundle->status = -1;
        $bundle->save();

        return redirect()->back()
            ->with('success', 'Bundle ' . $request->input('bundle_id') . ' has been rejected.');
    }

    /**
     * Show view for a Bundle
     *
     * @param Request $request
     *
     * @return Factory|View
     */
    public function show(Request $request)
    {
        $bundle = Bundle::find($request->route('id'));
        $products = $bundle->products;

        return view('admin.bundles.show', [
            'bundle' => $bundle,
            'products' => $products,
        ]);
    }

    /**
     * Delete product
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function rejectProduct(Request $request)
    {
        try {
            Product::find($request->input('product_id'))->delete();
        }
        catch (Exception $e) {
            return redirect()->back()->with('error', 'The product couldn\'t be deleted.');
        }

        return redirect()->back()->with('success', 'The product has been deleted from the bundle.');
    }
}
