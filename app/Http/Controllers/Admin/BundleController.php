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
        $bundle = Bundle::findOrFail($request->input('bundle_id'));
        $bundle->status = 1;
        $bundle->save();

        return redirect()->back()
            ->with('success', __('flash.admin.bundle_controller.approve_success', ['bundle' => $request->input('bundle_id')]));
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
        $bundle = Bundle::findOrFail($request->input('bundle_id'));
        $bundle->status = -1;
        $bundle->save();

        return redirect()->back()
            ->with('success', __('flash.admin.bundle_controller.reject_success', ['bundle' => $request->input('bundle_id')]));
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
        $bundle = Bundle::findOrFail($request->route('id'));
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
            Product::findOrFail($request->input('product_id'))->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', __('flash.admin.bundle_controller.reject_product_error'));
        }

        return redirect()->back()->with('success', __('flash.admin.bundle_controller.reject_product_success'));
    }
}
