<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            [
                'name' => 'Dubai',
                'country' => 'United Arab Emirates',
                'description' => 'Experience luxury, adventure, shopping, and iconic attractions in Dubai.',
                'image' => 'dubai.jpg',
                'status' => true,
            ],
            [
                'name' => 'Istanbul',
                'country' => 'Turkey',
                'description' => 'Explore historic landmarks, rich culture, and beautiful views across Istanbul.',
                'image' => 'istanbul.jpg',
                'status' => true,
            ],
            [
                'name' => 'Maldives',
                'country' => 'Maldives',
                'description' => 'Enjoy crystal-clear waters, tropical beaches, and a relaxing island experience.',
                'image' => 'maldives.jpg',
                'status' => true,
            ],
            [
                'name' => 'London',
                'country' => 'United Kingdom',
                'description' => 'Discover historic landmarks, modern attractions, and the unique culture of London.',
                'image' => 'london.jpg',
                'status' => true,
            ],
            [
                'name' => 'Paris',
                'country' => 'France',
                'description' => 'Experience world-famous landmarks, art, culture, and the charm of Paris.',
                'image' => 'paris.jpg',
                'status' => true,
            ],
        ];

        foreach ($destinations as $destination) {
            Destination::create($destination);
        }
    }
}