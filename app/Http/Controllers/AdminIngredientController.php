<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class AdminIngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::paginate(20);
        return view('admin.ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        return view('admin.ingredients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:ingredients',
            'unit' => 'required|string|max:50'
        ]);

        Ingredient::create($request->only(['name', 'unit']));

        return redirect()->route('admin.ingredients.index')
            ->with('success', 'Ингредиент добавлен');
    }

    public function edit(Ingredient $ingredient)
    {
        return view('admin.ingredients.edit', compact('ingredient'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:ingredients,name,' . $ingredient->id,
            'unit' => 'required|string|max:50'
        ]);

        $ingredient->update($request->only(['name', 'unit']));

        return redirect()->route('admin.ingredients.index')
            ->with('success', 'Ингредиент обновлен');
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return back()->with('success', 'Ингредиент удален');
    }
}
