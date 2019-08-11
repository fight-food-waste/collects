<?php

namespace App\Http\Controllers\Api;

use App\Bundle;
use App\Http\Controllers\Controller;
use App\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{

    /**
     * Show product information only if it was originally the user's
     *
     * @param Request $request
     *
     * @return Product|Product[]|Collection|Model|JsonResponse|null
     */
    public function show(Request $request)
    {
        $product = Product::findOrFail($request->route('id'));

        if ($product->bundle()->value('user_id') == $request->user()->value('id')) {
            return $product;
        } else {
            return response()->json([
                'error' => 'You are not authorised to access this product',
            ], 403);
        }
    }

    /**
     * Store product and add to open bundle if valid
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
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
            $data['expiration_date'] = new Carbon($data['expiration_date']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid expiration date format'], 400);
        }

        $bundle = Bundle::findOrFail($data['bundle_id']);
        if ($bundle->isClosed()) {
            return response()->json(['error' => 'You can\'t add products to this bundle anymore'], 400);
        }

        try {
            $product = Product::create($data);
        } catch (Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
        }

        return response()->json(['success' => true, 'id' => $product->id], 200);
    }

    /**
     * Show all product that are available
     */
    public function showFromStock()
    {
        return Product::where('status', 1)->get();
    }
}
