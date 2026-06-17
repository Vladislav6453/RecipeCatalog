<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Каталог рецептов') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Поиск и фильтры -->
            <x-recipe-filters :categories="$categories" />

            <!-- Результаты поиска -->
            @if(request()->hasAny(['search', 'category', 'difficulty', 'sort']))
                <div class="mb-4 text-sm text-gray-600">
                    Найдено рецептов: <span class="font-semibold">{{ $recipes->total() }}</span>
                    @if(request('search'))
                        по запросу "<span class="font-medium">{{ request('search') }}</span>"
                    @endif
                </div>
            @endif

            <!-- Сетка рецептов -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($recipes as $recipe)
                    <x-recipe-card :recipe="$recipe" />
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="text-6xl mb-4">🍳</div>
                        <p class="text-gray-500 text-lg mb-4">Рецепты не найдены</p>
                        <p class="text-gray-400">Попробуйте изменить параметры поиска</p>
                    </div>
                @endforelse
            </div>

            <!-- Пагинация -->
            <div class="mt-6">
                {{ $recipes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
