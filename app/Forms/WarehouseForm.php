<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class WarehouseForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', Field::TEXT, [
                'rules' => 'required|string|min:3',
                'label' => __('admin.warehouses.columns.name'),
                'value' => empty($this->data) ? null : $this->data['name'],
            ])
            ->add('address', Field::TEXT, [
                'rules' => 'required|string|min:3',
                'label' => __('admin.warehouses.columns.address'),
                'value' => empty($this->data) ? null : $this->data['address'],
            ])
            ->add('submit', Field::BUTTON_SUBMIT, [
                'label' => __('admin.warehouses.submit'),
            ]);
    }
}
