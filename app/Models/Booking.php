<?php

// app/Models/Booking.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id',
        'user_id',
        'check_in',
        'number_travelers',
        'price',
        'paid'
    ];

    protected $casts = [
        'check_in' => 'date',
        'paid' => 'boolean',
        'price' => 'decimal:2'
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalPriceAttribute()
    {
        return $this->price * $this->number_travelers;
    }
}
