<?php

namespace App\Http\Controllers\Admin;

use App\DeliveryRequest;
use App\DeliveryRound;
use App\Forms\DeliveryRoundForm;
use App\Http\Controllers\Controller;
use App\Truck;
use Exception;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class DeliveryRoundController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Show all DeliveryRounds and form to create a new one
     *
     * @param FormBuilder $formBuilder
     *
     * @return Factory|View
     */
    public function index(FormBuilder $formBuilder)
    {
        $deliveryRounds = DeliveryRound::all();

        $form = $formBuilder->create(DeliveryRoundForm::class, [
            'method' => 'POST',
            'url' => route('admin.delivery_rounds.store'),
        ]);

        return view('admin.delivery_rounds.index', compact('deliveryRounds', 'form'));
    }

    /**
     * Display a DeliveryRound with all its bundles and products
     *
     * @param Request $request
     *
     * @return Factory|View
     */
    public function show(Request $request)
    {
        $deliveryRound = DeliveryRound::findOrFail($request->route('id'));

        $deliveryRequests = $deliveryRound->deliveryRequests()->get();

        // Get all products in this DeliveryRound
        $products = collect();
        foreach ($deliveryRequests as $deliveryRequest) {
            $products = $products->merge($deliveryRequest->products);
        }

        return view('admin.delivery_rounds.show',
            compact('deliveryRound', 'deliveryRequests', 'products'));
    }

    /**
     * Create new DeliveryRound
     *
     * @param FormBuilder $formBuilder
     *
     * @return RedirectResponse
     */
    public function store(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(DeliveryRoundForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $attr = $form->getFieldValues();

        DeliveryRound::create([
            'warehouse_id' => $attr['warehouse'],
        ]);

        return redirect()->back()->with('success', __('flash.admin.delivery_round_controller.store_success'));
    }

    /**
     * Update DeliveryRound status and lifecycle
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $deliveryRound = DeliveryRound::findOrFail($request->route('id'));
        $deliveryRequests = $deliveryRound->deliveryRequests;

        if ($request->input('delivery_round_status') == 2) {
            // Assign a truck to this delivery round
            $truckResult = Truck::where('collection_round_id', null)
                ->where('delivery_round_id', null)
                ->where('warehouse_id', $deliveryRound->warehouse->id)
                ->get();
            if ($truckResult->isEmpty()) {
                return redirect()->back()->with('error', __('flash.admin.delivery_round_controller.update_error'));
            } else {
                $truck = $truckResult->first();

                $truck->delivery_round_id = $deliveryRound->id;
                $truck->save();
            }

            foreach ($deliveryRequests as $deliveryRequest) {
                foreach ($deliveryRequest->products as $product) {
                    $product->shelf_id = null;
                    $product->status = 3;
                    $product->save();
                }

                Mail::raw(__('flash.admin.delivery_round_controller.update_mail_raw_1', ['delivery_request' => $deliveryRequest->id]),
                    function ($message) use ($deliveryRequest) {
                        $message->from('noreply@fight-food-waste.com', 'Fight Food Waste')
                            ->to($deliveryRequest->needyPerson->email)
                            ->subject(__('flash.admin.delivery_round_controller.delivery_request_its_way'));
                    });
            }
        }

        if ($request->input('delivery_round_status') == 3) {
            // Release truck
            $truck = $deliveryRound->truck;
            $truck->delivery_round_id = null;
            $truck->save();

            foreach ($deliveryRequests as $deliveryRequest) {
                $deliveryRequest->status = 3;
                $deliveryRequest->save();

                Mail::raw(__('flash.admin.delivery_round_controller.update_mail_raw_2', ['delivery_request' => $deliveryRequest->id]),
                    function ($message) use ($deliveryRequest) {
                        $message->from('noreply@fight-food-waste.com', 'Fight Food Waste')
                            ->to($deliveryRequest->needyPerson->email)
                            ->subject(__('flash.admin.delivery_round_controller.delivery_request_delivered'));
                    });
            }
        }

        $deliveryRound->status = $request->input('delivery_round_status');
        $deliveryRound->save();

        return redirect()->back()->with('success', __('flash.admin.delivery_round_controller.update_success'));
    }

    /**
     * Remove DeliveryRequest form DeliveryRound
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function removeDeliveryRequest(Request $request)
    {
        $deliveryRound = DeliveryRound::findOrFail($request->input('delivery_round_id'));
        $deliveryRequest = DeliveryRequest::findOrFail($request->input('delivery_request_id'));

        if ($deliveryRound->status == 0) {
            $deliveryRequest->delivery_round_id = null;
            $deliveryRequest->status = 1;
            $deliveryRequest->save();

            return redirect()->back()->with('success', __('flash.admin.delivery_round_controller.remove_delivery_request_success'));
        } else {
            return redirect()->back()->with('error', __('flash.admin.delivery_round_controller.remove_delivery_request_error'));
        }
    }

    /**
     * Delete DeliveryRound and detach all DeliveryRequests
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        $deliveryRound = DeliveryRound::findOrFail($request->input('delivery_round_id'));

        if ($deliveryRound->status == 0) {
            $deliveryRequests = $deliveryRound->deliveryRequests;

            // Detach delivery requests from deliveryRound
            foreach ($deliveryRequests as $deliveryRequest) {
                $deliveryRequest->collection_round_id = null;
                $deliveryRequest->save();
            }

            try {
                $deliveryRound->delete();
            } catch (Exception $e) {
                return redirect()->back()->with('error', __('flash.admin.delivery_round_controller.destroy_error'));
            }

            return redirect()->route('admin.delivery_rounds.index')
                ->with('success', __('flash.admin.delivery_round_controller.destroy_success'));
        } else {
            return redirect()->back()->with('error', __('flash.admin.delivery_round_controller.destroy_error_2'));
        }
    }

    /**
     * Display view with available DeliveryRequests to add to DeliveryRound
     *
     * @param Request $request
     *
     * @return Factory|View
     */
    public function addDeliveryRequests(Request $request)
    {
        $deliveryRound = DeliveryRound::findOrFail($request->route('id'));

        if ($request->input('closest') === "true") {
            $deliveryRequests = $this->getCloseAvailableDeliveryRequests($deliveryRound);
        } else {
            $deliveryRequests = $this->getAvailableDeliveryRequests($deliveryRound);
        }

        return view('admin.delivery_rounds.add_delivery_requests',
            compact('deliveryRound', 'deliveryRequests', 'request'));
    }

    /**
     * Get DeliveryRequests that are closer the DeliveryRound's Warehouse than other Warehouses
     *
     * @param DeliveryRound $deliveryRound
     * @return Builder[]|Collection
     */
    private function getCloseAvailableDeliveryRequests(DeliveryRound $deliveryRound)
    {
        $deliveryRequests = $this->getAvailableDeliveryRequests($deliveryRound);

        foreach ($deliveryRequests as $deliveryRequest) {

            if ($deliveryRound->warehouse->id != $deliveryRequest->needyPerson->address->closest_warehouse_id) {
                // DeliveryRequest is closer to another warehouse, this it should not be in this collection round

                $deliveryRequests = $deliveryRequests->except($deliveryRequest->id);
            }
        }

        return $deliveryRequests;
    }

    /**
     * Get DeliveryRequest that are available and that are lightweight enough for this DeliveryRound
     *
     * @param DeliveryRound $deliveryRound
     * @return Builder[]|Collection
     */
    private function getAvailableDeliveryRequests(DeliveryRound $deliveryRound)
    {
        $deliveryRequests = DeliveryRequest::where('status', 1)
            ->where('delivery_round_id', null)
            ->get();

        foreach ($deliveryRequests as $deliveryRequest) {
            if ($deliveryRequest->weight() > $deliveryRound->availableWeight()) {
                $deliveryRequests->forget($deliveryRequest->id);
            }
        }

        return $deliveryRequests;
    }

    /**
     * Attach a DeliveryRequest to a DeliveryRound
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function addDeliveryRequest(Request $request)
    {
        $deliveryRound = DeliveryRound::findOrFail($request->input('delivery_round_id'));
        $deliveryRequest = DeliveryRequest::findOrFail($request->input('delivery_request_id'));

        $deliveryRequest->delivery_round_id = $deliveryRound->id;
        $deliveryRequest->status = 2;
        $deliveryRequest->save();

        return redirect()->route('admin.delivery_rounds.add_delivery_requests', $deliveryRound->id)
            ->with('success', __('flash.admin.delivery_round_controller.add_delivery_request_success'));
    }

    /**
     * Attach all close DeliveryRequests to the DeliveryRound
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function autoAddDeliveryRequests(Request $request)
    {
        $deliveryRound = DeliveryRound::findOrFail($request->route('id'));
        $deliveryRequests = $this->getCloseAvailableDeliveryRequests($deliveryRound);

        if (count($deliveryRequests) > 0) {
            foreach ($deliveryRequests as $deliveryRequest) {
                $deliveryRequest->delivery_round_id = $deliveryRound->id;
                $deliveryRequest->status = 2;
                $deliveryRequest->save();
            }

            return redirect()->route('admin.delivery_rounds.show', $deliveryRound->id)
                ->with('success', count($deliveryRequests) . __('flash.admin.delivery_round_controller.auto_add_delivery_requests_success'));
        } else {
            return redirect()->route('admin.delivery_rounds.show', $deliveryRound->id)
                ->with('error', __('flash.admin.delivery_round_controller.auto_add_delivery_requests_error'));
        }
    }

    /**
     * Returns PDF with delivery requests
     *
     * @param Request $request
     * @return Response
     */
    public function export(Request $request)
    {
        $deliveryRequests = DeliveryRound::findOrFail($request->route('id'))->deliveryRequests;
        $pdf = PDF::loadView('exports.delivery_round', compact('deliveryRequests'));

        return $pdf->download('delivery_requests.pdf');
    }
}
