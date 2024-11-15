<?php

namespace Modules\Articles\Database\factories;

use Illuminate\Support\Str;
use Modules\Articles\Entities\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Articles\Entities\Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence();
        return [
            'category_id' => null, 
            'author_id' => null, 
            'slug' => Str::slug($title),
            'status' => $this->faker->boolean(),
        ];
    }

    public function withTranslations()
    {
        return $this->afterCreating(function (Article $article) {

            $article->translateOrNew('en')->title = $this->faker->sentence();
            $article->translateOrNew('en')->content = $this->faker->paragraphs(3, true);
            
            $article->translateOrNew('ar')->title = 'عربي ' . $this->faker->sentence();
            $article->translateOrNew('ar')->content = 'محتوى عربي ' . $this->faker->paragraphs(3, true);
            
            $article->save();
        });
    }
}

