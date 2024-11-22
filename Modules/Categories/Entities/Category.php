<?php

namespace Modules\Categories\Entities;

use App\Models\User;
use Modules\Articles\Entities\Article;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Categories\Database\factories\CategoryFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Attribute;
use Dash\Models\FileManagerModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable, SoftDeletes;

    protected $fillable = [
        'slug',
        'status',
        'owner_id'
    ];

    public $translatedAttributes = [
        'name',
        'description'
    ];




    public function getStatusAttribute($status){
        return $status == true ? 'active' : 'inactive' ;
    }



    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }

    // subscribers
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'category_id', 'id');
    }
    
    // owner
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }


    public function files(): MorphMany
    {
        return $this->morphMany(FileManagerModel::class, 'file');
    }
}
