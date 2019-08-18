<?php

namespace App\Forms;

use App\Warehouse;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class TruckForm extends Form
{
    public function buildForm()
    {
        $warehouses = Warehouse::get(['id', 'name'])->pluck('name', 'id')->all();

        $this
            ->add('warehouse', Field::SELECT, [
                'rules' => 'required|int|exists:warehouses,id',
                'choices' => $warehouses,
                'empty_value' => __('admin.collection_rounds.select_warehouse'),
                'label' => __('admin.trucks.columns.warehouse'),
                'value' => empty($this->data) ? null : $this->data['warehouse'],
            ])
            ->add('capacity', Field::TEXT, [
                'rules' => 'required|int',
                'label' => __('admin.trucks.columns.capacity'),
                'value' => empty($this->data) ? null : $this->data['capacity'],
            ])
            ->add(__('admin.trucks.submit'), Field::BUTTON_SUBMIT);
    }
}
