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
                'empty_value' => __('admin.delivery_rounds.select_warehouse'),
                'label' => __('admin.delivery_rounds.select_warehouse'),
            ])
            ->add(__('admin.delivery_rounds.new_delivery_round'), Field::BUTTON_SUBMIT);
    }
}
