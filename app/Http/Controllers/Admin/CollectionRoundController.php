<?php

namespace App\Http\Controllers\Admin;

use App\Bundle;
use App\CollectionRound;
use App\Forms\CollectionRoundForm;
use App\Http\Controllers\Controller;
use App\Warehouse;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class CollectionRoundController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(FormBuilder $formBuilder)
    {
        $collectionRounds = CollectionRound::all();

        $form = $formBuilder->create(CollectionRoundForm::class, [
            'method' => 'POST',
            'url' => route('admin.collection_rounds.store')
        ]);

        return view('admin.collection_rounds.index', compact('collectionRounds', 'form'));
    }

    public function show(Request $request)
    {
        $collectionRound = CollectionRound::find($request->route('id'));
        $bundles = $collectionRound->bundles;

        return view('admin.collection_rounds.show', [
            'collectionRound' => $collectionRound,
            'bundles' => $bundles,
        ]);
    }

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

        return redirect()->back()->with('success', 'A new collection round has been created');
    }

    public function removeBundle(Request $request)
    {
        $collectionRound = CollectionRound::find($request->input('collection_round_id'));
        $bundle = Bundle::find($request->input('bundle_id'));

        if ($collectionRound->status == 0) {
            $bundle->collection_round_id = null;
            $bundle->save();

            return redirect()->back()->with('success', 'The bundle has been removed from this collection round.');
        } else {
            return redirect()->back()->with('error', 'The collection round can\'t be modified anymore.');
        }
    }

    public function destroy(Request $request)
    {
        $collectionRound = CollectionRound::find($request->input('collection_round_id'));

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
                return redirect()->back()->with('error', 'Something went wrong while deleting the collection round.');
            }

            return redirect()->route('admin.collection_rounds.index')
                ->with('success', 'The collection round has been deleted.');
        } else {
            return redirect()->back()->with('error', 'The collection round can\'t be modified anymore.');
        }
    }

    private function getAvailableBundles(CollectionRound $collectionRound)
    {
        $bundles = Bundle::where('status', 1)
            ->where('collection_round_id', null)
            ->get();

        foreach ($bundles as $bundle) {
            if ($bundle->weight() > $collectionRound->availabeWeight()) {
                $bundles->forget($bundle->id);
            }
        }

        return $bundles;
    }

    private function getDistance(String $origin, String $destination)
    {
        $client = new Client();
        $url = "http://www.mapquestapi.com/directions/v2/routematrix?key=" . config('app.mapquest_api_key');
        $responseStream = $client->post($url, [
            RequestOptions::JSON => ['locations' => [
                $origin,
                $destination,
            ]]
        ]);
        $responseString = (string)$responseStream->getBody();

        $distance = json_decode($responseString, true)['distance'][1];

        return $distance;
    }

    private function getCloseAvailableBundles(CollectionRound $collectionRound)
    {
        $bundles = $this->getAvailableBundles($collectionRound);
        $warehouses = Warehouse::all();

        foreach ($bundles as $bundle) {

            $closestWarehouse = [];
            $closestWarehouse['id'] = null;
            $closestWarehouse['distance'] = null;

            $destination = $bundle->donor->address->getFormatted();

            foreach ($warehouses as $warehouse) {
                $origin = $warehouse->address;
                $distance = $this->getDistance($origin, $destination);

                // First item only
                if ($closestWarehouse['distance'] == null) {
                    $closestWarehouse['distance'] = $distance;
                    $closestWarehouse['id'] = $warehouse->id;

                } elseif ($distance < $closestWarehouse['distance']) {
                    $closestWarehouse['distance'] = $distance;
                    $closestWarehouse['id'] = $warehouse->id;
                }
            }

            if ($collectionRound->warehouse->id != $closestWarehouse['id']) {
                // Bundle is closer to another warehouse, this it should not be in this collection round

                $bundles = $bundles->except($bundle->id);
            }
        }

        return $bundles;
    }

    public function addBundles(Request $request)
    {

        $collectionRound = CollectionRound::find($request->route('id'));

        if ($request->input('closest') === "true") {
            $bundles = $this->getCloseAvailableBundles($collectionRound);
        } else {
            $bundles = $this->getAvailableBundles($collectionRound);
        }

        return view('admin.collection_rounds.add_bundles',
            compact('collectionRound', 'bundles', 'request'));
    }

    public function addBundle(Request $request)
    {
        $collectionRound = CollectionRound::find($request->input('collection_round_id'));
        $bundle = Bundle::find($request->input('bundle_id'));

        $bundle->collection_round_id = $collectionRound->id;
        $bundle->status = 2;
        $bundle->save();

        return redirect()->route('admin.collection_rounds.add_bundles', $collectionRound->id)
            ->with('success', 'The bundle has been added to the collection round.');
    }

    public function autoAddBundles(Request $request)
    {

        $collectionRound = CollectionRound::find($request->route('id'));
        $bundles = $this->getCloseAvailableBundles($collectionRound);

        if (count($bundles) > 0) {
            foreach ($bundles as $bundle) {
                $bundle->collection_round_id = $collectionRound->id;
                $bundle->status = 2;
                $bundle->save();
            }

            return redirect()->route('admin.collection_rounds.show', $collectionRound->id)
                ->with('success', count($bundles) . ' bundles have been added to the collection round.');
        } else {
            return redirect()->route('admin.collection_rounds.show', $collectionRound->id)
                ->with('error', 'No available bundle was found...');
        }
    }
}
