<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3), // عنوان عشوائي
            'description' => $this->faker->paragraph(), // وصف عشوائي
            'priority' => $this->faker->randomElement(['high', 'medium', 'low']), // الأولوية
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(), // مستخدم عشوائي
            // 'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(), // كاتيجوري عشوائي
        ];
    }
}
