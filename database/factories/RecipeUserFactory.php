<?php

namespace Database\Factories;

use App\Models\RecipeUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RecipeUser>
 */
class RecipeUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>1,
            'recipe_id'=>1,
            'added_at'=>now(),
        ];
    }
}
