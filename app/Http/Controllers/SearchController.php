<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    /**
     * Handle search results
     */
    public function searchResults(Request $request)
    {
        // Get all search parameters
        $searchParams = $request->all();
        
        // Get search results - ensure it returns a Collection
        $results = $this->getSearchResults($searchParams);
        
        // Convert array to Collection if needed
        if (is_array($results)) {
            $results = collect($results); // ✅ Convert array to Collection
        }
        
        // Get active filters
        $activeFilters = $this->getActiveFilters($searchParams);
        
        return view('frontend.search-results', [
            'searchParams' => $searchParams,
            'results' => $results, // ✅ Now this is a Collection
            'totalResults' => $results->count(),
            'activeFilters' => $activeFilters
        ]);
    }
    
    /**
     * Get search results (dummy data for now)
     */
    private function getSearchResults($params)
    {
        // Ensure this returns a Collection
        return collect([
            [
                'id' => 1,
                'type' => 'destination',
                'title' => 'Guwahati, Assam',
                'location' => 'Assam, North-East India',
                'rating' => 4.5,
                'price' => '8,000',
                'image' => 'https://images.unsplash.com/photo-1552733407-5d5c46c3bb3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'description' => 'Gateway to North-East India, known as the City of Temples.',
                'url' => '/destination/1',
                'amenities' => [
                    ['icon' => 'wifi', 'name' => 'Free WiFi'],
                    ['icon' => 'swimming-pool', 'name' => 'Pool'],
                    ['icon' => 'utensils', 'name' => 'Restaurant'],
                ]
            ],
            [
                'id' => 2,
                'type' => 'hotel',
                'title' => 'Radisson Blu Guwahati',
                'location' => 'GS Road, Guwahati',
                'rating' => 4.7,
                'price' => '5,500',
                'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'description' => 'Luxury hotel with river view and premium amenities.',
                'url' => '#',
                'amenities' => [
                    ['icon' => 'wifi', 'name' => 'Free WiFi'],
                    ['icon' => 'swimming-pool', 'name' => 'Pool'],
                    ['icon' => 'parking', 'name' => 'Parking'],
                ]
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
                'url' => '/destination/2',
                'amenities' => [
                    ['icon' => 'umbrella-beach', 'name' => 'Beach Access'],
                    ['icon' => 'cocktail', 'name' => 'Bar'],
                ]
            ],
            [
                'id' => 4,
                'type' => 'package',
                'title' => '7 Days Assam Tour',
                'location' => 'Guwahati, Kaziranga, Shillong',
                'rating' => 4.6,
                'price' => '25,000',
                'image' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80',
                'description' => 'Complete tour package covering major attractions of Assam.',
                'url' => '#',
                'amenities' => [
                    ['icon' => 'bus', 'name' => 'Transport'],
                    ['icon' => 'hotel', 'name' => 'Accommodation'],
                    ['icon' => 'utensils', 'name' => 'Meals'],
                ]
            ]
        ]);
    }
    
    /**
     * Get active filters for display
     */
    private function getActiveFilters($params)
    {
        $filters = [];
        
        if (!empty($params['location'])) {
            $filters[] = 'Location: ' . $params['location'];
        }
        
        if (!empty($params['category'])) {
            $filters[] = 'Category: ' . $params['category'];
        }
        
        if (!empty($params['q'])) {
            $filters[] = 'Search: ' . $params['q'];
        }
        
        // Price range filters
        if (!empty($params['min_price']) || !empty($params['max_price'])) {
            $min = $params['min_price'] ?? '0';
            $max = $params['max_price'] ?? 'Any';
            $filters[] = 'Price: ₹' . $min . ' - ' . $max;
        }
        
        // Rating filter
        if (!empty($params['min_rating']) && $params['min_rating'] > 0) {
            $filters[] = 'Min Rating: ' . $params['min_rating'] . ' stars';
        }
        
        return $filters;
    }
    
    /**
     * Handle advanced search
     */
    public function advancedSearch(Request $request)
    {
        // Collect all advanced search parameters
        $searchParams = $request->only([
            'location', 'categories', 'check_in', 'check_out',
            'guests', 'min_price', 'max_price', 'min_rating',
            'distance', 'sort_by', 'amenities', 'features',
            'hotel_type', 'transportation', 'budget'
        ]);
        
        // Get search results
        $results = $this->getSearchResults($searchParams);
        
        return view('frontend.search-results', [
            'searchParams' => $searchParams,
            'results' => $results,
            'totalResults' => $results->count(),
            'activeFilters' => $this->getActiveFilters($searchParams)
        ]);
    }
    
    /**
     * Handle basic search
     */
    public function basicSearch(Request $request)
    {
        $query = $request->query('q', '');
        $category = $request->query('category', '');
        $location = $request->query('location', '');
        
        // Get search results
        $results = $this->getSearchResults([
            'q' => $query,
            'category' => $category,
            'location' => $location
        ]);
        
        return view('frontend.search-results', [
            'query' => $query,
            'category' => $category,
            'location' => $location,
            'results' => $results,
            'totalResults' => $results->count(),
            'activeFilters' => $this->getActiveFilters([
                'q' => $query,
                'category' => $category,
                'location' => $location
            ])
        ]);
    }
    
    /**
     * Autocomplete locations
     */
    public function autocomplete(Request $request)
    {
        $query = $request->query('q', '');
        
        $locations = [
            ['name' => 'Guwahati, Assam', 'type' => 'City', 'id' => 1],
            ['name' => 'Goa', 'type' => 'State', 'id' => 2],
            ['name' => 'Kerala', 'type' => 'State', 'id' => 3],
            ['name' => 'Rajasthan', 'type' => 'State', 'id' => 4],
            ['name' => 'Delhi', 'type' => 'City', 'id' => 5],
        ];
        
        if (!empty($query)) {
            $filtered = array_filter($locations, function($item) use ($query) {
                return stripos($item['name'], $query) !== false;
            });
            $locations = array_values($filtered);
        }
        
        return response()->json($locations);
    }
}