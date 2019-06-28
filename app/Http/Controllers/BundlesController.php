<?php

namespace App\Http\Controllers;

use App\Bundle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BundlesController extends Controller
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
        $bundles = Bundle::all();

        return view('bundle.index', compact('bundles'));
    }

    public function validateBundle($id)
    {
        $bundle = Bundle::where('id', $id)->first();

        $bundle->validated_at = Carbon::now();
        $bundle->lifecycle_status = 'to_collect';

        $bundle->save();

        return redirect()->route('bundles.index');
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
