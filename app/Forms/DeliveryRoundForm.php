<?php

namespace App\Forms;

use App\Warehouse;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class DeliveryRoundForm extends Form
{
    public function buildForm()
    {
        $warehouses = Warehouse::get(['id', 'name'])->pluck('name', 'id')->all();

        $this
            ->add('warehouse', Field::SELECT, [
                'rules' => 'required|int|exists:warehouses,id',
                'choices' => $warehouses,
                'empty_value' => 'Select a warehouse',
            ])
            ->add('New delivery round', Field::BUTTON_SUBMIT);
    }
}
