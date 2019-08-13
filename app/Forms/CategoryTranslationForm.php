<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class CategoryTranslationForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('en', Field::TEXT, [
                'rules' => 'required|string|min:3',
                'label' => 'English',
                'value' => empty($this->data) ? null : $this->data['en'],
            ])
            ->add('fr', Field::TEXT, [
                'rules' => 'required|string|min:3',
                'label' => 'Français',
                'value' => empty($this->data) ? null : $this->data['fr'],
            ])
            ->add('Submit', Field::BUTTON_SUBMIT, [
                'label' => __('form.submit'),
            ]);
    }
}
