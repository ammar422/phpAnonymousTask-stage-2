<?php

namespace Modules\Article\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model implements TranslatableContract
{
    use Translatable , SoftDeletes;

    protected $fillable = [
        'category_id',
        'slug',
        'status',
        'author_id'
    ];
    public $translatedAttributes = [
        'title',
        'content'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }




    // protected static function newFactory()
    // {
    //     return \Modules\Article\Database\factories\ArticleFactory::new();
    // }

}
