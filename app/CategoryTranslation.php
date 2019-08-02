<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'lang'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
