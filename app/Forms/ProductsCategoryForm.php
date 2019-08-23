<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;
use App\CategoryTranslation;
use App\Warehouse;

class ProductsCategoryForm extends Form
{
    public function buildForm()
    {
        $lang = session()->get('locale') === null ? config('app.fallback_locale') : session()->get('locale');

        $categories = CategoryTranslation::where('lang', $lang)
            ->get(['category_id', 'name'])
            ->pluck('name', 'category_id')
            ->all();

        $warehouses = Warehouse::get(['id', 'name'])->pluck('name', 'id')->all();

        $this
            ->add('category', Field::SELECT, [
                'rules' => 'int|exists:category_translations,id',
                'choices' => $categories,
                'selected' => $this->data['category_id'] === null ? null : $this->data['category_id'],
                'empty_value' => __('form.products_filter_form.category.select'),
                'label' => __('form.products_filter_form.category.label'),
            ])
            ->add('warehouse', Field::SELECT, [
                'rules' => 'int|exists:warehouses,id',
                'choices' => $warehouses,
                'selected' => $this->data['warehouse_id'] === null ? null : $this->data['warehouse_id'],
                'empty_value' => __('form.products_filter_form.warehouse.select'),
                'label' => __('form.products_filter_form.warehouse.label'),
            ])
            ->add('in_supply', Field::SELECT, [
                'rules' => 'int|required|min:1|max:2',
                'choices' => [
                    1 => __('form.products_filter_form.in_supply.1'),
                    2 => __('form.products_filter_form.in_supply.2'),
                    3 => __('form.products_filter_form.in_supply.3'),
                ],
                'selected' => $this->data['in_supply'] === null ? null : $this->data['in_supply'],
                'empty_value' => __('form.products_filter_form.in_supply.select'),
                'label' => __('form.products_filter_form.in_supply.label'),
            ])
            ->add(__('form.submit'), Field::BUTTON_SUBMIT);
    }
}
