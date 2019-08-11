<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class EmployeeForm extends Form
{
    public function buildForm()
    {
        $this
            ->add(__('signup.first_name'), Field::TEXT, [
                'rules' => 'required|string|min:3',
            ])
            ->add(__('signup.last_name'), Field::TEXT, [
                'rules' => 'required|string|min:3',
            ])
            ->add(__('signup.street'), Field::TEXT, [
                'rules' => 'required|string|min:10',
            ])
            ->add(__('signup.zip_postal_code'), Field::TEXT, [
                'rules' => 'required|postal_code:FR',
            ])
            ->add(__('signup.city'), Field::TEXT, [
                'rules' => 'required|string|min:2',
            ])
            ->add(__('signup.email'), Field::EMAIL, [
                'rules' => 'required|email',
            ])
            ->add(__('signup.password'), Field::PASSWORD, [
                'rules' => 'required|string|min:8|confirmed',
            ])
            ->add(__('signup.password_confirmation'), Field::PASSWORD)
            ->add(__('signup.submit'), Field::BUTTON_SUBMIT);
    }
}
