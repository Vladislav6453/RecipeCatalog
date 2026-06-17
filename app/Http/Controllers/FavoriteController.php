<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favorites()->with('recipe')->latest()->get();
        
        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Recipe $recipe)
    {
        $favorite = Favorite::where('user_id', auth()->id())
            ->where('recipe_id', $recipe->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            $message = 'Рецепт удален из избранного';
        } else {
            Favorite::create([
                'user_id' => auth()->id(),
                'recipe_id' => $recipe->id,
            ]);
            $message = 'Рецепт добавлен в избранное';
        }

        return back()->with('success', $message);
    }
}
