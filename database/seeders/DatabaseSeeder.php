<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // UserSeeder::class,
            \Modules\Categories\Database\Seeders\CategoriesDatabaseSeeder::class,
            \Modules\Articles\Database\Seeders\ArticlesDatabaseSeeder::class,
        ]);
    }
}
