<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthDashboardController;
use App\Http\Controllers\AdminRecipeController;
use Illuminate\Support\Facades\Route;

// Главная страница
Route::get('/', function () {
    return view('home');
})->name('home');

// Публичные маршруты рецептов
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/{recipe:slug}', [RecipeController::class, 'show'])->name('recipes.show');

// Аутентифицированные маршруты
Route::middleware('auth')->group(function () {
    // Оценки
    Route::post('/recipes/{recipe:slug}/rate', [RatingController::class, 'store'])->name('recipes.rate');
    
    // Избранное
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/recipes/{recipe:slug}/favorite', [FavoriteController::class, 'toggle'])->name('recipes.favorite');
    
    // Комментарии
    Route::resource('recipes.comments', CommentController::class)
        ->scoped(['recipe' => 'slug'])
        ->only(['store', 'destroy']);
    
    // Профиль
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Дашборд автора рецептов
Route::prefix('my-recipes')
    ->name('my-recipes.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/dashboard', [AuthDashboardController::class, 'index'])->name('dashboard');
        Route::patch('/recipes/{recipe}/toggle-publish', [AdminRecipeController::class, 'togglePublish'])->name('recipes.publish');
    });

require __DIR__.'/auth.php';
