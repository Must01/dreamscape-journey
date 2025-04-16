@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">My Bookings</h1>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destination</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dates</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Travelers</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($bookings as $booking)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($booking->destination->photos)
                                    <img class="h-10 w-10 rounded-full object-cover" 
                                         src="{{ asset('storage/' . json_decode($booking->destination->photos)[0]) }}" 
                                         alt="{{ $booking->destination->name }}">
                                @endif
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $booking->destination->destination_name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $booking->destination->location }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $booking->check_in->format('M d, Y') }}</div>
                            <div class="text-sm text-gray-500">to {{ $booking->check_out->format('M d, Y') }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $booking->number_travelers }} {{ Str::plural('person', $booking->number_travelers) }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $booking->paid ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $booking->paid ? 'Paid' : 'Pending Payment' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">
                            <a href="{{ route('bookings.show', $booking) }}" class="text-blue-600 hover:text-blue-900">View</a>
                            @if(!$booking->paid)
                                <a href="{{ route('bookings.payment', $booking) }}" class="ml-3 text-green-600 hover:text-green-900">Pay Now</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            No bookings found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection