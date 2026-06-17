@props(['recipe'])

<div class="recipe-card">
    <a href="{{ route('recipes.show', $recipe->slug) }}">
        @if($recipe->image)
            <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" 
                class="recipe-card-image">
        @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        @endif
    </a>

    <div class="recipe-card-content">
        <div class="mb-2">
            <span class="category-badge">
                {{ $recipe->category->name }}
            </span>
        </div>

        <h3 class="recipe-card-title">
            <a href="{{ route('recipes.show', $recipe->slug) }}">
                {{ $recipe->title }}
            </a>
        </h3>

        <p class="recipe-card-description">
            {{ $recipe->description }}
        </p>

        <div class="recipe-card-meta mb-3">
            <div class="flex items-center space-x-4">
                <span title="Время приготовления">⏱️ {{ $recipe->cooking_time }} мин</span>
                <span title="Порций">🍽️ {{ $recipe->servings }}</span>
            </div>
            <div class="flex items-center">
                <span class="text-yellow-500">★</span>
                <span class="ml-1">{{ number_format($recipe->rating, 1) }}</span>
                <span class="ml-1 text-gray-400">({{ $recipe->rating_count }})</span>
            </div>
        </div>

        <div class="border-t pt-3">
            <div class="flex items-center justify-between text-sm text-gray-600">
                <span>Автор: {{ $recipe->author->name }}</span>
                @if($recipe->created_at)
                    <span>{{ $recipe->created_at->format('d.m.Y') }}</span>
                @endif
            </div>
        </div>
    </div>
</div>