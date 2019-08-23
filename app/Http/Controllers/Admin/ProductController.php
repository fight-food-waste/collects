<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use App\Forms\ProductsCategoryAdminForm;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Warehouse;

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
        $form = $formBuilder->create(ProductsCategoryAdminForm::class, [
            'method' => 'GET',
            'url' => route('admin.products.index'),
        ], [
            'category_id' => $request->input('category') !== null ? $request->input('category') : null,
            'warehouse_id' => $request->input('warehouse') !== null ? $request->input('warehouse') : null,
            'in_supply' => $request->input('in_supply') !== null ? $request->input('in_supply') : null,
        ]);

        $products = Product::all();

        if ($request->input('category') !== null) {
            $category = Category::findOrFail($request->input('category'));

            $products = $products->intersect($category->products);
        }

        if ($request->input('warehouse') !== null) {
            $warehouse = Warehouse::findOrFail($request->input('warehouse'));

            $warehouseProducts = collect();

            foreach ($warehouse->shelves as $shelf) {
                $warehouseProducts = $warehouseProducts->concat($shelf->products);
            }

            $products = $products->intersect($warehouseProducts);
        }

        if ($request->input('in_supply') !== null) {
            if ($request->input('in_supply') == 1) {
                $products = $products->where('status', 1);
            } elseif ($request->input('in_supply') == 2) {
                $products = $products->where('status', '!=', '1');
            }
        }

        return view('admin.products.index', compact('products', 'form'));
    }

    /**
     * Throw a product.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function reject(Product $product)
    {
        $product->status = -1;
        $product->shelf_id = null;
        $product->save();

        return redirect()->back()->with('success', __('flash.admin.products_controller.reject_success'));
    }
}
