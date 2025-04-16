<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{id}', [DestinationController::class, 'show'])->name('destinations.show');

// Guest-only routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/account', [UserController::class, 'profile'])->name('profile');
    Route::put('/account', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/account/password', [UserController::class, 'changePassword'])->name('password.change');


    // Booking routes
    Route::get('/account/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
    Route::get('/payment/{id}', [BookingController::class, 'payment'])->name('bookings.payment');
    Route::post('/payment/{id}', [BookingController::class, 'processPayment'])->name('bookings.process-payment');
    Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');

    // Destination management routes
    Route::get('/destinations/create', [DestinationController::class, 'create'])->name('destinations.create');
    Route::post('/destinations', [DestinationController::class, 'store'])->name('destinations.store');
    Route::get('/destinations/{id}/edit', [DestinationController::class, 'edit'])->name('destinations.edit');
    Route::put('/destinations/{id}', [DestinationController::class, 'update'])->name('destinations.update');
    Route::delete('/destinations/{id}', [DestinationController::class, 'destroy'])->name('destinations.destroy');

    // Admin routes
    Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard')
        ->middleware('admin');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
