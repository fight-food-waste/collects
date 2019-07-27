<?php

namespace App\Http\Controllers;

use App\Bundle;
use App\BundleStatus;
use App\CollectionRound;
use App\Employee;
use App\Product;
use App\ProductStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CollectionRoundsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $collection_rounds = CollectionRound::all();

        return view('collection_round.index', compact('collection_rounds'));
    }

    public function create()
    {
        $employees = Employee::where('type', 'employee')->orderBy('last_name')->pluck('last_name', 'id');

        return view('collection_round.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
//        dd(request());
//        $latestRound = CollectionRound::latest()->first();

//        CollectionRound::create([
//            'round_date' => !$latestRound ? now() : Carbon::parse($latestRound->round_date)->addDays(1),
//            'user_id' => Auth::user()->id,
//        ]);

//        $latestRound->is_completed = true;

        $request->validate(['round_date' => 'date']);

        CollectionRound::create(request(['round_date', 'user_id']));

        return redirect()->route('collection-rounds.index');
    }

    public function startRound(Request $request)
    {
        $roundId = $request->get('round_id');

        $bundles = Bundle::where('round_id', $roundId);

        foreach ($bundles as $bundle) {
            $bundle->bundle_status_id = BundleStatus::where('name', 'Being collected')->value('id');

            $products = Product::where('bundle_id', $bundle->id);

            foreach ($products as $product) {
                $product->product_status_id = ProductStatus::where('name', 'Being collected')->value('id');
            }
        }

        return redirect()->route('collection-rounds.bundles', $roundId)->with('success', "The collection round has been successfully launched!");
    }

    public function closeRound(Request $request)
    {
        $roundId = $request->get('round_id');

        $bundles = Bundle::where('round_id', $roundId);

        foreach ($bundles as $bundle) {
            $bundle->bundle_status_id = BundleStatus::where('name', 'Collected')->value('id');

            $products = Product::where('bundle_id', $bundle->id);

            foreach ($products as $product) {
                $product->product_status_id = ProductStatus::where('name', 'Stored')->value('id');
            }
        }

        return redirect()->route('collection-rounds')->with('success', "The collection round has been successfully marked as completed!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
