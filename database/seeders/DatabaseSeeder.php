<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Ingredient;
use App\Models\IngredientRecipe;
use App\Models\Rating;
use App\Models\Recipe;
use App\Models\RecipeStep;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'avatar' => 'avatar.png',
            'role' => 'admin',
        ]);
        $users = User::factory(20)->create();

        $categories = Category::factory(5)->create();
        $ingredients = Ingredient::factory(20)->create();

       // $recipes = Recipe::factory(120)->create();


        Recipe::factory(15)->create()->each(function ($recipe) use ($users, $ingredients, $categories) {
            $recipe->update(['author_id' => $users->random()->id,'category_id' => $categories->random()->id]);
            $selected = $ingredients->random(rand(3, 7));
            foreach ($selected as $ingredient) {
                $recipe->ingredients()->attach($ingredient->id, ['quantity' => rand(50, 500),'unit' => $ingredient->default_unit ?? 'г.'
                ]);
            }

            foreach (range(1, rand(1, 10)) as $i) {
                RecipeStep::create([
                    'recipe_id' => $recipe->id,
                    'step_number'=>$i,
                    'description' => fake()->sentence(),
                ]);
            }

            foreach (range(1, rand(2, 6)) as $i) {
                Comment::create([
                    'recipe_id' => $recipe->id,
                    'user_id' => $users->random()->id,
                    'body' => fake()->sentence(),
                ]);
            }

            $ratingUsers = $users->random(rand(3, 10))->unique('id');

            foreach ($ratingUsers as $user) {
                Rating::create([
                    'recipe_id' => $recipe->id,
                    'user_id' => $user->id,
                    'rating' => rand(1, 5)
                ]);
            }

            $avg = $recipe->ratings()->avg('rating');
            $recipe->update([
                'rating' => $avg ? round($avg,2) : 0,
                'rating_count' => $recipe->ratings()->count()
            ]);

/*            foreach ($users as $user) {
                $favorites = Recipe::inRandomOrder()
                    ->take(rand(1, 10))
                    ->pluck('id')
                    ->toArray();

                $user->favorites()->syncWithoutDetaching($favorites);
            }*/
        });


    }
}
