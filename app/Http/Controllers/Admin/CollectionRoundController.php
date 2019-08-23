<?php

namespace App\Http\Controllers\Admin;

use App\Bundle;
use App\CollectionRound;
use App\Exports\CollectionRoundExport;
use App\Forms\CollectionRoundForm;
use App\Http\Controllers\Controller;
use App\Truck;
use Exception;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Mail;

class CollectionRoundController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Show all CollectionRounds and form to create a new one
     *
     * @param FormBuilder $formBuilder
     *
     * @return Factory|View
     */
    public function index(FormBuilder $formBuilder)
    {
        $collectionRounds = CollectionRound::all();

        $form = $formBuilder->create(CollectionRoundForm::class, [
            'method' => 'POST',
            'url' => route('admin.collection_rounds.store'),
        ]);

        return view('admin.collection_rounds.index', compact('collectionRounds', 'form'));
    }

    /**
     * Display a CollectionRound with all its bundles and products
     *
     * @param Request $request
     *
     * @return Factory|View
     */
    public function show(Request $request)
    {
        $collectionRound = CollectionRound::findOrFail($request->route('id'));

        $bundles = $collectionRound->bundles;

        // Get all products in this CollectionRound
        $products = collect();
        foreach ($bundles as $bundle) {
            $products = $products->merge($bundle->products);
        }

        return view('admin.collection_rounds.show',
            compact('collectionRound', 'bundles', 'products'));
    }

    /**
     * Create new CollectionRound
     *
     * @param FormBuilder $formBuilder
     *
     * @return RedirectResponse
     */
    public function store(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(CollectionRoundForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $attr = $form->getFieldValues();

        CollectionRound::create([
            'warehouse_id' => $attr['warehouse'],
        ]);

        return redirect()->back()->with('success', __('flash.admin.collection_round_controller.store_success'));
    }

    /**
     * Update CollectionRound status and lifecycle
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $collectionRound = CollectionRound::findOrFail($request->route('id'));
        $bundles = $collectionRound->bundles;

        if ($request->input('collection_round_status') == 2) {
            // The collection round has been started

            // Assign a truck to this collection round
            $truckResult = Truck::where('collection_round_id', null)
                ->where('warehouse_id', $collectionRound->warehouse->id)
                ->get();
            if ($truckResult->isEmpty()) {
                return redirect()->back()->with('error', __('flash.admin.collection_round_controller.update_truck_error'));
            } else {
                $truck = $truckResult->first();

                $truck->collection_round_id = $collectionRound->id;
                $truck->save();

                foreach ($bundles as $bundle) {
                    Mail::raw('Your bundle #' . $bundle->id . ' will be collected today.',
                    function ($message) use ($bundle) {
                        $message->from('noreply@fight-food-waste.com', 'Fight Food Waste')
                            ->to($bundle->donor->email)
                            ->subject('A truck is on its way');
                    });
                }
            }
        }

        if ($request->input('collection_round_status') == 3) {
            // Collection round is done. Automatically handle supply.

            if ($collectionRound->warehouse->availableWeight() < $collectionRound->weight()) {
                return redirect()->back()->with('error', __('flash.admin.collection_round_controller.update_status_error'));
            }

            foreach ($bundles as $bundle) {
                Mail::raw('Your bundle #' . $bundle->id . ' has been collected.',
                function ($message) use ($bundle) {
                    $message->from('noreply@fight-food-waste.com', 'Fight Food Waste')
                        ->to($bundle->donor->email)
                        ->subject('Your bundle has been collected');
                });
            }

            // Free truck
            $truck = $collectionRound->truck;
            $truck->collection_round_id = null;
            $truck->save();

            // Get all products in this CollectionRound
            $products = collect();
            foreach ($bundles as $bundle) {
                // Set bundle as "collected" while we're at it
                $bundle->status = 3;
                $bundle->save();

                $products = $products->merge($bundle->products);
            }

            // Get a free shelf for each product
            foreach ($products as $product) {
                foreach ($collectionRound->warehouse->shelves as $shelf) {
                    if ($product->weight <= $shelf->availableWeight()) {
                        $product->shelf_id = $shelf->number;
                        $product->status = 1; // Product is in supply
                        $product->save();

                        // Update next product
                        break;
                    }
                }
            }
        }

        $collectionRound->status = $request->input('collection_round_status');
        $collectionRound->save();

        return redirect()->back()->with('success', __('flash.admin.collection_round_controller.update_success'));
    }

    /**
     * Remove Bundle form CollectionRound
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function removeBundle(Request $request)
    {
        $collectionRound = CollectionRound::findOrFail($request->input('collection_round_id'));
        $bundle = Bundle::findOrFail($request->input('bundle_id'));

        if ($collectionRound->status == 0) {
            $bundle->collection_round_id = null;
            $bundle->status = 1;
            $bundle->save();

            return redirect()->back()->with('success', __('flash.admin.collection_round_controller.remove_bundle_success'));
        } else {
            return redirect()->back()->with('error', __('flash.admin.collection_round_controller.remove_bundle_error'));
        }
    }

    /**
     * Delete CollectionRound and detach all Bundles
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        $collectionRound = CollectionRound::findOrFail($request->input('collection_round_id'));

        if ($collectionRound->status == 0) {
            $bundles = $collectionRound->bundles;

            // Detach bundles from $collectionRound
            foreach ($bundles as $bundle) {
                $bundle->collection_round_id = null;
                $bundle->save();
            }

            try {
                $collectionRound->delete();
            } catch (Exception $e) {
                return redirect()->back()->with('error', __('flash.admin.collection_round_controller.destroy_error'));
            }

            return redirect()->route('admin.collection_rounds.index')
                ->with('success', __('flash.admin.collection_round_controller.destroy_success'));
        } else {
            return redirect()->back()->with('error', __('flash.admin.collection_round_controller.modify_error'));
        }
    }

    /**
     * Display view with available Bundles to add to CollectionRound
     *
     * @param Request $request
     *
     * @return Factory|View
     */
    public function addBundles(Request $request)
    {
        $collectionRound = CollectionRound::findOrFail($request->route('id'));

        if ($request->input('closest') === "true") {
            $bundles = $this->getCloseAvailableBundles($collectionRound);
        } else {
            $bundles = $this->getAvailableBundles($collectionRound);
        }

        return view('admin.collection_rounds.add_bundles',
            compact('collectionRound', 'bundles', 'request'));
    }

    /**
     * Get Bundles that are closer the CollectionRound's Warehouse than other Warehouses
     *
     * @param CollectionRound $collectionRound
     *
     * @return Builder[]|Collection
     */
    private function getCloseAvailableBundles(CollectionRound $collectionRound)
    {
        $bundles = $this->getAvailableBundles($collectionRound);

        foreach ($bundles as $bundle) {

            if ($collectionRound->warehouse->id != $bundle->donor->address->closest_warehouse_id) {
                // Bundle is closer to another warehouse, this it should not be in this collection round

                $bundles = $bundles->except($bundle->id);
            }
        }

        return $bundles;
    }

    /**
     * Get Bundle that are available and that are lightweight enough for this CollectionRound
     *
     * @param CollectionRound $collectionRound
     *
     * @return Builder[]|Collection
     */
    private function getAvailableBundles(CollectionRound $collectionRound)
    {
        $bundles = Bundle::where('status', 1)
            ->where('collection_round_id', null)
            ->get();

        foreach ($bundles as $bundle) {
            if ($bundle->weight() > $collectionRound->availableWeight()) {
                $bundles->forget($bundle->id);
            }
        }

        return $bundles;
    }

    /**
     * Attach a Bundle to a CollectionRound
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function addBundle(Request $request)
    {
        $collectionRound = CollectionRound::findOrFail($request->input('collection_round_id'));
        $bundle = Bundle::findOrFail($request->input('bundle_id'));

        $bundle->collection_round_id = $collectionRound->id;
        $bundle->status = 2;
        $bundle->save();

        return redirect()->route('admin.collection_rounds.add_bundles', $collectionRound->id)
            ->with('success', __('flash.admin.collection_round_controller.add_bundle_success'));
    }

    /**
     * Attach all close Bundles to the CollectionRound
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function autoAddBundles(Request $request)
    {
        $collectionRound = CollectionRound::findOrFail($request->route('id'));
        $bundles = $this->getCloseAvailableBundles($collectionRound);

        if (count($bundles) > 0) {
            foreach ($bundles as $bundle) {
                $bundle->collection_round_id = $collectionRound->id;
                $bundle->status = 2;
                $bundle->save();
            }

            return redirect()->route('admin.collection_rounds.show', $collectionRound->id)
                ->with('success', __('flash.admin.collection_round_controller.auto_add_bundles_success', ['count' => count($bundles)]));
        } else {
            return redirect()->route('admin.collection_rounds.show', $collectionRound->id)
                ->with('error', __('flash.admin.collection_round_controller.auto_add_bundles_error'));
        }
    }

    /**
     * Returns an Excel export of all the CollectionRound's Bundles' Donor's Address
     *
     * @param Request $request
     *
     * @return \Maatwebsite\Excel\BinaryFileResponse|BinaryFileResponse
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function export(Request $request)
    {
        $collectionRound = CollectionRound::findOrFail($request->route('id'));

        return Excel::download(new CollectionRoundExport($collectionRound), 'addresses.xlsx');
    }
}
