<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\StoreDonor;
use App\Http\Requests\StoreNeedyPerson;
use App\Http\Requests\StoreStorekeeper;
use App\NeedyPerson;
use App\Donor;
use App\Address;
use App\Http\Controllers\Controller;
use App\Storekeeper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\View\View;


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
        return view('auth.register.dispatch');
    }


    public function newAddress(Request $request)
    {
        return Address::create(request([
            "line_1",
            "line_2",
            "line_3",
            "county_province",
            "region",
            "zip_postal_code",
            "country",
        ]));
    }

    /**
     * Create a new Donor instance after a valid registration.
     * And redirect to home page
     *
     * @param StoreDonor $request
     * @return RedirectResponse
     */
    public function storeDonor(StoreDonor $request)
    {

        $user_attributes = $request->validated();

        $address = $this->newAddress($request);

        $user_attributes += ['address_id' => $address->id];

        $user_attributes['password'] = Hash::make($user_attributes['password']);

        Donor::create($user_attributes);

        return redirect($this->redirectPath())->with('success', 'User created successfully.');
    }

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
