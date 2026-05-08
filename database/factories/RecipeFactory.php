<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use PharIo\Manifest\Author;

/**
 * @extends Factory<Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraph(),
            'image' => 'https://loremflickr.com/640/480/food?lock=' . $this->faker->numberBetween(1, 100000),
            'category_id' => Category::factory(),
            'author_id' => User::factory(),
            'cooking_time' => $this->faker->numberBetween(10, 130),
            'servings' => $this->faker->numberBetween(1, 6),
            'difficulty' => $this->faker->randomElement(['легко', 'нормально', 'сложно']),
            'rating' => rand(1, 5),
            'rating_count' => rand(1, 8),
            'is_published' => true
        ];
    }
}
