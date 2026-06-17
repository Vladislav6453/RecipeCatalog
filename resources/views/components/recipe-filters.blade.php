@props(['categories'])

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="p-6">
        <form method="GET" action="{{ route('recipes.index') }}" class="space-y-4" id="recipe-filters">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Поиск -->
                <div class="md:col-span-2">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="Поиск рецептов..." 
                            class="pl-10 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>

                <!-- Категория -->
                <div>
                    <select name="category" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Все категории</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Сложность -->
                <div>
                    <select name="difficulty" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Любая сложность</option>
                        <option value="easy" {{ request('difficulty') == 'easy' ? 'selected' : '' }}>Легко</option>
                        <option value="medium" {{ request('difficulty') == 'medium' ? 'selected' : '' }}>Средне</option>
                        <option value="hard" {{ request('difficulty') == 'hard' ? 'selected' : '' }}>Сложно</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <!-- Сортировка -->
                <div class="flex items-center space-x-4">
                    <label class="text-sm text-gray-600 font-medium">Сортировка:</label>
                    <select name="sort" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        <option value="">По дате</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>По рейтингу</option>
                        <option value="time" {{ request('sort') == 'time' ? 'selected' : '' }}>По времени готовки</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>По популярности</option>
                    </select>
                </div>

                <div class="flex space-x-2">
                    <button type="submit" class="btn-primary">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Найти
                    </button>
                    <a href="{{ route('recipes.index') }}" class="btn-secondary">
                        Сбросить
                    </a>
                </div>
            </div>

            <!-- Быстрые фильтры -->
            <div class="border-t pt-4">
                <div class="flex flex-wrap gap-2">
                    <span class="text-sm text-gray-600 mr-2">Быстрые фильтры:</span>
                    <a href="{{ route('recipes.index', ['sort' => 'rating']) }}" 
                        class="text-xs px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full hover:bg-yellow-200 transition">
                        ⭐ Лучшие
                    </a>
                    <a href="{{ route('recipes.index', ['sort' => 'time']) }}" 
                        class="text-xs px-3 py-1 bg-green-100 text-green-800 rounded-full hover:bg-green-200 transition">
                        ⚡ Быстрые
                    </a>
                    <a href="{{ route('recipes.index', ['difficulty' => 'easy']) }}" 
                        class="text-xs px-3 py-1 bg-blue-100 text-blue-800 rounded-full hover:bg-blue-200 transition">
                        😊 Простые
                    </a>
                    <a href="{{ route('recipes.index', ['sort' => 'popular']) }}" 
                        class="text-xs px-3 py-1 bg-purple-100 text-purple-800 rounded-full hover:bg-purple-200 transition">
                        🔥 Популярные
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Автоматическая отправка формы при изменении селектов
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('recipe-filters');
    const selects = form.querySelectorAll('select');
    
    selects.forEach(select => {
        select.addEventListener('change', function() {
            form.submit();
        });
    });
});
</script>