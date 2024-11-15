<?php

namespace Modules\Articles\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Modules\Categories\Entities\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Articles\Database\factories\ArticleFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Article extends Model implements TranslatableContract
{
    use Translatable , SoftDeletes , HasFactory;

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




    protected static function newFactory()
    {
        return ArticleFactory::new();
    }

}
