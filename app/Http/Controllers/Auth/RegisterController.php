<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Address;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'line_1' => ['required', 'string', 'max:100'],
                'line_2' => ['sometimes', 'required', 'string', 'max:100'],
                'line_3' => ['sometimes', 'required', 'string', 'max:100'],
                'county_province' => ['required', 'string', 'max:60'],
                'region' => ['required', 'string', 'max:60'],
                'zip_postal_code' => ['required', 'string', 'max:10'],
                'country' => ['required', 'string', 'max:100'],
                'terms' => ['required'],
            ],
            [
                'terms.required' => 'Please agree to terms to continue',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        // Method 1
        // $address = new Address();

        // $address->line_1 = $data['line_1'];
        // $address->line_2 = isset($data['line_2']) ? $data['line_2'] : null;
        // $address->line_3 = isset($data['line_3']) ? $data['line_3'] : null;
        // $address->county_province = $data['county_province'];
        // $address->region = $data['region'];
        // $address->zip_postal_code = $data['zip_postal_code'];
        // $address->country = $data['country'];

        // $address->save();

        // Method 2
        $address = Address::create([
            "line_1" => $data['line_1'],
            "line_2" => isset($data['line_2']) ? $data['line_2'] : null,
            "line_3" => isset($data['line_3']) ? $data['line_3'] : null,
            "county_province" => $data['county_province'],
            "region" => $data['region'],
            "zip_postal_code" => $data['zip_postal_code'],
            "country" => $data['country'],
        ]);

        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'address_id' => $address->id,
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * Override RegistersUsers->register() to not login right away
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->create($request->all());

        // return back()->with('success', 'User created successfully.');

        $request->session()->flash('success', 'User created successfully.');

        return redirect($this->redirectPath());
    }
}
