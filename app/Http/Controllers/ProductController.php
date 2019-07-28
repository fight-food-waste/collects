<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Delete Product
     *
     * @param Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        try {
            Product::findOrFail($request->input('product_id'))->delete();
        }
        catch (Exception $e) {
            return redirect()->back()->with('error', "The product could not be deleted.");
        }

        return redirect()->back()->with('success', "The product has been successfully deleted.");
    }
}
