<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'demo@example.com',
            'is_admin' => true,
        ]);

        User::factory()->create([
            'name' => 'User 1'
        ]);

        User::factory()->create([
            'name' => 'User 2'
        ]);

        User::factory()->create([
            'name' => 'User 3'
        ]);
    }
}
