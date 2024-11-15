<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'description'
    ];

    // protected static function newFactory()
    // {
    //     return \Modules\Category\Database\factories\CategoryTranslationFactory::new();
    // }
}
