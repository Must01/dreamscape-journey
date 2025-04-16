<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        $destinations = [
            [
                'destination_name' => 'Paris City Break',
                'location' => 'Paris, France',
                'description' => 'Experience the magic of Paris with its iconic Eiffel Tower, world-class museums, and charming cafes.',
                'photos' => [],  // Empty array for now since we don't have actual photos
                'tour_duration' => 5,
                'max_travelers' => 10,
                'price' => 1299.99,
                'is_featured' => true
            ],
            [
                'destination_name' => 'Bali Paradise',
                'location' => 'Bali, Indonesia',
                'description' => 'Discover tropical beaches, ancient temples, and lush rice terraces in the Island of Gods. Experience Balinese culture and hospitality.',
                'photos' => [],  // Empty array for now since we don't have actual photos
                'tour_duration' => 7,
                'max_travelers' => 15,
                'price' => 1499.99,
                'is_featured' => false
            ],
            [
                'destination_name' => 'Tokyo Adventure',
                'location' => 'Tokyo, Japan',
                'description' => 'Immerse yourself in the vibrant blend of traditional and ultra-modern Japan. From anime culture to ancient temples, experience it all.',
                'photos' => [],  // Empty array for now since we don't have actual photos
                'tour_duration' => 6,
                'max_travelers' => 12,
                'price' => 1899.99,
                'is_featured' => true
            ],
            [
                'destination_name' => 'Santorini Escape',
                'location' => 'Santorini, Greece',
                'description' => 'Enjoy breathtaking sunsets, white-washed buildings, and crystal-clear waters in this Mediterranean paradise.',
                'photos' => [],  // Empty array for now since we don't have actual photos
                'tour_duration' => 4,
                'max_travelers' => 8,
                'price' => 1599.99,
                'is_featured' => false
            ],
            [
                'destination_name' => 'New York City Explorer',
                'location' => 'New York, USA',
                'description' => 'Explore the city that never sleeps with its iconic skyline, Broadway shows, Central Park, and diverse neighborhoods.',
                'photos' => [],  // Empty array for now since we don't have actual photos
                'tour_duration' => 5,
                'max_travelers' => 15,
                'price' => 1799.99,
                'is_featured' => true
            ]
        ];

        foreach ($destinations as $destination) {
            Destination::firstOrCreate(
                ['destination_name' => $destination['destination_name']],
                $destination
            );
        }
    }
}
