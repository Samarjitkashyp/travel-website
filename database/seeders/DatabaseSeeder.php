<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Package;
use App\Models\Testimonial;
use App\Models\WebsiteContent;
use App\Models\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'name' => 'Guwahati, Assam', // ✅ Changed from 'destination_title' to 'name'
            'slug' => Str::slug('Guwahati Assam'),
            'location' => 'Assam, North-East India',
            'state' => 'assam',
            'category' => 'heritage',
            'price' => 8500,
            'rating' => 4.7,
            'image' => 'destinations/guwahati.jpg',
            'description' => 'Gateway to North-East with Kamakhya Temple, Brahmaputra river, and rich cultural heritage.',
            'overview' => 'Guwahati, the gateway to North-East India, is a vibrant city nestled on the banks of the mighty Brahmaputra River. Known as the "City of Temples," it offers a perfect blend of ancient heritage and modern urban life.',
            'attractions' => ['Kamakhya Temple', 'Brahmaputra River Cruise', 'Umananda Island', 'Assam State Zoo'],
            'nearby_areas' => ['Shillong (100 km)', 'Kaziranga (200 km)', 'Cherrapunji (150 km)'],
            'travel_tips' => ['Best time: Oct-Mar', 'Carry umbrella in monsoon', 'Try local Assamese cuisine'],
            'hotels_count' => 42,
            'best_time' => 'Oct - Mar',
            'ideal_duration' => '3-5 Days',
            'type' => 'city',
            'status' => 'active',
        ]);

        Destination::create([
            'name' => 'Goa Beaches', // ✅ Changed from 'destination_title' to 'name'
            'slug' => Str::slug('Goa Beaches'),
            'location' => 'Goa, West India',
            'state' => 'goa',
            'category' => 'beach',
            'price' => 12000,
            'rating' => 4.8,
            'image' => 'destinations/goa-destinations.avif',
            'description' => 'Famous for pristine beaches, Portuguese architecture, vibrant nightlife and seafood.',
            'overview' => 'Goa, India\'s smallest state, is known for its stunning beaches, Portuguese heritage, delicious seafood, and vibrant nightlife. A perfect blend of Indian and Western cultures.',
            'attractions' => ['Baga Beach', 'Calangute Beach', 'Fort Aguada', 'Basilica of Bom Jesus'],
            'nearby_areas' => ['Mumbai (600 km)', 'Pune (450 km)', 'Gokarna (150 km)'],
            'travel_tips' => ['Best time: Nov-Feb', 'Rent a scooter for travel', 'Try fish curry rice'],
            'hotels_count' => 68,
            'best_time' => 'Nov - Feb',
            'ideal_duration' => '5-7 Days',
            'type' => 'beach',
            'status' => 'active',
        ]);

        // Add more destinations
        Destination::create([
            'name' => 'Munnar, Kerala',
            'slug' => Str::slug('Munnar Kerala'),
            'location' => 'Kerala, South India',
            'state' => 'kerala',
            'category' => 'hill',
            'price' => 9500,
            'rating' => 4.6,
            'image' => 'destinations/munnar.jpg',
            'description' => 'Beautiful hill station with tea plantations, waterfalls, and pleasant climate.',
            'hotels_count' => 35,
            'best_time' => 'Sep - May',
            'ideal_duration' => '4-6 Days',
            'type' => 'hill station',
            'status' => 'active',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Hotels
        |--------------------------------------------------------------------------
        */

        Hotel::create([
            'name' => 'Taj Hotel, Guwahati',
            'slug' => 'taj-hotel-guwahati',
            'location' => 'Near Kamakhya Temple, Guwahati',
            'rating' => 4.8,
            'price' => 5200,
            'type' => '5-star Luxury Hotel',
            'image' => 'hotels/hotels-2.jpg',
            'description' => 'Luxury hotel offering premium amenities and exceptional service.',
            'amenities' => ['Free WiFi', 'Swimming Pool', 'Spa', 'Restaurant', '24/7 Room Service', 'Parking'], // ✅ Direct array
            'features' => ['5-star Luxury Hotel', 'City Center', 'River View'], // ✅ Direct array
            'room_amenities' => ['Air Conditioning', 'Minibar', 'TV', 'Safe', 'Private Bathroom'],
            'nearby_attractions' => ['Kamakhya Temple (1.5 km)', 'Brahmaputra River (3 km)'],
            'near_location' => 'Kamakhya Temple',
            'recommended_percentage' => 95,
            'tax_inclusive' => true,
            'free_cancellation' => true,
            'check_in_time' => '14:00',
            'check_out_time' => '12:00',
            'status' => 'active',
        ]);

        Hotel::create([
            'name' => 'Goa Marriott Resort',
            'slug' => 'goa-marriott-resort',
            'location' => 'Miramar Beach, Goa',
            'rating' => 4.6,
            'price' => 7800,
            'type' => 'Beach Resort',
            'image' => 'hotels/goa-marriott.jpg',
            'description' => 'Beachfront luxury resort with stunning views and premium amenities.',
            'amenities' => ['Beach View', 'All Inclusive', 'Kids Club', 'Water Sports', 'Pool Bar'],
            'features' => ['Beach Resort', 'Family Friendly', 'Water Activities'],
            'status' => 'active',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Packages
        |--------------------------------------------------------------------------
        */

        Package::create([
            'title' => 'Assam Heritage Tour',
            'slug' => 'assam-heritage-tour',
            'duration' => '5 Days / 4 Nights',
            'location' => 'Guwahati, Kaziranga, Shillong',
            'destinations' => ['Guwahati', 'Kaziranga National Park', 'Shillong'],
            'original_price' => 28000,
            'discounted_price' => 22000,
            'discount_percentage' => 21,
            'image' => 'packages/assam-tour.jpg',
            'description' => 'Complete tour package covering major attractions of Assam and Meghalaya.',
            'highlights' => 'Visit Kamakhya Temple, Kaziranga Rhino Safari, Shillong viewpoints',
            'inclusions' => ['Hotel Accommodation', 'Breakfast Included', 'Sightseeing Tour', 'Transportation'], // ✅ Direct array
            'exclusions' => ['Lunch & Dinner', 'Personal Expenses', 'Travel Insurance'],
            'itinerary' => [
                ['day' => 1, 'title' => 'Arrival in Guwahati', 'description' => 'Check-in and local sightseeing'],
                ['day' => 2, 'title' => 'Guwahati Exploration', 'description' => 'Visit Kamakhya Temple and river cruise'],
            ],
            'status' => 'active',
            'featured' => true,
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
            'user_type' => 'Business Traveler',
            'status' => 'active',
            'featured' => true,
        ]);

        Testimonial::create([
            'name' => 'Priya Sharma',
            'avatar' => 'https://randomuser.me/api/portraits/women/44.jpg',
            'rating' => 5,
            'content' => 'Amazing experience! The travel arrangements were perfect and we had a wonderful time in Goa.',
            'visited_location' => 'Goa',
            'user_type' => 'Family Traveler',
            'status' => 'active',
            'featured' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Website Contents (For dynamic content management)
        |--------------------------------------------------------------------------
        */

        WebsiteContent::create([
            'key' => 'home_hero_title',
            'section' => 'homepage',
            'content' => 'Discover Amazing Travel Destinations',
            'type' => 'text',
            'display_order' => 1,
            'status' => 'active',
        ]);

        WebsiteContent::create([
            'key' => 'home_hero_subtitle',
            'section' => 'homepage',
            'content' => 'Explore the world\'s most beautiful places, find perfect accommodations, and create unforgettable memories.',
            'type' => 'text',
            'display_order' => 2,
            'status' => 'active',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Create Admin User
        |--------------------------------------------------------------------------
        */

        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@travelexplorer.com',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);
    }
}