<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use App\Forms\ProductsCategoryForm;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display view with all the Products
     *
     * @param FormBuilder $formBuilder
     * @param Request     $request
     * @return Factory|View
     */
    public function index(FormBuilder $formBuilder, Request $request)
    {

        $form = $formBuilder->create(ProductsCategoryForm::class, [
            'method' => 'GET',
            'url' => route('admin.products.index'),
        ], [
            'category_id' => $request->input('category') !== null ? $request->input('category') : null,
        ]);


        if ($request->input('category') !== null) {
            $category = Category::findOrFail($request->input('category'));

            $products = $category->products;
        } else {
            $products = Product::all();
        }

        return view('admin.products.index', compact('products', 'form'));
    }
}
