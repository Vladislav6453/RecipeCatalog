@props(['title', 'value', 'icon', 'gradient'])

<div class="bg-gradient-to-r {{ $gradient }} overflow-hidden shadow-sm sm:rounded-lg text-white">
    <div class="p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm mb-1 opacity-90">{{ $title }}</p>
                <p class="text-2xl font-bold">{{ $value }}</p>
            </div>
            <div class="text-4xl opacity-75">{{ $icon }}</div>
        </div>
    </div>
</div>