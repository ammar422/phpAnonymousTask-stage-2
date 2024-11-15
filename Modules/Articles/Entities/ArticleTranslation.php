<?php

namespace Modules\Article\Entities;

use Illuminate\Database\Eloquent\Model;

class ArticleTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'content'];

    // protected static function newFactory()
    // {
    //     return \Modules\Article\Database\factories\ArticleTranslationFactory::new();
    // }
}
