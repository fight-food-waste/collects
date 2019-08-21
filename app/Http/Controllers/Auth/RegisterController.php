<?php

namespace App\Http\Controllers\Auth;

use App\Address;
use App\Donor;
use App\Forms\DonorForm;
use App\Forms\NeedyPersonForm;
use App\Forms\StorekeeperForm;
use App\Http\Controllers\Controller;
use App\NeedyPerson;
use App\Storekeeper;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Routing\Redirector;
use Kris\LaravelFormBuilder\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
     * Workaround to create Form based on slug
     *
     * @param Request     $request
     * @param FormBuilder $formBuilder
     * @return Form|null
     */
    private function createForm(Request $request, FormBuilder $formBuilder): ?Form
    {
        switch ($request->route('slug')) {
            case "donor":
                $form = $formBuilder->create(DonorForm::class);
                break;
            case "storekeeper";
                $form = $formBuilder->create(StorekeeperForm::class);
                break;
            case "needyperson":
                $form = $formBuilder->create(NeedyPersonForm::class);
                break;
        }

        return $form;
    }

    /**
     * Display User registration form based on slug
     *
     * @param Request     $request
     * @param FormBuilder $formBuilder
     *
     * @return View
     */
    public function createUser(Request $request, FormBuilder $formBuilder)
    {
        $form = $this->createForm($request, $formBuilder);

        $form->setMethod('POST');
        $form->setUrl(route("register.{$form->getRequest()->route('slug')}.store"));

        return view('auth.register.form', compact('form'));
    }

    /**
     * Store User based on slug
     *
     * @param Request     $request
     * @param FormBuilder $formBuilder
     * @return RedirectResponse|Redirector
     */
    public function storeUser(Request $request, FormBuilder $formBuilder)
    {
        $form = $this->createForm($request, $formBuilder);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $user_attributes = $form->getFieldValues();

        $address = new Address($user_attributes);

        if (!$address->isReal()) {
            return redirect()->back()->with('error', __('flash.register_controller.address_not_real'))->withInput();
        }

        $address->save();

        $user_attributes += ['address_id' => $address->id];
        $user_attributes['password'] = Hash::make($user_attributes['password']);

        switch ($form->getRequest()->route('slug')) {
            case "donor":
                $user_attributes['status'] = 1; // approved by default
                $user = Donor::create($user_attributes);
                break;
            case "storekeeper";
                $store_ownership_proof = $user_attributes['store_ownership_proof'];
                $filename = uniqid() . ".pdf";
                $store_ownership_proof->storeAs('store_ownership_proofs', $filename);
                $user_attributes['application_filename'] = $filename;

                $user = Storekeeper::create($user_attributes);
                break;
            case "needyperson":
                // Upload application file
                $application_file = $user_attributes['application_file'];
                $filename = uniqid() . ".pdf";
                $application_file->storeAs('application_files', $filename);
                $user_attributes['application_filename'] = $filename;

                $user = NeedyPerson::create($user_attributes);
                break;
        }

        Mail::raw('Welcome to Fight Food Waste!',
        function ($message) use ($user) {
            $message->from('noreply@fight-food-waste.com', 'Fight Food Waste')
                ->to($user->email)
                ->subject('Welcome to Fight Food Waste!');
        });

        Auth::login($user);

        return redirect(route('home'))->with('success', __('flash.register_controller.register_success'));
    }
}
