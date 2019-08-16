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
                'label' => __('signup.first_name'),
                'value' => empty($this->data) ? null : $this->data['first_name'],
            ])
            ->add('last_name', Field::TEXT, [
                'rules' => 'required|string|min:3',
                'label' => __('signup.last_name'),
                'value' => empty($this->data) ? null : $this->data['last_name'],
            ])
            ->add('street', Field::TEXT, [
                'rules' => 'required|string|min:10',
                'label' => __('signup.street'),
                'value' => empty($this->data) ? null : $this->data['street'],
            ])
            ->add('zip_postal_code', Field::TEXT, [
                'rules' => 'required|postal_code:FR',
                'label' => __('signup.zip_postal_code'),
                'value' => empty($this->data) ? null : $this->data['zip_postal_code'],
            ])
            ->add('city', Field::TEXT, [
                'rules' => 'required|string|min:2',
                'label' => __('signup.city'),
                'value' => empty($this->data) ? null : $this->data['city'],
            ])
            ->add('email', Field::EMAIL, [
                'rules' => 'required|email',
                'label' => __('signup.email'),
                'value' => empty($this->data) ? null : $this->data['email'],
            ])
            ->add('password', Field::PASSWORD, [
                'rules' => 'required|string|min:8|confirmed',
                'label' => __('signup.password'),
            ])
            ->add('password_confirmation', Field::PASSWORD, [
                'label' => __('signup.password_confirmation'),
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => __('signup.submit'),
            ]);
    }
}
