@extends('layouts.app')

@section('content')
<div class="home-hero">
    <div class="hero-background">
        <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e" alt="Hero background">
    </div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Explore the World</h1>
        <p>Discover amazing destinations and unforgettable experiences</p>
        <a href="{{ route('destinations.index') }}" class="cta-button">View Destinations</a>
    </div>
</div>

<section class="featured-destinations">
    <div class="container">
        <div class="section-header">
            <h2>Popular Destinations</h2>
            <p>Our most loved travel experiences</p>
        </div>

        <div class="destinations-grid">
            @foreach($featuredDestinations->take(4) as $destination)
            <div class="destination-card">
                <div class="card-image">
                    <img src="{{ $destination->first_photo_url }}" alt="{{ $destination->destination_name }}">
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
            @endforeach
        </div>

        <div class="view-all">
            <a href="{{ route('destinations.index') }}" class="view-all-button">View All Destinations</a>
        </div>
    </div>
</section>
@endsection