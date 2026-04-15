<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Rating;
use App\Models\Recipe;
use App\Models\RecipeStep;
use App\Models\RecipeUser;
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

        $categories = [
            'Завтрак',
            'Обед',
            'Ужин',
            'Выпечка',
            'Десерты',
            'Напитки'
        ];
        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => \Str::slug($name),
            ]);
        }
        $categories = Category::all();
        $ingredients = Ingredient::factory(70)->create();
        $users = User::factory(20)->create(['role' => 'user']);
        $recipes = Recipe::factory(120)->create();
        foreach ($recipes as $recipe) {
            $recipe->update([
                'author_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'is_published' => true,
            ]);
        }

        for ($i = 1; $i <= rand(3,6); $i++){
            RecipeStep::create([
                'recipe_id' => $recipe->id,
                'step_id' => $i,
                'description' => "Шаг {$i}: подготовка ингредиентов и приготовление",
            ]);
        }

        $randomIngredients = $ingredients->random(rand(3,7));
        foreach ($randomIngredients as $ingredient){
            $recipe->ingredients()->attach($ingredient->id,[
                'quantity' => rand(50,500),
                'unit' => 'g'
                ]);
        }

        foreach ($users->random(rand(2,5)) as $user){
            Comment::create([
                'body'=> 'Очень вкусный рецепт!',
                'user_id' => $user->id,
                'recipe_id' => $recipe->id,
            ]);
        }

        foreach ($users->random(rand(3,8)) as $user){
            Rating::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'recipe_id' => $recipe->id,
                ],
                [
                    'rating' => rand(1,5),
                ]
            );
        }

        foreach ($users->random(rand(2,6)) as $user){
            RecipeUser::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'recipe_id' => $recipe->id,
                ],
                [
                    'added_at' => now(),
                ]
            );
        }

        $recipe->update([
            'rating' => $recipe->rating()->avg('rating'),
            'rating_count' => $recipe->rating()->count(),
        ]);
    }
}
