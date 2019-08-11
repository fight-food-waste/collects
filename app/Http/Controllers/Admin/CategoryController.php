<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Category;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\CategoryTranslationForm;
use App\CategoryTranslation;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display view with all the Categories
     *
     * @return Factory|View
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function edit(Category $category, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(CategoryTranslationForm::class, [], [
            'en' => $category->translation('en') === null ? '' : $category->translation('en')->name,
            'fr' => $category->translation('fr') === null ? '' : $category->translation('fr')->name,
        ]);
        $form->setMethod('PATCH');
        $form->setUrl(route('admin.categories.update', $category->id));

        return view('admin.categories.edit', compact('category', 'form'));
    }

    public function update(Category $category, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(CategoryTranslationForm::class);

        if (! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $attributes = $form->getFieldValues();

        $langs = ['en', 'fr'];

        foreach ($langs as $lang) {
            $translation = CategoryTranslation::firstOrNew([
                'lang' => $lang,
                'category_id' => $category->id,
            ]);

            $translation->name = $attributes[$lang];
            $translation->save();
        }

        return redirect()->back()->with('success', __('flash.admin.category_controller.category_updated_success'));
    }
}
