<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read \App\Models\User|null $author
 * @property-read \App\Models\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RecipeUser> $favoritedBy
 * @property-read int|null $favorited_by_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ingredient> $ingredients
 * @property-read int|null $ingredients_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rating> $ratings
 * @property-read int|null $ratings_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Recipe> $steps
 * @property-read int|null $steps_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Recipe query()
 * @mixin \Eloquent
 */
class Recipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'category_id',
        'author_id',
        'cooking_time',
        'servings',
        'difficulty',
        'rating',
        'rating_count',
        'is_published',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function steps()
    {
        return $this->hasMany(Recipe::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)->withPivot(['quantity','unit']);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(RecipeUser::class,'recipe_user')->withPivot('added_at');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'recipe_user');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
