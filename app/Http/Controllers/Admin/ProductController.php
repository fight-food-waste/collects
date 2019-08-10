<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display view with all the Products
     *
     * @return Factory|View
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }
}
