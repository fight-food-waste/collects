<?php

namespace App\Forms;

use App\Warehouse;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class CollectionRoundForm extends Form
{
    public function buildForm()
    {
        $warehouses = Warehouse::get(['id', 'name'])->pluck('name', 'id')->all();

        $this
            ->add(__('admin.collection_rounds.warehouse'), Field::SELECT, [
                'rules' => 'required|int|exists:warehouses,id',
                'choices' => $warehouses,
                'empty_value' => __('admin.collection_rounds.select_warehouse'),
            ])
            ->add(__('admin.collection_rounds.new_collection_round_button'), Field::BUTTON_SUBMIT);
    }
}
