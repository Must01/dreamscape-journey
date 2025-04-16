<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = auth()->user()->bookings()->with('destination')->latest()->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'destination_id' => 'required|exists:destinations,id'
        ]);

        $destination = Destination::findOrFail($validatedData['destination_id']);
        return view('bookings.create', compact('destination'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'check_in' => 'required|date|after:today',
            'travelers' => 'required|integer|min:1'
        ]);

        $destination = Destination::findOrFail($validated['destination_id']);

        if ($validated['travelers'] > $destination->max_travelers) {
            return back()->withErrors(['travelers' => 'Number of travelers exceeds maximum allowed.']);
        }

        $totalPrice = $destination->price * $validated['travelers'];

        $booking = Booking::create([
            'destination_id' => $validated['destination_id'],
            'user_id' => auth()->id(),
            'check_in' => $validated['check_in'],
            'number_travelers' => $validated['travelers'],
            'price' => $totalPrice,
            'paid' => false
        ]);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking created successfully!');
    }

    public function show($id)
    {
        $booking = Booking::with('destination')->findOrFail($id);

        if (auth()->id() !== $booking->user_id && !auth()->user()->is_admin) {
            abort(403);
        }

        return view('bookings.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = Booking::with('destination')->findOrFail($id);

        // Ensure the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Cannot edit paid bookings
        if ($booking->paid) {
            return redirect()->route('bookings.show', $booking->id)
                ->with('error', 'Cannot edit a paid booking.');
        }

        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // Ensure the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Cannot update paid bookings
        if ($booking->paid) {
            return redirect()->route('bookings.show', $booking->id)
                ->with('error', 'Cannot update a paid booking.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'number_travelers' => 'required|integer|min:1',
        ]);

        $destination = $booking->destination;

        // Validate number of travelers
        if ($validatedData['number_travelers'] > $destination->max_travelers) {
            return back()->withErrors(['number_travelers' => 'The number of travelers cannot exceed the maximum allowed for this destination.']);
        }

        // Calculate price
        $checkIn = new Carbon($validatedData['check_in']);
        $checkOut = new Carbon($validatedData['check_out']);
        $days = $checkOut->diffInDays($checkIn);

        $price = $days * $destination->price * $validatedData['number_travelers'];

        $booking->update([
            'name' => $validatedData['name'],
            'mobile' => $validatedData['mobile'],
            'check_in' => $validatedData['check_in'],
            'check_out' => $validatedData['check_out'],
            'number_travelers' => $validatedData['number_travelers'],
            'price' => $price,
        ]);

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Booking updated successfully.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        // Ensure the booking belongs to the authenticated user or admin
        if ($booking->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }

    public function payment(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('bookings.payment', compact('booking'));
    }

    public function processPayment(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        // Simulated payment processing
        $booking->update(['paid' => true]);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Payment processed successfully.');
    }
}
