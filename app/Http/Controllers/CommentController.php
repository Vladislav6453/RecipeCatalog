<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $recipe->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);

        return back()->with('success', 'Комментарий добавлен!');
    }

    public function destroy(Recipe $recipe, Comment $comment)
    {
        if ($comment->user_id !== auth()->id() && $recipe->author_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Комментарий удален');
    }
}
