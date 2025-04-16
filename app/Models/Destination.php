<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Destination extends Model
{
    protected $fillable = [
        'destination_name',
        'location',
        'description',
        'photos',
        'tour_duration',
        'max_travelers',
        'price',
        'is_featured'
    ];

    protected $casts = [
        'photos' => 'array',
        'price' => 'decimal:2',
        'is_featured' => 'boolean'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getFirstPhotoUrlAttribute()
    {
        if ($this->photos && is_array($this->photos) && !empty($this->photos)) {
            return url('storage/' . $this->photos[0]);
        }
        return null;
    }

    public function getMainPhotoUrlAttribute()
    {
        return $this->first_photo_url;
    }
}
