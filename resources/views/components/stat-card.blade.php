@props(['title', 'value', 'icon', 'color' => 'indigo'])

@php
    $colorClasses = [
        'indigo' => 'text-indigo-600',
        'green' => 'text-green-600',
        'yellow' => 'text-yellow-600',
        'red' => 'text-red-600',
        'blue' => 'text-blue-600',
        'purple' => 'text-purple-600',
    ];
@endphp

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 mb-1">{{ $title }}</p>
                <p class="text-3xl font-bold {{ $colorClasses[$color] ?? 'text-indigo-600' }}">{{ $value }}</p>
            </div>
            <div class="text-4xl">{{ $icon }}</div>
        </div>
    </div>
</div>