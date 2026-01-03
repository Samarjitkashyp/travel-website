<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Package;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Destinations
        |--------------------------------------------------------------------------
        */

        Destination::create([
            'destination_title' => 'Guwahati, Assam',
            'location' => 'Assam, North-East India',
            'state' => 'assam',
            'category' => 'heritage',
            'price' => 8500,
            'rating' => 4.7,
            'image' => 'destinations/guwahati.jpg',
            'description' => 'Gateway to North-East with Kamakhya Temple, Brahmaputra river, and rich cultural heritage.',
            'hotels_count' => 42,
            'best_time' => 'Oct - Mar',
            'ideal_duration' => '3-5 Days',
            'type' => 'city',
            'status' => 'active',
        ]);

        Destination::create([
            'destination_title' => 'Goa Beaches',
            'location' => 'Goa, West India',
            'state' => 'goa',
            'category' => 'beach',
            'price' => 12000,
            'rating' => 4.8,
            'image' => 'destinations/goa-destinations.avif',
            'description' => 'Famous for pristine beaches, Portuguese architecture, vibrant nightlife and seafood.',
            'hotels_count' => 68,
            'best_time' => 'Nov - Feb',
            'ideal_duration' => '5-7 Days',
            'type' => 'beach',
            'status' => 'active',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Hotels
        |--------------------------------------------------------------------------
        */

        Hotel::create([
            'name' => 'Taj Hotel, Guwahati',
            'location' => 'Near Kamakhya Temple, Guwahati',
            'rating' => 4.8,
            'price' => 5200,
            'type' => '5-star Luxury Hotel',
            'image' => 'hotels/hotels-2.jpg',
            'description' => 'Luxury hotel offering premium amenities and exceptional service.',
            'amenities' => json_encode(['Free WiFi', 'Swimming Pool', 'Spa', 'Restaurant']),
            'features' => json_encode(['5-star Luxury Hotel', 'City Center']),
            'near_location' => 'Kamakhya Temple',
            'recommended_percentage' => 95,
            'tax_inclusive' => true,
            'status' => 'active',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Packages
        |--------------------------------------------------------------------------
        */

        Package::create([
            'title' => 'Assam Heritage Tour',
            'duration' => '5 Days / 4 Nights',
            'location' => 'Guwahati, Kaziranga, Shillong',
            'original_price' => 28000,
            'discounted_price' => 22000,
            'discount_percentage' => 21,
            'image' => 'packages/assam-tour.jpg',
            'description' => 'Complete tour package covering major attractions of Assam and Meghalaya.',
            'inclusions' => json_encode([
                'Hotel Accommodation',
                'Breakfast Included',
                'Sightseeing Tour',
                'Transportation',
            ]),
            'status' => 'active',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Testimonials
        |--------------------------------------------------------------------------
        */

        Testimonial::create([
            'name' => 'Rajesh Kumar',
            'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg',
            'rating' => 5,
            'content' => 'Excellent service and luxurious rooms. The staff was very helpful and the location is perfect for visiting Kamakhya Temple.',
            'visited_location' => 'Guwahati, Assam',
            'status' => 'active',
        ]);
    }
}
