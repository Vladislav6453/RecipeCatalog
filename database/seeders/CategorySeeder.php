<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Завтраки',
            'Супы',
            'Салаты',
            'Основные блюда',
            'Десерты',
            'Выпечка',
            'Напитки',
            'Закуски',
            'Мясные блюда',
            'Рыбные блюда',
            'Вегетарианские',
            'Постные блюда'
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName)
            ]);
        }
    }
}