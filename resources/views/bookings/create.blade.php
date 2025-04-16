@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-card">
        <h1>Book {{ $destination->destination_name }}</h1>

        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="destination_id" value="{{ $destination->id }}">

            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ Auth::user()->name }}" required>
            </div>

            <div class="form-group">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="tel" id="mobile" name="mobile" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="check_in" class="form-label">Check-in Date</label>
                <input type="date" id="check_in" name="check_in" class="form-input" required min="{{ date('Y-m-d') }}">
            </div>

            <div class="form-group">
                <label for="check_out" class="form-label">Check-out Date</label>
                <input type="date" id="check_out" name="check_out" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="number_travelers" class="form-label">Number of Travelers</label>
                <input type="number" id="number_travelers" name="number_travelers" class="form-input" required 
                    min="1" max="{{ $destination->max_travelers }}">
                <small>Maximum allowed: {{ $destination->max_travelers }} travelers</small>
            </div>

            <div class="price-summary">
                <p>Price per person: ${{ number_format($destination->price, 2) }}</p>
            </div>

            <button type="submit" class="btn btn-primary">Proceed to Payment</button>
        </form>
    </div>
</div>
