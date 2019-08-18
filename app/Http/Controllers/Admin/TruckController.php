<?php

namespace App\Http\Controllers\Admin;

use App\Forms\TruckForm;
use App\Truck;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use Kris\LaravelFormBuilder\FormBuilder;

class TruckController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display view with all the Trucks
     *
     * @return Factory|View
     */
    public function index()
    {
        $trucks = Truck::all();

        return view('admin.trucks.index', compact('trucks'));
    }

    /**
     * Display new Truck form
     *
     * @param FormBuilder $formBuilder
     *
     * @return Factory|View
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(TruckForm::class, [
            'method' => 'POST',
            'url' => route('admin.trucks.store'),
        ]);

        return view('admin.trucks.create', compact('form'));
    }

    /**
     * Store the new Truck in database
     *
     * @param FormBuilder $formBuilder
     *
     * @return RedirectResponse|Redirector
     */
    public function store(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(TruckForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $attributes = $form->getFieldValues();

        Truck::create([
            'warehouse_id' => $attributes['warehouse'],
            'capacity' => $attributes['capacity'],
        ]);

        return redirect(route('admin.trucks.index'))->with('success', __('flash.admin.truck_controller.store_success'));
    }

    /**
     * Display Truck edit form
     *
     * @param Request $request
     * @param FormBuilder $formBuilder
     *
     * @return Factory|View
     */
    public function edit(Request $request, FormBuilder $formBuilder)
    {
        $truck = Truck::find($request->route('id'));

        $form = $formBuilder->create(TruckForm::class, [
            'method' => 'PUT',
            'url' => route('admin.trucks.update', $truck->id),
        ], [
            'warehouse' => $truck->warehouse_id,
            'capacity' => $truck->capacity,
        ]);

        return view('admin.trucks.edit', compact('form'));
    }

    /**
     * Update Truck information with submitted data
     *
     * @param Request $request
     * @param FormBuilder $formBuilder
     *
     * @return RedirectResponse
     */
    public function update(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(TruckForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $truck = Truck::find($request->route('id'));
        $attributes = $form->getFieldValues();

        $truck->warehouse_id = $attributes['warehouse'];
        $truck->capacity = $attributes['capacity'];

        $truck->save();

        return redirect()->back()->with('success', __('flash.admin.truck_controller.update_success'));
    }

    /**
     * Delete Truck
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        try {
            Truck::find($request->input('truck_id'))->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', __('flash.admin.truck_controller.destroy_error'));
        }

        return redirect()->back()->with('success', __('flash.admin.truck_controller.destroy_success'));
    }

}
