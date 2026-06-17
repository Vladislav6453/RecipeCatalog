<x-app-layout>
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold mb-6">🍳 Каталог Рецептов</h1>
            <p class="text-xl mb-8 opacity-90">Откройте для себя тысячи вкусных рецептов от талантливых поваров</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('recipes.index') }}" class="px-8 py-3 bg-white text-indigo-600 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Посмотреть рецепты
                </a>
                @guest
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-indigo-800 text-white rounded-lg font-semibold hover:bg-indigo-900 transition">
                        Зарегистрироваться
                    </a>
                @endguest
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Преимущества -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="bg-white p-8 rounded-lg shadow-sm text-center">
                    <div class="text-5xl mb-4">📚</div>
                    <h3 class="text-xl font-semibold mb-3">Большой каталог</h3>
                    <p class="text-gray-600">Сотни проверенных рецептов на любой вкус и для любого случая</p>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-sm text-center">
                    <div class="text-5xl mb-4">⭐</div>
                    <h3 class="text-xl font-semibold mb-3">Рейтинги и отзывы</h3>
                    <p class="text-gray-600">Оценивайте рецепты и делитесь своим мнением с сообществом</p>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-sm text-center">
                    <div class="text-5xl mb-4">❤️</div>
                    <h3 class="text-xl font-semibold mb-3">Избранное</h3>
                    <p class="text-gray-600">Сохраняйте понравившиеся рецепты и готовьте их снова и снова</p>
                </div>
            </div>

            <!-- Популярные рецепты -->
            <div class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-3xl font-bold text-gray-900">🔥 Популярные рецепты</h2>
                    <a href="{{ route('recipes.index', ['sort' => 'popular']) }}" class="text-indigo-600 hover:text-indigo-800">
                        Смотреть все →
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @for($i = 0; $i < 3; $i++)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
                            <div class="h-48 bg-gradient-to-br from-orange-200 to-red-200 flex items-center justify-center">
                                <span class="text-6xl">🍕</span>
                            </div>
                            <div class="p-6">
                                <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded mb-2">
                                    Выпечка
                                </span>
                                <h3 class="text-lg font-semibold mb-2">Итальянская пицца</h3>
                                <p class="text-gray-600 text-sm mb-4">Классический рецепт настоящей итальянской пиццы с тонким тестом</p>
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <span>⏱️ 45 мин</span>
                                    <span>⭐ 4.8 (124)</span>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Категории -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">🗂️ Категории рецептов</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @php
                        $categories = [
                            ['name' => 'Завтраки', 'icon' => '🍳', 'color' => 'from-yellow-400 to-orange-400'],
                            ['name' => 'Супы', 'icon' => '🍲', 'color' => 'from-red-400 to-pink-400'],
                            ['name' => 'Салаты', 'icon' => '🥗', 'color' => 'from-green-400 to-teal-400'],
                            ['name' => 'Десерты', 'icon' => '🍰', 'color' => 'from-purple-400 to-indigo-400'],
                            ['name' => 'Выпечка', 'icon' => '🥖', 'color' => 'from-orange-400 to-red-400'],
                            ['name' => 'Напитки', 'icon' => '🍹', 'color' => 'from-blue-400 to-cyan-400'],
                            ['name' => 'Мясо', 'icon' => '🍖', 'color' => 'from-red-500 to-orange-500'],
                            ['name' => 'Рыба', 'icon' => '🐟', 'color' => 'from-blue-500 to-indigo-500'],
                        ];
                    @endphp

                    @foreach($categories as $category)
                        <a href="{{ route('recipes.index') }}" 
                            class="bg-gradient-to-br {{ $category['color'] }} text-white p-6 rounded-lg text-center hover:shadow-lg transition transform hover:scale-105">
                            <div class="text-4xl mb-2">{{ $category['icon'] }}</div>
                            <div class="font-semibold">{{ $category['name'] }}</div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Призыв к действию -->
            @guest
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg p-12 text-center">
                    <h2 class="text-3xl font-bold mb-4">Присоединяйтесь к нашему сообществу!</h2>
                    <p class="text-xl mb-6 opacity-90">Делитесь своими рецептами, сохраняйте любимые блюда и общайтесь с другими кулинарами</p>
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-indigo-600 rounded-lg font-semibold hover:bg-gray-100 transition">
                            Создать аккаунт
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-3 bg-indigo-800 text-white rounded-lg font-semibold hover:bg-indigo-900 transition">
                            Войти
                        </a>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</x-app-layout>
