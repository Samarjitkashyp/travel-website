<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| All routes are loaded by the RouteServiceProvider.
|
*/

// ===================================================================
// 1. BASIC ROUTES
// ===================================================================

/**
 * Homepage Route
 * URL: /
 * Name: home
 * Purpose: Frontpage/Homepage display
 */
Route::get('/', function () {
    return view('home'); // Change from 'frontend.home' to 'home'
})->name('home');

/**
 * Destination Detail Page
 * URL: /destination/{id}
 * Name: destination.show
 * Purpose: Single destination page with details, hotels, nearby areas
 */
Route::get('/destination/{id}', function ($id) {
    return view('destination', ['id' => $id]); // Remove 'frontend.' prefix
})->name('destination.show');

// ===================================================================
// 2. HOTELS ROUTES
// ===================================================================

/**
 * All Hotels Listing Page
 * URL: /hotels
 * Name: hotels
 * Purpose: Display all hotels in grid view
 */
Route::get('/hotels', function () {
    return view('hotels'); // Remove 'frontend.' prefix
})->name('hotels');

/**
 * Hotel Detail Page - Dynamic
 * URL: /hotel/{slug}
 * Name: hotel.show
 * Purpose: Single hotel page with booking form and details
 */
Route::get('/hotel/{slug}', function ($slug) {
    // Hotel data based on slug
    $hotels = [
        'taj-guwahati' => [
            'id' => 1,
            'name' => 'Taj Hotel, Guwahati',
            'location' => 'Near Kamakhya Temple, Guwahati, Assam',
            'rating' => 4.8,
            'price' => 5200,
            'type' => '5-star Luxury Hotel',
            'description' => 'Experience luxury and comfort at Taj Hotel, located near the famous Kamakhya Temple in Guwahati.',
            'features' => ['Free WiFi', 'Swimming Pool', 'Spa', 'Restaurant', '24/7 Room Service'],
            'room_amenities' => ['Air Conditioning', 'Minibar', 'TV', 'Safe', 'Private Bathroom']
        ],
        'goa-marriott' => [
            'id' => 2,
            'name' => 'Goa Marriott Resort',
            'location' => 'Miramar Beach, Goa',
            'rating' => 4.6,
            'price' => 7800,
            'type' => 'Beach Resort',
            'description' => 'Beachfront luxury resort with stunning views and premium amenities.',
            'features' => ['Beach View', 'All Inclusive', 'Kids Club', 'Water Sports'],
            'room_amenities' => ['Sea View', 'Balcony', 'Mini Fridge', 'Coffee Maker']
        ],
        'tea-country-munnar' => [
            'id' => 3,
            'name' => 'Tea Country Resort',
            'location' => 'Tea Gardens, Munnar',
            'rating' => 4.5,
            'price' => 4500,
            'type' => 'Hill Station Resort',
            'description' => 'Nestled in tea plantations with breathtaking mountain views.',
            'features' => ['Mountain View', 'Tea Plantation', 'Bonfire', 'Trekking'],
            'room_amenities' => ['Fireplace', 'Garden View', 'Hot Water', 'Room Heater']
        ],
        'rambagh-palace' => [
            'id' => 4,
            'name' => 'Rambagh Palace',
            'location' => 'Palace Road, Jaipur',
            'rating' => 4.9,
            'price' => 12500,
            'type' => 'Heritage Palace Hotel',
            'description' => 'Experience royal living in this converted palace with butler service.',
            'features' => ['Royal Suites', 'Fine Dining', 'Spa & Wellness', 'Butler Service'],
            'room_amenities' => ['Palace View', 'Antique Furniture', 'Marble Bathroom', 'Private Pool']
        ],
        'shimla-winter-retreat' => [
            'id' => 5,
            'name' => 'Shimla Winter Retreat',
            'location' => 'The Mall Road, Shimla',
            'rating' => 4.3,
            'price' => 3800,
            'type' => 'Colonial Style Hotel',
            'description' => 'Colonial era hotel with vintage charm and modern amenities.',
            'features' => ['Fireplace', 'Snow View', 'Library', 'Garden'],
            'room_amenities' => ['Heated Rooms', 'Wooden Interiors', 'Writing Desk', 'Vintage Bath']
        ]
    ];

    // Check if hotel exists
    if (!array_key_exists($slug, $hotels)) {
        abort(404, 'Hotel not found');
    }

    return view('hotel', [ // Remove 'frontend.' prefix
        'hotel' => $hotels[$slug],
        'slug' => $slug
    ]);
})->name('hotel.show');

