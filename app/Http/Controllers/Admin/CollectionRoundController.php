<?php

namespace App\Http\Controllers\Admin;

use App\Bundle;
use App\CollectionRound;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class CollectionRoundController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $collectionRounds = CollectionRound::all();

        return view('admin.collection_rounds.index', compact('collectionRounds'));
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

    public function store()
    {
        CollectionRound::create();

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
                $bundles->forget($bundle);
            }
        }

        return $bundles;
    }

    public function addBundles(Request $request)
    {
        $collectionRound = CollectionRound::find($request->route('id'));

        $bundles = $this->getAvailableBundles($collectionRound);

        return view('admin.collection_rounds.add_bundles', [
            'collectionRound' => $collectionRound,
            'bundles' => $bundles,
        ]);
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
        $bundles = $this->getAvailableBundles($collectionRound);

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
