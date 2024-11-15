<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::factory()->create([
            'email' => 'admin@example.com',
            'account_type' => 'admin',
            'admin_group_id' => 1,
        ]);

        User::factory(10)->create();
    }
}
