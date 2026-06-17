<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Мои избранные рецепты') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Всего избранных: {{ $favorites->count() }}</h3>
                    </div>
                </div>
            </div>

            @if($favorites->count() > 0)
                    @foreach($favorites as $favorite)
                        @php $recipe = $favorite->recipe; @endphp
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                            <a href="{{ route('recipes.show', $recipe->slug) }}">
                                @if($recipe->image)
                                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" 
                                        class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </a>

                            <div class="p-6">
                                <div class="mb-2">
                                    <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded">
                                        {{ $recipe->category->name }}
                                    </span>
                                </div>

                                <h3 class="text-lg font-semibold mb-2 line-clamp-2">
                                    <a href="{{ route('recipes.show', $recipe->slug) }}" class="hover:text-indigo-600">
                                        {{ $recipe->title }}
                                    </a>
                                </h3>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ $recipe->description }}
                                </p>

                                <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                                    <div class="flex items-center space-x-4">
                                        <span title="Время приготовления">⏱️ {{ $recipe->cooking_time }} мин</span>
                                        <span title="Порций">🍽️ {{ $recipe->servings }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-yellow-500">★</span>
                                        <span class="ml-1">{{ number_format($recipe->rating, 1) }}</span>
                                    </div>
                                </div>

                                <div class="border-t pt-3 flex items-center justify-between">
                                    <div class="text-sm text-gray-600">
                                        Добавлен: {{ $favorite->created_at->format('d.m.Y') }}
                                    </div>
                                    <form action="{{ route('recipes.favorite', $recipe->slug) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                            ❤️ Удалить
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <x-empty-state 
                        icon="🤍" 
                        title="У вас пока нет избранных рецептов"
                        description="Добавляйте понравившиеся рецепты в избранное, чтобы быстро находить их позже"
                        :action="true"
                        actionText="Посмотреть каталог рецептов"
                        :actionUrl="route('recipes.index')"
                    />
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
