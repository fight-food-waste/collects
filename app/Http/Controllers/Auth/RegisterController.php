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
     * @param FormBuilder $formBuilder
     * @return Form|null
     */
    private function createForm(FormBuilder $formBuilder): ?Form
    {
        // Not very pretty...
        // See https://github.com/kristijanhusak/laravel-form-builder/issues/544
        $tmpForm = $formBuilder->plain();
        $request = $tmpForm->getRequest();

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
     * @param FormBuilder $formBuilder
     *
     * @return View
     */
    public function createUser(FormBuilder $formBuilder)
    {
        $form = $this->createForm($formBuilder);

        $form->setMethod('POST');
        $form->setUrl(route("register.{$form->getRequest()->route('slug')}.store"));

        return view('auth.register.form', compact('form'));
    }

    /**
     * Store User based on slug
     *
     * @param FormBuilder $formBuilder
     * @return RedirectResponse|Redirector
     */
    public function storeUser(FormBuilder $formBuilder)
    {
        $form = $this->createForm($formBuilder);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $user_attributes = $form->getFieldValues();

        $address = new Address($user_attributes);

        if (! $address->isReal()) {
            return redirect()->back()->with('error', 'The address you entered does not seem real.')->withInput();
        }

        $address->save();

        $user_attributes += ['address_id' => $address->id];
        $user_attributes['password'] = Hash::make($user_attributes['password']);

        switch ($form->getRequest()->route('slug')) {
            case "donor":
                $user = Donor::create($user_attributes);
                break;
            case "storekeeper";
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

        Auth::login($user);

        return redirect(route('home'))->with('success', 'Registration successful!');
    }
}
