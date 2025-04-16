@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">Booking Details</h1>
</div>

<div class="page-content">
    <div class="content-container">
        <div class="booking-details-card">
            <div class="card-grid">
                <div class="destination-info">
                    <div class="card-image">
                        <img src="{{ $booking->destination->first_photo_url }}" alt="{{ $booking->destination->destination_name }}">
                    </div>
                    <div class="card-content">
                        <h2>{{ $booking->destination->destination_name }}</h2>
                        <p class="location">{{ $booking->destination->location }}</p>
                        <div class="details-list">
                            <div class="detail-item">
                                <span class="label">Duration:</span>
                                <span>{{ $booking->destination->tour_duration }} days</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Check-in:</span>
                                <span>{{ $booking->check_in->format('M d, Y') }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="label">Travelers:</span>
                                <span>{{ $booking->number_travelers }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="payment-info">
                    <div class="price-summary">
                        <h3>Payment Details</h3>
                        <div class="price-details">
                            <span class="total-label">Total Price</span>
                            <span class="total-amount">${{ number_format($booking->price, 2) }}</span>
                        </div>
                        <div class="status-badge {{ $booking->paid ? 'status-paid' : 'status-pending' }}">
                            {{ $booking->paid ? 'Paid' : 'Pending Payment' }}
                        </div>
                    </div>

                    @if(!$booking->paid)
                    <div class="action-buttons">
                        <a href="{{ route('bookings.payment', $booking->id) }}" class="btn btn-primary">
                            Proceed to Payment
                        </a>
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-secondary">
                            Edit Booking
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection