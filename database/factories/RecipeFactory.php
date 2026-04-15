<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'image' => 'https://loremflickr.com/640/480/food?lock=' . fake()->numberBetween(1, 100000),
            'category_id' => 1,
            'author_id' => 1,
            'cooking_time' => $this->faker->numberBetween(10, 130),
            'servings' => $this->faker->numberBetween(1, 6),
            'difficulty' => $this->fake->randomElement(['easy', 'medium', 'hard']),
            'rating' => null,
            'rating_count' => 0,
            'is_published' => true
        ];
    }
}
