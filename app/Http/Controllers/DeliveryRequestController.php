<?php

namespace App\Http\Controllers;

use App\DeliveryRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Exception;

class DeliveryRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user's DeliveryRequests
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        return view('delivery_requests.index', [
            'deliveryRequests' => $request->user()->deliveryRequests,
        ]);
    }

    /**
     * Show a specific DeliveryRequest
     *
     * @param Request $request
     * @return Factory|RedirectResponse|View
     */
    public function show(Request $request)
    {
        $deliveryRequest = DeliveryRequest::findOrFail($request->route('id'));

        if (!$request->user()->deliveryRequests->contains($deliveryRequest->id)) {
            return redirect()->route('delivery_requests.index')
                ->with('error', __('flash.delivery_request_controller.access_forbidden'));
        }

        return view('delivery_requests.show', compact('deliveryRequest'));
    }

    public function store(Request $request)
    {

        $openDeliveryRequests = DeliveryRequest::where(['user_id' => $request->user()->id])->where('status', 0)->get();

        if ($openDeliveryRequests->isEmpty()) {

            DeliveryRequest::create(['user_id' => $request->user()->id]);

            return redirect()->back()->with('success', __('flash.delivery_request_controller.store_success'));
        } else {
            return redirect()->back()->with('error', __('flash.delivery_request_controller.store_error'));
        }
    }

    /**
     * Delete DeliveryRequest and all its Products
     *
     * @param Request $request
     *
     * @return Response
     * @throws Exception
     */
    public function destroy(Request $request)
    {
        $deliveryRequest = DeliveryRequest::findOrFail($request->input('delivery_request_id'));

        foreach ($deliveryRequest->products as $product) {
            $product->status = 1;
            $product->delivery_request_id = null;
            $product->save();
        }

        try {
            $deliveryRequest->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', __('flash.delivery_request_controller.destroy_error'));
        }

        return redirect()->back()->with('success', __('flash.delivery_request_controller.destroy_success'));
    }
}
