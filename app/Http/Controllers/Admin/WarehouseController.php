<?php

namespace App\Http\Controllers\Admin;

use App\Forms\WarehouseForm;
use App\Shelf;
use App\Warehouse;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use Kris\LaravelFormBuilder\FormBuilder;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display with with all the Warehouses
     *
     * @return Factory|View
     */
    public function index()
    {
        $warehouses = Warehouse::all();

        return view('admin.warehouses.index', compact('warehouses'));
    }

    /**
     * Display new Warehouse form
     *
     * @param FormBuilder $formBuilder
     *
     * @return Factory|View
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(WarehouseForm::class, [
            'method' => 'POST',
            'url' => route('admin.warehouses.store'),
        ]);

        return view('admin.warehouses.create', compact('form'));
    }

    /**
     * Store the new Warehouse in database with its fifty shelves associated
     *
     * @param FormBuilder $formBuilder
     *
     * @return RedirectResponse
     */
    public function store(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(WarehouseForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $warehouse = Warehouse::create($form->getFieldValues());

        for ($i = 1; $i <= 50; $i++) {
            Shelf::create([
                'number' => $i,
                'warehouse_id' => $warehouse->id,
            ]);
        }

        return redirect(route('admin.warehouses.index'))->with('success', __('flash.admin.warehouse_controller.store_success'));
    }

    /**
     * Display Warehouse edit form
     *
     * @param Request $request
     * @param FormBuilder $formBuilder
     *
     * @return Factory|View
     */
    public function edit(Request $request, FormBuilder $formBuilder)
    {
        $warehouse = Warehouse::find($request->route('id'));

        $form = $formBuilder->create(WarehouseForm::class, [
            'method' => 'PUT',
            'url' => route('admin.warehouses.update', $warehouse->id),
        ], [
            'name' => $warehouse->name,
            'address' => $warehouse->address,
        ]);

        return view('admin.warehouses.edit', compact('form'));
    }

    /**
     * Update Warehouse information with submitted data
     *
     * @param Request $request
     * @param FormBuilder $formBuilder
     *
     * @return RedirectResponse
     */
    public function update(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(WarehouseForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $warehouse = Warehouse::find($request->route('id'));
        $attributes = $form->getFieldValues();

        $warehouse->name = $attributes['name'];
        $warehouse->address = $attributes['address'];

        $warehouse->save();

        return redirect()->back()->with('success', __('flash.admin.warehouse_controller.update_success'));
    }

    /**
     * Delete Warehouse
     *
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public function destroy(Request $request)
    {
        try {
            Warehouse::find($request->input('warehouse_id'))->delete();
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with('error', __('flash.admin.warehouse_controller.destroy_error'));
        }

        return redirect()->back()->with('success', __('flash.admin.warehouse_controller.destroy_success'));
    }
}
