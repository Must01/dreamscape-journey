@extends('layouts.app')

@section('content')
<div class="page-header destination-header">
    <div class="header-content">
        <h1 class="page-title">{{ $destination->destination_name }}</h1>
        <p class="page-subtitle">{{ $destination->location }}</p>
    </div>
</div>

<div class="page-content">
    <div class="content-container">
        <div class="destination-grid">
            <div class="destination-details">
                <div class="main-image">
                    @if($destination->first_photo_url)
                    <img src="{{ $destination->first_photo_url }}"
                        alt="{{ $destination->destination_name }}"
                        class="w-full h-full object-cover">
                    @endif
                </div>

                <div class="details-content">
                    <div class="detail-section">
                        <h2>About this destination</h2>
                        <p>{{ $destination->description }}</p>
                    </div>

                    <div class="features-list">
                        <div class="feature-item">
                            <span class="icon">⏱️</span>
                            <span>{{ $destination->tour_duration }} days</span>
                        </div>
                        <div class="feature-item">
                            <span class="icon">👥</span>
                            <span>Up to {{ $destination->max_travelers }} travelers</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="booking-sidebar">
                <div class="booking-card">
                    <div class="price-tag">
                        <span class="amount">${{ number_format($destination->price, 2) }}</span>
                        <span class="per-person">per person</span>
                    </div>

                    @auth
                    <form action="{{ route('bookings.store') }}" method="POST" class="booking-form">
                        @csrf
                        <input type="hidden" name="destination_id" value="{{ $destination->id }}">

                        <div class="form-group">
                            <label>Check-in Date</label>
                            <input type="date" name="check_in" min="{{ date('Y-m-d') }}" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label>Number of Travelers</label>
                            <input type="number" name="travelers" min="1" max="{{ $destination->max_travelers }}"
                                class="form-input" required value="1">
                        </div>

                        <button type="submit" class="btn btn-primary w-full">Book Now</button>
                    </form>
                    @else
                    <div class="auth-prompt">
                        <p>Please login to book this destination</p>
                        <a href="{{ route('login') }}" class="btn btn-primary w-full">Login to Book</a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection