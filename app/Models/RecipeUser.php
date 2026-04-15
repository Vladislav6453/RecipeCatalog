<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read \App\Models\Recipe|null $recipe
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecipeUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecipeUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecipeUser query()
 * @mixin \Eloquent
 */
class RecipeUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'recipe_id',
        'added_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

}
