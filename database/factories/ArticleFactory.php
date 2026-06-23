<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 1, 9999),
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'is_accepted' => true,
        ];
    }

    public function notAccepted(): static
    {
        return $this->state(fn () => ['is_accepted' => null]);
    }
}

