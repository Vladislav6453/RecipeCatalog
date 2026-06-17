@props(['rating' => 0, 'size' => 'text-base'])

<div class="rating-stars {{ $size }}">
    @for($i = 1; $i <= 5; $i++)
        <span class="{{ $i <= $rating ? 'text-yellow-500' : 'text-gray-300' }}">★</span>
    @endfor
</div>