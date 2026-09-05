<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = Destination::all()->keyBy('name');

        $packages = [
            [
                'destination' => 'Dubai',
                'title' => 'Dubai City Explorer',
                'description' => 'Explore the iconic landmarks, modern attractions, shopping destinations, and vibrant city life of Dubai.',
                'price' => 850.00,
                'duration' => '5 Days / 4 Nights',
                'image' => 'dubai-city.jpg',
                'status' => true,
            ],
            [
                'destination' => 'Dubai',
                'title' => 'Dubai Luxury Escape',
                'description' => 'Enjoy a premium Dubai experience with luxury accommodation, sightseeing, and unforgettable city experiences.',
                'price' => 1250.00,
                'duration' => '7 Days / 6 Nights',
                'image' => 'dubai-luxury.jpg',
                'status' => true,
            ],
            [
                'destination' => 'Istanbul',
                'title' => 'Istanbul Heritage Tour',
                'description' => 'Discover the historic mosques, palaces, markets, and cultural heritage of Istanbul.',
                'price' => 750.00,
                'duration' => '5 Days / 4 Nights',
                'image' => 'istanbul-heritage.jpg',
                'status' => true,
            ],
            [
                'destination' => 'Istanbul',
                'title' => 'Istanbul Weekend Escape',
                'description' => 'Enjoy a short and memorable Istanbul getaway filled with history, culture, food, and beautiful views.',
                'price' => 550.00,
                'duration' => '3 Days / 2 Nights',
                'image' => 'istanbul-weekend.jpg',
                'status' => true,
            ],
            [
                'destination' => 'Maldives',
                'title' => 'Maldives Paradise',
                'description' => 'Relax on beautiful tropical islands and enjoy crystal-clear waters and peaceful beaches.',
                'price' => 1400.00,
                'duration' => '6 Days / 5 Nights',
                'image' => 'maldives-paradise.jpg',
                'status' => true,
            ],
            [
                'destination' => 'Maldives',
                'title' => 'Maldives Luxury Retreat',
                'description' => 'Experience an unforgettable luxury island retreat surrounded by beautiful beaches and turquoise waters.',
                'price' => 1900.00,
                'duration' => '7 Days / 6 Nights',
                'image' => 'maldives-luxury.jpg',
                'status' => true,
            ],
            [
                'destination' => 'London',
                'title' => 'London Explorer',
                'description' => 'Visit famous London landmarks, explore historic areas, and experience the heart of the United Kingdom.',
                'price' => 1100.00,
                'duration' => '6 Days / 5 Nights',
                'image' => 'london-explorer.jpg',
                'status' => true,
            ],
            [
                'destination' => 'London',
                'title' => 'London Royal Experience',
                'description' => 'Discover royal landmarks, historic streets, museums, and the classic charm of London.',
                'price' => 1350.00,
                'duration' => '7 Days / 6 Nights',
                'image' => 'london-royal.jpg',
                'status' => true,
            ],
            [
                'destination' => 'Paris',
                'title' => 'Paris City Experience',
                'description' => 'Explore the famous landmarks, museums, streets, and cultural highlights of Paris.',
                'price' => 1200.00,
                'duration' => '6 Days / 5 Nights',
                'image' => 'paris-city.jpg',
                'status' => true,
            ],
            [
                'destination' => 'Paris',
                'title' => 'Paris Romantic Escape',
                'description' => 'Enjoy the beautiful atmosphere, architecture, cuisine, and unforgettable experiences of Paris.',
                'price' => 1500.00,
                'duration' => '7 Days / 6 Nights',
                'image' => 'paris-romantic.jpg',
                'status' => true,
            ],
        ];

        foreach ($packages as $package) {
            Package::create([
                'destination_id' => $destinations[$package['destination']]->id,
                'title' => $package['title'],
                'description' => $package['description'],
                'price' => $package['price'],
                'duration' => $package['duration'],
                'image' => $package['image'],
                'status' => $package['status'],
            ]);
        }
    }
}