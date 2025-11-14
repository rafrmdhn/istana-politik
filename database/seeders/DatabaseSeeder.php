<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories = [
            ['name' => 'Daerah', 'slug' => 'daerah', 'status' => 1],
            ['name' => 'Nasional', 'slug' => 'nasional', 'status' => 1],
            ['name' => 'Opini', 'slug' => 'opini', 'status' => 1],
        ];

        // foreach ($categories as $category) {
        //     Category::create($category);
        // }

        $this->call([
            AdSeeder::class,
        ]);
    }
}
