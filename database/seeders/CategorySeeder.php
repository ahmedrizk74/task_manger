<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Work', 'description' => 'Tasks related to work or career.'],
            ['name' => 'Personal', 'description' => 'Personal life and self improvement tasks.'],
            ['name' => 'Shopping', 'description' => 'Grocery or product shopping list.'],
            ['name' => 'Fitness', 'description' => 'Workout and health related tasks.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
