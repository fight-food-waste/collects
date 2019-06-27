<?php

namespace App\Http\Controllers;

use App\Bundle;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BundleProductsController extends Controller
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
        return view('bundle.products.show', []);
    }

    public function productsList($id)
    {
        $products = Product::where('bundle_id', $id)->get();

        return view('bundle.products_list.show', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
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
