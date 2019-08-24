<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Warehouse;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\ProductsCategoryForm;
use App\Category;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all the Products available in the supply
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(FormBuilder $formBuilder, Request $request)
    {
        if ($request->user()->status !== 1) {
            return redirect(route('home'))->with('error', __('flash.product_controller.unapproved_account'));
        }

        $form = $formBuilder->create(ProductsCategoryForm::class, [
            'method' => 'GET',
            'url' => route('products.index'),
        ], [
            'category_id' => $request->input('category') !== null ? $request->input('category') : null,
        ]);

        $warehouse = Warehouse::findOrFail($request->user()->address->closest_warehouse_id);

        $products = Product::where('status', 1)
            ->whereIn('shelf_id', $warehouse->shelves->pluck('id'))
            ->get();

        if ($request->input('category') !== null) {
            $category = Category::findOrFail($request->input('category'));

            $products = $products->intersect($category->products);
        }

        return view('products.index', compact('products', 'form'));
    }

    /**
     * Delete Product
     *
     * @param Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        try {
            Product::findOrFail($request->input('product_id'))->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', __('flash.product_controller.destroy_error'));
        }

        return redirect()->back()->with('success', __('flash.product_controller.destroy_success'));
    }

    public function addToDeliveryRequest(Request $request)
    {
        if ($request->user()->hasOneOpenDeliveryRequest()) {
            $deliveryRequest = $request->user()->getOpenDeliveryRequest();

            $product = Product::findOrFail($request->input('product_id'));

            $product->delivery_request_id = $deliveryRequest->id;
            $product->status = 2;
            $product->save();

            return redirect()->back()->with('success', __('flash.product_controller.add_to_delivery_request_success'));
        }
    }

    public function removeFromDeliveryRequest(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));

        $product->delivery_request_id = null;
        $product->status = 1;
        $product->save();

        return redirect()->back()->with('success', __('flash.product_controller.remove_from_delivery_request_success'));
    }
}
