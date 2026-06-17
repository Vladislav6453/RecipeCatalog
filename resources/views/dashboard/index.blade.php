<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Мои рецепты') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Статистика -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <x-stat-card title="Всего рецептов" :value="$stats['total_recipes']" icon="📝" color="indigo" />
                <x-stat-card title="Опубликовано" :value="$stats['published_recipes']" icon="✅" color="green" />
                <x-stat-card title="Черновики" :value="$stats['draft_recipes']" icon="📋" color="yellow" />
                <x-stat-card title="Средний рейтинг" :value="$stats['avg_rating'] ?? 0" icon="⭐" color="yellow" />
            </div>

            <!-- Дополнительная статистика -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <x-gradient-stat-card 
                    title="Всего комментариев" 
                    :value="$stats['total_comments']" 
                    icon="💬" 
                    gradient="from-blue-500 to-blue-600" />
                
                <x-gradient-stat-card 
                    title="В избранном" 
                    :value="$stats['total_favorites']" 
                    icon="❤️" 
                    gradient="from-red-500 to-red-600" />
                
                <x-gradient-stat-card 
                    title="Всего просмотров" 
                    :value="$stats['total_views']" 
                    icon="👁️" 
                    gradient="from-purple-500 to-purple-600" />
            </div>

            <!-- Таблица рецептов -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold">Управление рецептами</h3>
                        <a href="#" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            + Создать рецепт
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Название
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Статус
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Рейтинг
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Комментарии
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Избранное
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Дата создания
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Действия
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($recipes as $recipe)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                @if($recipe->image)
                                                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" 
                                                        class="w-12 h-12 rounded object-cover mr-3">
                                                @else
                                                    <div class="w-12 h-12 bg-gray-200 rounded mr-3 flex items-center justify-center">
                                                        <span class="text-gray-400 text-xs">📷</span>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">{{ $recipe->title }}</div>
                                                    <div class="text-sm text-gray-500">{{ Str::limit($recipe->description, 40) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($recipe->is_published)
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Опубликован
                                                </span>
                                            @else
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Черновик
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="text-yellow-500">⭐</span>
                                                <span class="ml-1 text-sm text-gray-900">{{ number_format($recipe->rating, 1) }}</span>
                                                <span class="ml-1 text-xs text-gray-500">({{ $recipe->rating_count }})</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            💬 {{ $recipe->comments_count }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            ❤️ {{ $recipe->favorites_count }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $recipe->created_at->format('d.m.Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                <a href="{{ route('recipes.show', $recipe->slug) }}" 
                                                    class="text-indigo-600 hover:text-indigo-900" title="Просмотр">
                                                    👁️
                                                </a>
                                                <a href="#" class="text-blue-600 hover:text-blue-900" title="Редактировать">
                                                    ✏️
                                                </a>
                                                <form action="{{ route('my-recipes.recipes.publish', $recipe) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" 
                                                        class="{{ $recipe->is_published ? 'text-yellow-600 hover:text-yellow-900' : 'text-green-600 hover:text-green-900' }}" 
                                                        title="{{ $recipe->is_published ? 'Снять с публикации' : 'Опубликовать' }}">
                                                        {{ $recipe->is_published ? '📋' : '✅' }}
                                                    </button>
                                                </form>
                                                <button type="button" class="text-red-600 hover:text-red-900" title="Удалить">
                                                    🗑️
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                            <div class="text-4xl mb-4">📝</div>
                                            <p class="text-lg mb-2">У вас пока нет рецептов</p>
                                            <a href="#" class="text-indigo-600 hover:text-indigo-800">Создать первый рецепт</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Пагинация -->
                    @if($recipes->hasPages())
                        <div class="mt-6">
                            {{ $recipes->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
