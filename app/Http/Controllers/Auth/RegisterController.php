<?php

namespace App\Http\Controllers\Auth;

use App\Address;
use App\Donor;
use App\Forms\DonorForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNeedyPerson;
use App\Http\Requests\StoreStorekeeper;
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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
     * Show the application registration form.
     *
     * @param string $userType
     * @return View
     */
    public function showRegistrationForm(string $userType)
    {
        return view('auth.register.' . $userType);
    }

    /**
     * Show the registration dispacther (choose user type)
     *
     * @return View
     */
    public function showRegistrationDispatcher()
    {
        return view('register.dispatch');
    }


    public function newAddress($attributes)
    {
//        dd($attributes);
        return Address::create($attributes);
    }

    /**
     * Show Donor registration form
     *
     * @param FormBuilder $formBuilder
     * @return View
     */
    public function createDonor(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(DonorForm::class, [
            'method' => 'POST',
            'url' => route('register.donor.store')
        ]);

        return view('register.form', compact('form'));
    }

    /**
     * Store Donor if valid
     *
     * @param FormBuilder $formBuilder
     * @return RedirectResponse
     */
    public function storeDonor(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(DonorForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $user_attributes = $form->getFieldValues();

        $address = $this->newAddress($user_attributes);

        $user_attributes += ['address_id' => $address->id];
        $user_attributes['password'] = Hash::make($user_attributes['password']);
        $user_attributes['status'] = "active";

        $member = Donor::create($user_attributes);

        Auth::login($member);

        return redirect($this->redirectPath())->with('success', 'Registration successful!');
    }

//    /**
//     * Create a new Donor instance after a valid registration.
//     * And redirect to home page
//     *
//     * @param StoreDonor $request
//     * @return RedirectResponse
//     */
//    public function storeDonor(StoreDonor $request)
//    {
//
//        $user_attributes = $request->validated();
//
//        $address = $this->newAddress($request);
//
//        $user_attributes += ['address_id' => $address->id];
//        $user_attributes['password'] = Hash::make($user_attributes['password']);
//
//        Donor::create($user_attributes);
//
//        return redirect($this->redirectPath())->with('success', 'User created successfully.');
//    }

    /**
     * Create a new Donor instance after a valid registration.
     * And redirect to home page
     *
     * @param StoreNeedyPerson $request
     * @return RedirectResponse
     */
    public function storeNeedyPerson(StoreNeedyPerson $request)
    {

        $user_attributes = $request->validated();

        $address = $this->newAddress($request);

        $user_attributes += ['address_id' => $address->id];

        $user_attributes['password'] = Hash::make($user_attributes['password']);

        NeedyPerson::create($user_attributes);

        return redirect($this->redirectPath())->with('success', 'User created successfully.');
    }

    /**
     * Create a new Donor instance after a valid registration.
     * And redirect to home page
     *
     * @param StoreStorekeeper $request
     * @return RedirectResponse
     */
    public function storeStorekeeper(StoreStorekeeper $request)
    {

        $user_attributes = $request->validated();

        $address = $this->newAddress($request);

        $user_attributes += ['address_id' => $address->id];

        $user_attributes['password'] = Hash::make($user_attributes['password']);

        Storekeeper::create($user_attributes);

        return redirect($this->redirectPath())->with('success', 'User created successfully.');
    }
}
