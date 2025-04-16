<div class="destination-card">
    <div class="card-image">
        @if($destination->photos)
        <img src="{{ Storage::disk('public')->url(json_decode($destination->photos)[0]) }}"
            alt="{{ $destination->destination_name }}"
            onerror="this.src='{{ asset('images/placeholder.jpg') }}'"
            class="w-full h-full object-cover">
        @else
        <img src="{{ asset('images/placeholder.jpg') }}"
            alt="{{ $destination->destination_name }}"
            class="w-full h-full object-cover">
        @endif
    </div>
    <div class="card-content">
        <h3>{{ $destination->destination_name }}</h3>
        <div class="card-meta">
            <span class="location">{{ $destination->location }}</span>
            <span class="duration">{{ $destination->tour_duration }} days</span>
        </div>
        <div class="card-footer">
            <span class="price">${{ number_format($destination->price, 2) }}</span>
            <a href="{{ route('destinations.show', $destination->id) }}" class="card-button">Explore</a>
        </div>
    </div>
</div>