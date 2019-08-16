<?php

namespace App\Http\Controllers;

use App\Address;
use App\Forms\DonorForm;
use App\Forms\EmployeeForm;
use App\Forms\NeedyPersonForm;
use App\Forms\StorekeeperForm;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the User's account page containing his information
     *
     * @param Request $request
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        return view('account.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Show User account edit page
     *
     * @param FormBuilder $formBuilder
     *
     * @return Factory|View
     */
    public function edit(FormBuilder $formBuilder)
    {
        $user = Auth::user();

        $address = $user->address;

        $form = $formBuilder->create($this->getUserFormClass($user->type), [
            'method' => 'PUT',
            'url' => route('account.update'),
        ], [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'street' => $address->street,
            'zip_postal_code' => $address->zip_postal_code,
            'city' => $address->city,
        ]);

        return view('account.edit', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * Update User information with data submitted
     *
     * @param Request $request
     * @param FormBuilder $formBuilder
     *
     * @return RedirectResponse
     */
    public function update(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create($this->getUserFormClass($request->user()->type));

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $user = $request->user();
        $attributes = $form->getFieldValues();

        $user->first_name = $attributes['first_name'];
        $user->last_name = $attributes['last_name'];
        $user->email = $attributes['email'];

        $newAddress = new Address($attributes);

        if (!$newAddress->isReal()) {
            return redirect()->back()->with('error', __('flash.register_controller.address_not_real'))->withInput();
        }

        $newAddress->save();

        $user->address_id = $newAddress->id;

        $attributes['password'] = Hash::make($attributes['password']);

        $user->save();

        return redirect()->back()->with('success', "Your account has been successfully updated!");
    }

    /**
     * Delete User with all its Bundles and Products associated
     *
     * @return Response
     * @throws Exception
     */
    public function destroy()
    {
        $user = Auth::user();

        if ($user->bundles && $user->bundles->isNotEmpty()) {
            foreach ($user->bundles as $bundle) {
                $bundle->products->each->delete();
            }

            $user->bundles->each->delete();
        }

        try {
            $user->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', __('flash.account_controller.destroy_error'));
        }

        auth()->logout();

        return redirect('login')->with('success', __('flash.account_controller.destroy_success'));
    }

    /**
     * Get User Form class according to his or her type
     *
     * @param String $userType
     *
     * @return string|null
     */
    private function getUserFormClass(String $userType)
    {
        switch ($userType) {
            case 'donor':
                return DonorForm::class;
            case 'storekeeper';
                return StorekeeperForm::class;
            case 'needyperson':
                return NeedyPersonForm::class;
            case 'employee':
                return EmployeeForm::class;
        }

        return null;
    }
}
