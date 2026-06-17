<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class AdminRecipeController extends Controller
{
    public function togglePublish(Recipe $recipe)
    {
        if ($recipe->author_id !== auth()->id()) {
            abort(403);
        }

        $recipe->update([
            'is_published' => !$recipe->is_published
        ]);

        $status = $recipe->is_published ? 'опубликован' : 'снят с публикации';

        return back()->with('success', "Рецепт {$status}");
    }
}
