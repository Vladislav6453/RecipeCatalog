<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class AuthDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $recipes = Recipe::where('author_id', $user->id)
            ->withCount(['comments', 'ratings', 'favorites'])
            ->latest()
            ->paginate(10);

        $stats = [
            'total_recipes' => Recipe::where('author_id', $user->id)->count(),
            'published_recipes' => Recipe::where('author_id', $user->id)->where('is_published', true)->count(),
            'draft_recipes' => Recipe::where('author_id', $user->id)->where('is_published', false)->count(),
            'total_views' => Recipe::where('author_id', $user->id)->sum('views_count'),
            'total_comments' => $user->recipes()->withCount('comments')->get()->sum('comments_count'),
            'total_favorites' => $user->recipes()->withCount('favorites')->get()->sum('favorites_count'),
            'avg_rating' => round(Recipe::where('author_id', $user->id)->avg('rating'), 1),
        ];

        return view('dashboard.index', compact('recipes', 'stats'));
    }
}
