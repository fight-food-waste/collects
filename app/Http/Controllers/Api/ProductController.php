<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // TODO: validation

    public function index()
    {
        return Product::all();
    }

    public function show(Request $request)
    {
        $product = Product::find($request->route('id'));

        if ($product->bundle()->value('user_id') != $request->user()->value('id')) {
            return $product;
        } else {
            return response()->json([
                'error' => 'You are not authorised to access this product'], 403);
        }
    }

    public function store(Request $request)
    {
        // TODO: store https://world.openfoodfacts.org/api/v0/product/${value.barcode}.json to details attribute
        return Product::create($request->all());
    }

    public function showFromStock() {
        //TODO: rework status
        // return Product::where->('status'...)
    }
}
