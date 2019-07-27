<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class DonorForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('first_name', Field::TEXT, [
                'rules' => 'required|string|min:3',
            ])
            ->add('last_name', Field::TEXT, [
                'rules' => 'required|string|min:3',
            ])
            ->add('street', Field::TEXT, [
                'rules' => 'required|string|min:10',
            ])
            ->add('zip_postal_code', Field::TEXT, [
                'rules' => 'required|postal_code:FR',
            ])
            ->add('city', Field::TEXT, [
                'rules' => 'required|string|min:2',
            ])
            ->add('email', Field::EMAIL, [
                'rules' => 'required|email',
            ])
            ->add('password', Field::PASSWORD, [
                'rules' => 'required|string|min:8|confirmed',
            ])
            ->add('password_confirmation', Field::PASSWORD)
            ->add('submit', Field::BUTTON_SUBMIT);
    }
}
