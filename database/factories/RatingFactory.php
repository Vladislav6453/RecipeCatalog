<?php

namespace Database\Factories;

use App\Models\Rating;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'recipe_id' => 1,
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
