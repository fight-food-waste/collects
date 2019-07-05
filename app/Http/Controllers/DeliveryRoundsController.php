<?php

namespace App\Http\Controllers;

use App\DeliveryRound;
use App\NeedyPerson;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeliveryRoundsController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $round = DeliveryRound::create([
            'rounds_date' => today(),
            'user_id' => 3,
        ]);

//        $round = DeliveryRound::first();
        $currentUser = NeedyPerson::find(2);

        $round->needyPeople()->attach($currentUser->id);
        $currentUser->deliveryRounds()->attach($round->id);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        // Pieces of code for testing
        $round = DeliveryRound::find($id);

//        dd($round);
//        dd($round->needyPeople());
//        dd($round->needyPeople()->first()->first_name);

//        return $round->needyPeople()->first();
//
        return view('delivery_round.show', [
            'round' => $round,
            'needy_people' => $round->needyPeople()->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
