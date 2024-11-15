<?php

namespace Modules\Categories\Entities;

use Modules\Articles\Entities\Article;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Categories\Database\factories\CategoryFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable ,SoftDeletes;

    protected $fillable = [
        'slug',
        'status'
    ];

    public $translatedAttributes = [
        'name',
        'description'
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }
}
