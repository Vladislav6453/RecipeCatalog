<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5'
        ]);

        $rating = Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'recipe_id' => $recipe->id,
            ],
            [
                'rating' => $request->rating
            ]
        );

        // Обновляем средний рейтинг рецепта
        $avgRating = $recipe->ratings()->avg('rating');
        $ratingCount = $recipe->ratings()->count();
        
        $recipe->update([
            'rating' => round($avgRating, 1),
            'rating_count' => $ratingCount
        ]);

        return back()->with('success', 'Спасибо за вашу оценку!');
    }
}
