@props(['difficulty'])

@php
    $colors = [
        'easy' => 'bg-green-100 text-green-800',
        'medium' => 'bg-yellow-100 text-yellow-800',
        'hard' => 'bg-red-100 text-red-800'
    ];
    
    $labels = [
        'easy' => 'Легко',
        'medium' => 'Средне',
        'hard' => 'Сложно'
    ];
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colors[$difficulty] ?? 'bg-gray-100 text-gray-800' }}">
    {{ $labels[$difficulty] ?? $difficulty }}
</span>