// ===================================================================
// 3. SEARCH ROUTES - UPDATED: Use SearchController for all search routes
// ===================================================================

/**
 * Basic Search Route - UPDATED: Now using SearchController
 * URL: /search
 * Name: search
 * Purpose: Handles basic search from header search box
 */
Route::get('/search', [SearchController::class, 'basicSearch'])->name('search');

/**
 * Advanced Search Route - UPDATED: Now using SearchController
 * URL: /search/advanced
 * Name: search.advanced
 * Purpose: Handles advanced search form submissions
 */
Route::get('/search/advanced', [SearchController::class, 'advancedSearch'])->name('search.advanced');

/**
 * Search Results Page - UPDATED: Now using SearchController
 * URL: /search/results
 * Name: search.results
 * Purpose: Displays search results (can handle both basic and advanced)
 */
Route::get('/search/results', [SearchController::class, 'searchResults'])->name('search.results');

/**
 * Autocomplete API Endpoint - UPDATED: Now using SearchController
 * URL: /api/autocomplete/locations
 * Name: autocomplete.locations
 * Purpose: Provides location suggestions for search autocomplete
 */
Route::get('/api/autocomplete/locations', [SearchController::class, 'autocomplete'])->name('autocomplete.locations');

// ===================================================================
// 4. AUTHENTICATION ROUTES - UPDATED: Use Controllers
// ===================================================================

// ===================================================================
// 2. AUTHENTICATION ROUTES - SIRF YEH EK LINE
// ===================================================================
Auth::routes();



// ===================================================================
// 3. DASHBOARD ROUTE (After login redirect)
// ===================================================================
Route::get('/dashboard', function () {
    return view('auth.dashboard');
})->middleware('auth')->name('dashboard');

// ===================================================================
// 5. ADDITIONAL PAGES - UPDATED: Remove 'frontend.' prefix
// ===================================================================

/**
 * About Us Page
 * URL: /about
 * Name: about
 * Purpose: Company information page
 */
Route::get('/about', function () {
    return view('about'); // Remove 'frontend.' prefix
})->name('about');

/**
 * Contact Us Page
 * URL: /contact
 * Name: contact
 * Purpose: Contact information and form
 */
Route::get('/contact', function () {
    return view('contact'); // Remove 'frontend.' prefix
})->name('contact');

/**
 * Packages Listing Page
 * URL: /packages
 * Name: packages
 * Purpose: Travel packages listing page
 */
Route::get('/packages', function () {
    return view('packages'); // Remove 'frontend.' prefix
})->name('packages');

// ===================================================================
// 6. TEMPORARY DEMO ROUTES (For development only) - UPDATED
// ===================================================================

/**
 * Demo Hotels Page
 * URL: /demo/hotels
 * Name: demo.hotels
 * Purpose: Demo hotels listing (temporary)
 */
Route::get('/demo/hotels', function () {
    return view('demo.hotels'); // Remove 'frontend.' prefix
})->name('demo.hotels');

/**
 * Demo Hotel Detail
 * URL: /demo/hotel/{id}
 * Name: demo.hotel
 * Purpose: Demo hotel detail page (temporary)
 */
Route::get('/demo/hotel/{id}', function ($id) {
    return view('demo.hotel', ['id' => $id]); // Remove 'frontend.' prefix
})->name('demo.hotel');

// ===================================================================
// 7. HELPER FUNCTIONS (For demo/fallback purposes only)
// ===================================================================

/**
 * Get demo search results (Temporary function - fallback)
 * @return array Demo search results
 */
