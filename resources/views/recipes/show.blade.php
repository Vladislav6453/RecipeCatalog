<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $recipe->title }}
            </h2>
            @auth
                @if($recipe->author_id === auth()->id())
                    <a href="{{ route('my-recipes.dashboard') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                        Перейти в дашборд
                    </a>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <!-- Изображение -->
                @if($recipe->image)
                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" 
                        class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                        <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif

                <div class="p-8">
                    <!-- Шапка -->
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <span class="inline-block bg-indigo-100 text-indigo-800 text-sm px-3 py-1 rounded mb-3">
                                {{ $recipe->category->name }}
                            </span>
                            <p class="text-gray-600 text-lg mb-4">{{ $recipe->description }}</p>
                            <p class="text-sm text-gray-500">Автор: <span class="font-medium">{{ $recipe->author->name }}</span></p>
                        </div>

                        @auth
                            <form action="{{ route('recipes.favorite', $recipe->slug) }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center space-x-2 px-4 py-2 {{ $isFavorite ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-600' }} rounded-lg hover:bg-red-200">
                                    <span class="text-xl">{{ $isFavorite ? '❤️' : '🤍' }}</span>
                                    <span class="text-sm">{{ $isFavorite ? 'В избранном' : 'В избранное' }}</span>
                                </button>
                            </form>
                        @endauth
                    </div>

                    <!-- Основная информация -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8 p-6 bg-gray-50 rounded-lg">
                        <div class="text-center">
                            <div class="text-3xl mb-2">⏱️</div>
                            <div class="text-sm text-gray-600">Время</div>
                            <div class="font-semibold">{{ $recipe->cooking_time }} мин</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl mb-2">🍽️</div>
                            <div class="text-sm text-gray-600">Порций</div>
                            <div class="font-semibold">{{ $recipe->servings }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl mb-2">📊</div>
                            <div class="text-sm text-gray-600">Сложность</div>
                            <div class="font-semibold">
                                @switch($recipe->difficulty)
                                    @case('easy') Легко @break
                                    @case('medium') Средне @break
                                    @case('hard') Сложно @break
                                @endswitch
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl mb-2">⭐</div>
                            <div class="text-sm text-gray-600">Рейтинг</div>
                            <div class="font-semibold">{{ number_format($recipe->rating, 1) }} ({{ $recipe->rating_count }})</div>
                        </div>
                    </div>

                    <!-- Оценка рецепта -->
                    @auth
                        <div class="mb-8 p-6 bg-yellow-50 rounded-lg">
                            <h3 class="text-lg font-semibold mb-3">Оцените рецепт</h3>
                            <form action="{{ route('recipes.rate', $recipe->slug) }}" method="POST" class="flex items-center space-x-4">
                                @csrf
                                <div class="flex space-x-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <label class="cursor-pointer">
                                            <input type="radio" name="rating" value="{{ $i }}" class="hidden peer" 
                                                {{ $userRating && $userRating->rating == $i ? 'checked' : '' }} 
                                                onchange="this.form.submit()">
                                            <span class="text-3xl peer-checked:text-yellow-500 text-gray-300 hover:text-yellow-400 transition">★</span>
                                        </label>
                                    @endfor
                                </div>
                                @if($userRating)
                                    <span class="text-sm text-gray-600">Ваша оценка: {{ $userRating->rating }}</span>
                                @endif
                            </form>
                        </div>
                    @endauth

                    <!-- Ингредиенты -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold mb-4">Ингредиенты</h3>
                        <div class="bg-gray-50 rounded-lg p-6">
                            <ul class="space-y-2">
                                @foreach($recipe->ingredients as $ingredient)
                                    <li class="flex items-center">
                                        <span class="w-2 h-2 bg-indigo-600 rounded-full mr-3"></span>
                                        <span class="font-medium">{{ $ingredient->name }}</span>
                                        <span class="ml-auto text-gray-600">{{ $ingredient->pivot->quantity }} {{ $ingredient->pivot->unit }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Шаги приготовления -->
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold mb-4">Приготовление</h3>
                        <div class="space-y-4">
                            @foreach($recipe->steps as $step)
                                <div class="flex">
                                    <div class="flex-shrink-0 w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold mr-4">
                                        {{ $step->step_number }}
                                    </div>
                                    <div class="flex-1 bg-gray-50 rounded-lg p-4">
                                        {{ $step->description }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Комментарии -->
                    <div class="border-t pt-8">
                        <h3 class="text-2xl font-bold mb-6">Комментарии ({{ $recipe->comments->count() }})</h3>

                        @auth
                            <div class="mb-6">
                                <form action="{{ route('recipes.comments.store', $recipe->slug) }}" method="POST">
                                    @csrf
                                    <textarea name="content" rows="3" 
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        placeholder="Оставьте комментарий..." required></textarea>
                                    @error('content')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                    <button type="submit" class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                        Отправить
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="mb-6 p-4 bg-gray-100 rounded-lg text-center">
                                <p class="text-gray-600">
                                    <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800">Войдите</a>, 
                                    чтобы оставить комментарий
                                </p>
                            </div>
                        @endauth

                        <div class="space-y-4">
                            @forelse($recipe->comments as $comment)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-start justify-between mb-2">
                                        <div>
                                            <span class="font-semibold">{{ $comment->user->name }}</span>
                                            <span class="text-sm text-gray-500 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        @auth
                                            @if($comment->user_id === auth()->id() || $recipe->author_id === auth()->id())
                                                <form action="{{ route('recipes.comments.destroy', [$recipe->slug, $comment]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Удалить</button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                    <p class="text-gray-700">{{ $comment->content }}</p>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-6">Комментариев пока нет</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Похожие рецепты -->
            @if($relatedRecipes->count() > 0)
                <div class="mt-8">
                    <h3 class="text-2xl font-bold mb-6">Похожие рецепты</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedRecipes as $related)
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                                <a href="{{ route('recipes.show', $related->slug) }}">
                                    @if($related->image)
                                        <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}" 
                                            class="w-full h-40 object-cover">
                                    @else
                                        <div class="w-full h-40 bg-gray-200"></div>
                                    @endif
                                    <div class="p-4">
                                        <h4 class="font-semibold line-clamp-2 mb-2">{{ $related->title }}</h4>
                                        <div class="flex items-center justify-between text-sm text-gray-500">
                                            <span>⏱️ {{ $related->cooking_time }} мин</span>
                                            <span>⭐ {{ number_format($related->rating, 1) }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
