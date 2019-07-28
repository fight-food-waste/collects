<?php

namespace App\Http\Controllers\Auth;

use App\Address;
use App\Donor;
use App\Forms\DonorForm;
use App\Forms\NeedyPersonForm;
use App\Forms\StoreKeeperForm;
use App\Http\Controllers\Controller;
use App\NeedyPerson;
use App\Storekeeper;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the registration dispatcher (choose user type)
     *
     * @return View
     */
    public function showRegistrationDispatcher()
    {
        return view('auth.register.dispatch');
    }

    /**
     * Show Donor registration form
     *
     * @param FormBuilder $formBuilder
     *
     * @return View
     */
    public function createDonor(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(DonorForm::class, [
            'method' => 'POST',
            'url' => route('register.donor.store'),
        ]);

        return view('auth.register.form', compact('form'));
    }

    /**
     * Show NeedyPerson registration form
     *
     * @param FormBuilder $formBuilder
     *
     * @return View
     */
    public function createNeedyPerson(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(DonorForm::class, [
            'method' => 'POST',
            'url' => route('register.needyperson.store'),
        ]);

        return view('auth.register.form', compact('form'));
    }

    /**
     * Show StoreKeeper registration form
     *
     * @param FormBuilder $formBuilder
     *
     * @return View
     */
    public function createStoreKeeper(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(DonorForm::class, [
            'method' => 'POST',
            'url' => route('register.storekeeper.store'),
        ]);

        return view('auth.register.form', compact('form'));
    }

    /**
     * Store Donor if valid
     *
     * @param FormBuilder $formBuilder
     *
     * @return RedirectResponse
     */
    public function storeDonor(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(DonorForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $user_attributes = $form->getFieldValues();

        $address = Address::create($user_attributes);

        // Compute closest warehouse
        $address->closest_warehouse_id = $address->computeClosestWarehouse();
        $address->save();

        $user_attributes += ['address_id' => $address->id];
        $user_attributes['password'] = Hash::make($user_attributes['password']);

        $member = Donor::create($user_attributes);

        Auth::login($member);

        return redirect(route('home'))->with('success', 'Registration successful!');
    }

    /**
     * Create a new Donor instance after a valid registration.
     * And redirect to home page
     *
     * @param FormBuilder $formBuilder
     *
     * @return RedirectResponse
     */
    public function storeNeedyPerson(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(NeedyPersonForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $user_attributes = $form->getFieldValues();

        $address = Address::create($user_attributes);

        $user_attributes += ['address_id' => $address->id];
        $user_attributes['password'] = Hash::make($user_attributes['password']);

        $member = NeedyPerson::create($user_attributes);

        Auth::login($member);

        return redirect(route('home'))->with('success', 'Registration successful!');
    }

    /**
     * Create a new Donor instance after a valid registration.
     * And redirect to home page
     *
     * @param FormBuilder $formBuilder
     *
     * @return RedirectResponse
     */
    public function storeStorekeeper(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(StoreKeeperForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $user_attributes = $form->getFieldValues();

        $address = Address::create($user_attributes);

        $user_attributes += ['address_id' => $address->id];
        $user_attributes['password'] = Hash::make($user_attributes['password']);

        $member = Storekeeper::create($user_attributes);

        Auth::login($member);

        return redirect(route('home'))->with('success', 'Registration successful!');
    }
}