if (!function_exists('getDemoResults')) {
    function getDemoResults() {
        return [
            [
                'id' => 1,
                'type' => 'destination',
                'title' => 'Guwahati, Assam',
                'location' => 'Assam, North-East India',
                'rating' => 4.5,
                'price' => '8,000',
                'image' => 'https://images.unsplash.com/photo-1552733407-5d5c46c3bb3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'description' => 'Gateway to North-East India, known as the City of Temples.',
                'url' => '/destination/1'
            ],
            [
                'id' => 2,
                'type' => 'hotel',
                'title' => 'Taj Hotel, Guwahati',
                'location' => 'Near Kamakhya Temple, Guwahati',
                'rating' => 4.8,
                'price' => '5,200',
                'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'description' => '5-star luxury hotel with premium amenities and services.',
                'url' => '/hotel/taj-guwahati'
            ],
            [
                'id' => 3,
                'type' => 'destination',
                'title' => 'Goa',
                'location' => 'West Coast, India',
                'rating' => 4.8,
                'price' => '12,000',
                'image' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'description' => 'Famous for beaches, Portuguese heritage, and nightlife.',
                'url' => '/destination/2'
            ],
            [
                'id' => 4,
                'type' => 'hotel',
                'title' => 'Goa Marriott Resort',
                'location' => 'Miramar Beach, Goa',
                'rating' => 4.6,
                'price' => '7,800',
                'image' => 'https://images.unsplash.com/photo-1551882547-ff3700d75d25?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'description' => 'Beachfront luxury resort with stunning views.',
                'url' => '/hotel/goa-marriott'
            ],
            [
                'id' => 5,
                'type' => 'hotel',
                'title' => 'Tea Country Resort',
                'location' => 'Tea Gardens, Munnar',
                'rating' => 4.5,
                'price' => '4,500',
                'image' => 'https://images.unsplash.com/photo-1571896349842-3c7ad8e27b86?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'description' => 'Hill station resort nestled in tea plantations.',
                'url' => '/hotel/tea-country-munnar'
            ],
            [
                'id' => 6,
                'type' => 'package',
                'title' => '7 Days Assam Tour',
                'location' => 'Guwahati, Kaziranga, Shillong',
                'rating' => 4.6,
                'price' => '25,000',
                'image' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'description' => 'Complete tour package covering major attractions of Assam.',
                'url' => '#'
            ]
        ];
    }
}

/**
 * Get demo hotels data (For hotels listing page)
 * @return array Demo hotels data
 */
if (!function_exists('getDemoHotels')) {
    function getDemoHotels() {
        return [
            [
                'id' => 1,
                'slug' => 'taj-guwahati',
                'name' => 'Taj Hotel, Guwahati',
                'location' => 'Near Kamakhya Temple, Guwahati',
                'rating' => 4.8,
                'price' => 5200,
                'type' => '5-star Luxury Hotel',
                'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'features' => ['Free WiFi', 'Pool', 'Spa', 'Restaurant', 'Parking'],
                'description' => 'Luxury hotel offering premium amenities and exceptional service.'
            ],
            [
                'id' => 2,
                'slug' => 'goa-marriott',
                'name' => 'Goa Marriott Resort',
                'location' => 'Miramar Beach, Goa',
                'rating' => 4.6,
                'price' => 7800,
                'type' => 'Beach Resort',
                'image' => 'https://images.unsplash.com/photo-1551882547-ff3700d75d25?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'features' => ['Beach View', 'All Inclusive', 'Kids Club', 'Water Sports'],
                'description' => 'Beachfront resort with stunning views and family-friendly amenities.'
            ],
            [
                'id' => 3,
                'slug' => 'tea-country-munnar',
                'name' => 'Tea Country Resort',
                'location' => 'Tea Gardens, Munnar',
                'rating' => 4.5,
                'price' => 4500,
                'type' => 'Hill Station Resort',
                'image' => 'https://images.unsplash.com/photo-1571896349842-3c7ad8e27b86?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'features' => ['Mountain View', 'Tea Plantation', 'Bonfire', 'Trekking'],
                'description' => 'Peaceful retreat nestled in tea plantations with mountain views.'
            ],
            [
                'id' => 4,
                'slug' => 'rambagh-palace',
                'name' => 'Rambagh Palace',
                'location' => 'Palace Road, Jaipur',
                'rating' => 4.9,
                'price' => 12500,
                'type' => 'Heritage Palace Hotel',
                'image' => 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'features' => ['Royal Suites', 'Fine Dining', 'Spa & Wellness', 'Butler Service'],
                'description' => 'Experience royal living in this beautifully converted palace.'
            ],
            [
                'id' => 5,
                'slug' => 'shimla-winter-retreat',
                'name' => 'Shimla Winter Retreat',
                'location' => 'The Mall Road, Shimla',
                'rating' => 4.3,
                'price' => 3800,
                'type' => 'Colonial Style Hotel',
                'image' => 'https://images.unsplash.com/photo-1551632436-cbf8dd35ad39?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'features' => ['Fireplace', 'Snow View', 'Library', 'Garden'],
                'description' => 'Colonial era hotel with vintage charm and modern comforts.'
            ],
            [
                'id' => 6,
                'slug' => 'chennai-grand',
                'name' => 'Chennai Grand Hotel',
                'location' => 'Marina Beach Road, Chennai',
                'rating' => 4.4,
                'price' => 3500,
                'type' => 'Business Hotel',
                'image' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'features' => ['City View', 'Conference Rooms', 'Gym', 'Business Center'],
                'description' => 'Modern business hotel with excellent connectivity and facilities.'
            ],
            [
                'id' => 7,
                'slug' => 'kerala-backwaters',
                'name' => 'Kerala Backwaters Resort',
                'location' => 'Alleppey, Kerala',
                'rating' => 4.7,
                'price' => 6500,
                'type' => 'Backwater Resort',
                'image' => 'https://images.unsplash.com/photo-1519925610903-0cad6a038a4c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'features' => ['Backwater View', 'Houseboat Stay', 'Ayurveda Center', 'Cultural Shows'],
                'description' => 'Serene resort overlooking the famous Kerala backwaters.'
            ],
            [
                'id' => 8,
                'slug' => 'rishikesh-yoga',
                'name' => 'Rishikesh Yoga Retreat',
                'location' => 'Ganga Riverside, Rishikesh',
                'rating' => 4.6,
                'price' => 2800,
                'type' => 'Yoga Retreat',
                'image' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'features' => ['Yoga Classes', 'Meditation Hall', 'Vegetarian Food', 'Ganga Aarti'],
                'description' => 'Spiritual retreat offering yoga and meditation programs by the Ganges.'
            ]
        ];
    }
}

