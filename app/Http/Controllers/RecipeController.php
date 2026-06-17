<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::with(['category', 'author'])
            ->where('is_published', true)
            ->latest();

        // Поиск
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Фильтр по категории
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Фильтр по сложности
        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }

        // Сортировка
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'rating':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'time':
                    $query->orderBy('cooking_time', 'asc');
                    break;
                case 'popular':
                    $query->orderBy('rating_count', 'desc');
                    break;
            }
        }

        $recipes = $query->paginate(12);
        $categories = Category::all();

        return view('recipes.index', compact('recipes', 'categories'));
    }

    public function show(Recipe $recipe)
    {
        if (!$recipe->is_published && (!auth()->check() || auth()->id() !== $recipe->author_id)) {
            abort(404);
        }

        $recipe->load([
            'category',
            'author',
            'ingredients',
            'steps' => function($query) {
                $query->orderBy('step_number');
            },
            'comments' => function($query) {
                $query->with('user')->latest();
            },
            'ratings'
        ]);

        $userRating = null;
        $isFavorite = false;

        if (auth()->check()) {
            $userRating = $recipe->ratings()->where('user_id', auth()->id())->first();
            $isFavorite = $recipe->favorites()->where('user_id', auth()->id())->exists();
        }

        $relatedRecipes = Recipe::where('category_id', $recipe->category_id)
            ->where('id', '!=', $recipe->id)
            ->where('is_published', true)
            ->limit(4)
            ->get();

        return view('recipes.show', compact('recipe', 'userRating', 'isFavorite', 'relatedRecipes'));
    }
}
