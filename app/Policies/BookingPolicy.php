<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;

class BookingPolicy
{
    public function view(User $user, Booking $booking)
    {
        return $user->id === $booking->user_id || $user->is_admin;
    }

    public function update(User $user, Booking $booking)
    {
        return $user->id === $booking->user_id && !$booking->paid;
    }

    public function delete(User $user, Booking $booking)
    {
        return ($user->id === $booking->user_id || $user->is_admin) && !$booking->paid;
    }
}
