@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-6">Payment Details</h1>
            
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Booking Summary</h2>
                <p><span class="font-medium">Destination:</span> {{ $booking->destination->destination_name }}</p>
                <p><span class="font-medium">Check-in:</span> {{ $booking->check_in->format('M d, Y') }}</p>
                <p><span class="font-medium">Check-out:</span> {{ $booking->check_out->format('M d, Y') }}</p>
                <p><span class="font-medium">Travelers:</span> {{ $booking->number_travelers }}</p>
                <p class="text-xl font-bold mt-4">Total: ${{ number_format($booking->total_price, 2) }}</p>
            </div>

            <form method="POST" action="{{ route('bookings.process-payment', $booking) }}" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Card Number</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-lg" placeholder="1234 5678 9012 3456" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Expiry Date</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-lg" placeholder="MM/YY" required>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">CVV</label>
                        <input type="text" class="w-full px-3 py-2 border rounded-lg" placeholder="123" required>
                    </div>
                </div>

                <button type="submit" class="w-full bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600">
                    Pay Now
                </button>
            </form>

            <div class="mt-4 text-center">
                <a href="{{ route('bookings.show', $booking) }}" class="text-gray-600 hover:text-gray-800">
                    Back to Booking
                </a>
            </div>
        </div>
    </div>
</div>
@endsection