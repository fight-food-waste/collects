<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

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
    public function index(Request $request)
    {
        $products = Product::where('status', 1)->get();

        return view('products.index', compact('products'));
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
        }
        catch (Exception $e) {
            return redirect()->back()->with('error', "The product could not be deleted.");
        }

        return redirect()->back()->with('success', "The product has been successfully deleted.");
    }

    public function addToDeliveryRequest(Request $request)
    {
        if ($request->user()->hasOneOpenDeliveryRequest()) {
            $deliveryRequest = $request->user()->getOpenDeliveryRequest();

            $product = Product::findOrFail($request->input('product_id'));

            $product->delivery_request_id = $deliveryRequest->id;
            $product->status = 2;
            $product->save();

            return redirect()->back()->with('success', "The product has been added to the delivery request.");
        }
    }

    public function removeFromDeliveryRequest(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));

        $product->delivery_request_id = null;
        $product->status = 1;
        $product->save();

        return redirect()->back()->with('success', "The product has been removed from the delivery request.");
    }
}
