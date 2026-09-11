<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(5);

        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => $title,
            'slug' => fake()->unique()->slug(),
            'excerpt' => fake()->sentence(12),
            'content' => fake()->paragraphs(4, true),
            'image' => null,
            'is_published' => fake()->boolean(),
        ];
    }
}