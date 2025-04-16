@extends('layouts.app')

@section('content')
<div class="page-header destinations-header">
    <div class="header-content">
        <h1 class="page-title">Explore Amazing Destinations</h1>
        <p class="page-subtitle">Find your perfect travel experience</p>
    </div>
</div>

<div class="page-content">
    <div class="content-container">
        <div class="filter-section">
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Search destinations...">
            </div>
            <div class="filter-options">
                <select class="filter-select">
                    <option value="">Price Range</option>
                    <option value="0-1000">Under $1,000</option>
                    <option value="1000-2000">$1,000 - $2,000</option>
                    <option value="2000+">Over $2,000</option>
                </select>
                <select class="filter-select">
                    <option value="">Duration</option>
                    <option value="1-3">1-3 Days</option>
                    <option value="4-7">4-7 Days</option>
                    <option value="8+">8+ Days</option>
                </select>
            </div>
            @auth
            @if(Auth::user()->is_admin)
            <a href="{{ route('destinations.create') }}" class="btn-add">
                <i class="fas fa-plus"></i> Add Destination
            </a>
            @endif
            @endauth
        </div>

        <div class="destinations-grid">
            @forelse($destinations as $destination)
            <div class="destination-card">
                <div class="card-image">
                    @if($destination->photos && is_array($destination->photos) && !empty($destination->photos))
                    <img src="{{ url('storage/' . $destination->photos[0]) }}"
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
            @empty
            <div class="empty-state">
                <div class="empty-icon">🏖️</div>
                <h3>No destinations found</h3>
                <p>Try adjusting your search criteria</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection