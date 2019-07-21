<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
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
                'error' => 'You are not authorised to access this product'
            ], 403);
        }
    }

    public function store(Request $request)
    {
        $client = new Client();
        try {
            $url = "https://world.openfoodfacts.org/api/v0/product/" . $request->input('barcode') . "json";
            $response = $client->request('GET', $url);
            $product_details = (string)$response->getBody();

            $attr = $request->all();
            $attr['details'] = $product_details;
            $attr['status'] = 1;

            $product = Product::create($attr);

            return response()->json(array('success' => true, 'id' => $product->id), 200);
        } catch (GuzzleException $e) {
            return response()->json([
                'error' => 'Something went wrong when contacting the Open Food Facts API'
            ], 500);
        }
    }

    public function showFromStock()
    {
        //TODO: rework status
        // return Product::where->('status'...)
    }
}
