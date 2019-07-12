<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // TODO: Add auth middleware
    // TODO: validation

    public function index()
    {
        return Product::all();
    }

    public function show($id)
    {
        // TODO: check that the product's bundle belongs to the user
        return Product::find($id);
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
