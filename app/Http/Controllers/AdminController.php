<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $this->authorize('viewAdminDashboard', User::class);
        
        $totalUsers = User::count();
        $totalDestinations = Destination::count(); 
        $totalBookings = Booking::count();
        $totalReviews = Review::count();
        $totalEarnings = Booking::where('paid', true)->sum('price');
        $latestBookings = Booking::with('destination', 'user')->latest()->take(5)->get();
        $latestReviews = Review::with('destination', 'user')->latest()->take(5)->get();
        $latestDestinations = Destination::with('owner')->latest()->take(5)->get();
        $latestUsers = User::latest()->take(5)->get();
        $latestBookingsCount = Booking::latest()->take(5)->count();
        $latestReviewsCount = Review::latest()->take(5)->count();
        $latestDestinationsCount = Destination::latest()->take(5)->count();
        $latestUsersCount = User::latest()->take(5)->count();
        $latestBookingsEarnings = Booking::where('paid', true)->latest()->take(5)->sum('price');
        $latestReviewsRatings = Review::latest()->take(5)->avg('rating');
        $latestDestinationsLikes = Destination::latest()->take(5)->sum('likes');
        $latestUsersBookings = User::latest()->take(5)->with('bookings')->get();
        $latestUsersReviews = User::latest()->take(5)->with('reviews')->get();
        $latestUsersDestinations = User::latest()->take(5)->with('destinations')->get();
        $latestUsersLikes = User::latest()->take(5)->with('likedDestinations')->get();
        $latestUsersWishlist = User::latest()->take(5)->with('wishlist')->get();
        $latestUsersBookingsCount = User::latest()->take(5)->withCount('bookings')->get();
        $latestUsersReviewsCount = User::latest()->take(5)->withCount('reviews')->get();
        $latestUsersDestinationsCount = User::latest()->take(5)->withCount('destinations')->get();
        $latestUsersLikesCount = User::latest()->take(5)->withCount('likedDestinations')->get();
        $latestUsersWishlistCount = User::latest()->take(5)->withCount('wishlist')->get();
        $latestBookingsCount = Booking::latest()->take(5)->count();
        $latestReviewsCount = Review::latest()->take(5)->count();
        $latestDestinationsCount = Destination::latest()->take(5)->count();
        $latestUsersCount = User::latest()->take(5)->count();
        $latestBookingsEarnings = Booking::where('paid', true)->latest()->take(5)->sum('price');
        $latestReviewsRatings = Review::latest()->take(5)->avg('rating');
        $latestDestinationsLikes = Destination::latest()->take(5)->sum('likes');
        $latestUsersBookings = User::latest()->take(5)->with('bookings')->get();
        $latestUsersReviews = User::latest()->take(5)->with('reviews')->get();
        $latestUsersDestinations = User::latest()->take(5)->with('destinations')->get();
        $latestUsersLikes = User::latest()->take(5)->with('likedDestinations')->get();