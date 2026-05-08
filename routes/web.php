<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RecipeController::class, 'index'])->name('home');
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/{recipe:slug}',[RecipeController::class,'show'])->name('recipes.show');

Route::middleware('auth')->group(function(){
    Route::post('/recipes/{recipe:slug}/rate',[RatingController::class,'store'])->name('recipes.rate');
    Route::get('/favorites',[FavoriteController::class,'index'])->name('favorites.index');
    Route::post('/recipes/{recipe:slug}/favorite', [FavoriteController::class,'toggle'])->name('recipes.favorite');
    Route::resource('recipes.comments', CommentController::class)
    ->scoped(['recipe' => 'slug'])
    ->only(['store', 'destroy']);
});

Route::prefix('my-recipes')
    ->name('my-recipes.')
    ->middleware(['auth','can:be-author'])
    ->group(function(){
        Route::get('/dashboard',[AuthDashboardController::class,'index'])
            ->name('dashboard');
        Route::resource('users',AdminUserController::class);
        Route::resource('ingredients',AdminIngredientController::class);
        Route::patch('/recipes/{recipe}/toggle-publish', [AdminRecipeController::class, 'togglePublish'])->name('recipes.publish');
    });
