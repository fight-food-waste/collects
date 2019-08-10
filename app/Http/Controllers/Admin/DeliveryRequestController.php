<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DeliveryRequest;
use App\Product;

class DeliveryRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $deliveryRequests = DeliveryRequest::all();

        return view('admin.delivery_requests.index', compact('deliveryRequests'));
    }

    public function approve(Request $request)
    {
        $deliveryRequest = DeliveryRequest::findOrFail($request->input('delivery_request_id'));
        $deliveryRequest->status = 1;
        $deliveryRequest->save();

        return redirect()->back()
            ->with('success', __('flash.admin.delivery_request_controller.approve_success', ['delivery_request' => $deliveryRequest->id]));
    }

    public function reject(Request $request)
    {
        $deliveryRequest = DeliveryRequest::findOrFail($request->input('delivery_request_id'));
        $deliveryRequest->status = -1;
        $deliveryRequest->save();

        return redirect()->back()
            ->with('success', __('flash.admin.delivery_request_controller.reject_success', ['delivery_request' => $deliveryRequest->id]));
    }

    public function show(Request $request)
    {
        $deliveryRequest = DeliveryRequest::findOrFail($request->route('id'));
        $products = $deliveryRequest->products;

        return view('admin.delivery_requests.show', [
            'deliveryRequest' => $deliveryRequest,
            'products' => $products,
        ]);
    }

    public function rejectProduct(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));
        $product->delivery_request_id = null;

        return redirect()->back()->with('success', __('flash.admin.delivery_request_controller.reject_product_success'));
    }
}
