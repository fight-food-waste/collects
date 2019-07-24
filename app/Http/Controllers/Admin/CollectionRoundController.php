<?php

namespace App\Http\Controllers\Admin;

use App\Bundle;
use App\CollectionRound;
use App\Http\Controllers\Controller;
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
}
