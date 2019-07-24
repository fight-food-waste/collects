<?php

namespace App\Http\Controllers\Admin;

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
            'bundle' => $collectionRound,
            '$bundles' => $bundles,
        ]);
    }
}