/**
 * Get demo active filters (Temporary function - fallback)
 * @param array $params Search parameters
 * @return array Active filters for display
 */
if (!function_exists('getDemoFilters')) {
    function getDemoFilters($params) {
        $filters = [];
        
        if (!empty($params['q'])) {
            $filters[] = 'Search: ' . $params['q'];
        }
        
        if (!empty($params['location'])) {
            $filters[] = 'Location: ' . $params['location'];
        }
        
        if (!empty($params['category'])) {
            $filters[] = 'Category: ' . $params['category'];
        }
        
        if (!empty($params['min_price']) || !empty($params['max_price'])) {
            $min = $params['min_price'] ?? '0';
            $max = $params['max_price'] ?? 'Any';
            $filters[] = 'Price: ₹' . $min . ' - ' . $max;
        }
        
        return $filters;
    }
}

/**
 * Get active filters helper (For advanced search - fallback)
 * @param array $params Search parameters
 * @return array Filter descriptions
 */
if (!function_exists('getActiveFilters')) {
    function getActiveFilters($params) {
        $filters = [];
        
        if (!empty($params['location'])) {
            $filters[] = 'Location: ' . $params['location'];
        }
        
        if (!empty($params['categories'])) {
            if (is_array($params['categories'])) {
                $filters[] = 'Categories: ' . implode(', ', $params['categories']);
            } else {
                $filters[] = 'Category: ' . $params['categories'];
            }
        }
        
        if (!empty($params['check_in']) && !empty($params['check_out'])) {
            $filters[] = 'Dates: ' . $params['check_in'] . ' to ' . $params['check_out'];
        }
        
        if (!empty($params['min_price']) || !empty($params['max_price'])) {
            $min = $params['min_price'] ?? '0';
            $max = $params['max_price'] ?? 'Any';
            $filters[] = 'Price Range: ₹' . $min . ' - ₹' . $max;
        }
        
        if (!empty($params['min_rating']) && $params['min_rating'] > 0) {
            $filters[] = 'Min Rating: ' . $params['min_rating'] . ' stars';
        }
        
        return $filters;
    }
}