<?php

namespace Modules\Categories\Database\factories;

use Illuminate\Support\Str;
use Modules\Categories\Entities\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Categories\Entities\Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->words(2, true);
        return [
            'slug' => Str::slug($name),
            'status' => $this->faker->boolean(),
        ];
    }
    public function withTranslations()
    {
        return $this->afterCreating(function (Category $category) {
            $category->translateOrNew('en')->name = $this->faker->words(2, true);
            $category->translateOrNew('en')->description = $this->faker->paragraph();

            $category->translateOrNew('ar')->name = 'عربي ';
            $category->translateOrNew('ar')->description = 'وصف عربي ';

            $category->save();
        });
    }
}
