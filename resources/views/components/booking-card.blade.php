<div class="booking-card">
    <div class="booking-header">
        <h3>{{ $booking->destination->destination_name }}</h3>
        <span class="status {{ $booking->paid ? 'paid' : 'pending' }}">
            {{ $booking->paid ? 'Paid' : 'Pending Payment' }}
        </span>
    </div>

    <div class="booking-details">
        <p><strong>Check-in:</strong> {{ $booking->check_in->format('M d, Y') }}</p>
        <p><strong>Check-out:</strong> {{ $booking->check_out->format('M d, Y') }}</p>
        <p><strong>Travelers:</strong> {{ $booking->number_travelers }}</p>
        <p><strong>Total Price:</strong> ${{ number_format($booking->price, 2) }}</p>
    </div>

    <div class="booking-actions">
        <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-secondary">View Details</a>
        @if(!$booking->paid)
            <a href="{{ route('bookings.payment', $booking->id) }}" class="btn btn-primary">Pay Now</a>
        @endif
    </div>
</div>
