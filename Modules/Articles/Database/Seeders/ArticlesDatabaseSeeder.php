<?php

namespace Modules\Articles\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Articles\Entities\Article;
use Illuminate\Database\Eloquent\Model;
use Modules\Categories\Entities\Category;

class ArticlesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        $users = User::all();
        $categories = Category::all();

        Article::factory()
            ->count(20)
            ->state(function () use ($users, $categories) {
                return [
                    'category_id' => $categories->random()->id,
                    'author_id' => $users->random()->id,
                ];
            })
            ->withTranslations()
            ->create();
    }
}
