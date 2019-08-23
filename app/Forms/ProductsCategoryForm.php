<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;
use App\CategoryTranslation;

class ProductsCategoryForm extends Form
{
    public function buildForm()
    {
        $lang = session()->get('locale') === null ? config('app.fallback_locale') : session()->get('locale');

        $categories = CategoryTranslation::where('lang', $lang)
            ->get(['category_id', 'name'])
            ->pluck('name', 'category_id')
            ->all();

        $this
            ->add('category', Field::SELECT, [
                'rules' => 'int|exists:category_translations,id',
                'choices' => $categories,
                'selected' => $this->data['category_id'] === null ? null : $this->data['category_id'],
                'empty_value' => __('form.products_filter_form.category.select'),
                'label' => __('form.products_filter_form.category.label'),
            ])
            ->add(__('form.submit'), Field::BUTTON_SUBMIT);
    }
}
