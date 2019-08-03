<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    public function translation(string $lang)
    {
        return $this->translations()->where('lang', $lang)->first();
    }
}
