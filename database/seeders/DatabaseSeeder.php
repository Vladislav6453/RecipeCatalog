<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Создаем тестового пользователя
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Запускаем сидеры
        $this->call([
            CategorySeeder::class,
        ]);

        // Создаем дополнительных пользователей и рецепты
        User::factory(10)->create();
        
        // Создаем ингредиенты, рецепты и связанные данные
        \App\Models\Ingredient::factory(50)->create();
        \App\Models\Recipe::factory(30)->create();
        \App\Models\RecipeStep::factory(150)->create();
        \App\Models\Comment::factory(100)->create();
        \App\Models\Rating::factory(200)->create();
        \App\Models\Favorite::factory(80)->create();
    }
}