@props(['icon', 'title', 'description', 'action' => null, 'actionText' => null, 'actionUrl' => null])

<div class="text-center py-12">
    <div class="text-6xl mb-4">{{ $icon }}</div>
    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $title }}</h3>
    <p class="text-gray-500 mb-6">{{ $description }}</p>
    
    @if($action && $actionText && $actionUrl)
        <a href="{{ $actionUrl }}" class="btn-primary">
            {{ $actionText }}
        </a>
    @endif
</div>