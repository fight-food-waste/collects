<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'barcode' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'bundle_id' => 'required|integer|exists:bundles,id',
            'expiration_date' => 'required|date|after:today',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()->all()], 400);
        }

        $data = $validator->attributes();

        try {
            $client = new Client();
            $url = "https://world.openfoodfacts.org/api/v0/product/" . $data['barcode'] . "json";
            $response = $client->request('GET', $url);
            $product_details = (string)$response->getBody();

            $data['details'] = $product_details;
            $data['status'] = 1;

            $product = Product::create($data);

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
