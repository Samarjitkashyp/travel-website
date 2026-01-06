<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinations = Destination::latest()->paginate(10);
        return view('admin.destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = [
            'Assam', 'Goa', 'Kerala', 'Rajasthan', 'Himachal Pradesh', 
            'Uttarakhand', 'Tamil Nadu', 'Maharashtra', 'Karnataka',
            'West Bengal', 'Sikkim', 'Meghalaya', 'Nagaland', 'Mizoram'
        ];
        
        $categories = [
            'Hill Station', 'Beach', 'Heritage', 'Wildlife', 
            'Adventure', 'Religious', 'Historical', 'City', 
            'Cultural', 'Desert', 'Backwaters', 'Island'
        ];
        
        $types = ['City', 'Town', 'Hill Station', 'Beach', 'Island', 'Wildlife', 'Heritage'];
        
        return view('admin.destinations.create', compact('states', 'categories', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'state' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'price' => 'required|integer|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'description' => 'required',
            'overview' => 'nullable',
            'hotels_count' => 'nullable|integer|min:0',
            'best_time' => 'nullable|string|max:100',
            'ideal_duration' => 'nullable|string|max:50',
            'type' => 'nullable|string|max:50',
            'status' => 'required|in:active,inactive,draft',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($request->name);

        // Handle main image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('destinations', 'public');
            $validated['image'] = $imagePath;
        }

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            $heroImagePath = $request->file('hero_image')->store('destinations/hero', 'public');
            $validated['hero_image'] = $heroImagePath;
        }

        // Handle HTML content (SAFELY)
        $validated['description'] = strip_tags($request->description, 
            '<p><strong><b><em><i><u><a><br><ul><ol><li><h1><h2><h3><h4><h5><h6><span><div>');
        
        $validated['overview'] = strip_tags($request->overview,
            '<p><strong><b><em><i><u><a><br><ul><ol><li><h1><h2><h3><h4><h5><h6><img><table><tr><td><th><div><span>');

        // Handle basic JSON fields
        $validated['attractions'] = $this->processArrayInput($request->input('attractions', []));
        $validated['nearby_areas'] = $this->processArrayInput($request->input('nearby_areas', []));
        $validated['travel_tips'] = $this->processArrayInput($request->input('travel_tips', []));

        // Process new dynamic fields
        $validated['key_highlights'] = $this->processArrayInput($request->input('key_highlights', []));
        $validated['best_for_tags'] = $this->processArrayInput($request->input('best_for_tags', []));
        $validated['attractions_details'] = $this->processAttractionsDetails($request);
        $validated['popular_places'] = $this->processPopularPlaces($request);
        $validated['hotels_data'] = $this->processHotelsData($request);
        $validated['nearby_areas_detailed'] = $this->processNearbyAreasDetailed($request);
        $validated['more_nearby_destinations'] = $this->processMoreDestinations($request);
        $validated['travel_tips_faq'] = $this->processTravelTipsFaq($request);
        
        // Process gallery images
        $galleryImages = $request->input('gallery_images', []);
        $galleryAltTexts = $request->input('gallery_alt_text', []);
        $validated['gallery_images'] = $this->processGalleryImages($galleryImages, $galleryAltTexts);
        
        // Process quick facts
        $validated['quick_facts'] = [
            'language' => $request->input('quick_facts.language', ''),
            'time_zone' => $request->input('quick_facts.time_zone', ''),
            'currency' => $request->input('quick_facts.currency', ''),
            'emergency' => $request->input('quick_facts.emergency', ''),
            'voltage' => $request->input('quick_facts.voltage', ''),
            'climate' => $request->input('quick_facts.climate', ''),
        ];

        Destination::create($validated);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        return view('admin.destinations.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        $states = [
            'Assam', 'Goa', 'Kerala', 'Rajasthan', 'Himachal Pradesh', 
            'Uttarakhand', 'Tamil Nadu', 'Maharashtra', 'Karnataka',
            'West Bengal', 'Sikkim', 'Meghalaya', 'Nagaland', 'Mizoram'
        ];
        
        $categories = [
            'Hill Station', 'Beach', 'Heritage', 'Wildlife', 
            'Adventure', 'Religious', 'Historical', 'City', 
            'Cultural', 'Desert', 'Backwaters', 'Island'
        ];
        
        $types = ['City', 'Town', 'Hill Station', 'Beach', 'Island', 'Wildlife', 'Heritage'];

        return view('admin.destinations.edit', compact('destination', 'states', 'categories', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'state' => 'required|string|max:100',
            'category' => 'required|string|max:100',
            'price' => 'required|integer|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:255',
            'description' => 'required',
            'overview' => 'nullable',
            'hotels_count' => 'nullable|integer|min:0',
            'best_time' => 'nullable|string|max:100',
            'ideal_duration' => 'nullable|string|max:50',
            'type' => 'nullable|string|max:50',
            'status' => 'required|in:active,inactive,draft',
        ]);

        // Update slug if name changed
        if ($destination->name !== $request->name) {
            $validated['slug'] = Str::slug($request->name);
        }

        // Handle main image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($destination->image && Storage::disk('public')->exists($destination->image)) {
                Storage::disk('public')->delete($destination->image);
            }
            
            $imagePath = $request->file('image')->store('destinations', 'public');
            $validated['image'] = $imagePath;
        }

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            // Delete old hero image if exists
            if ($destination->hero_image && Storage::disk('public')->exists($destination->hero_image)) {
                Storage::disk('public')->delete($destination->hero_image);
            }
            
            $heroImagePath = $request->file('hero_image')->store('destinations/hero', 'public');
            $validated['hero_image'] = $heroImagePath;
        }

        // Handle HTML content (SAFELY)
        $validated['description'] = strip_tags($request->description, 
            '<p><strong><b><em><i><u><a><br><ul><ol><li><h1><h2><h3><h4><h5><h6><span><div>');
        
        $validated['overview'] = strip_tags($request->overview,
            '<p><strong><b><em><i><u><a><br><ul><ol><li><h1><h2><h3><h4><h5><h6><img><table><tr><td><th><div><span>');

        // Handle basic JSON fields
        $validated['attractions'] = $this->processArrayInput($request->input('attractions', []));
        $validated['nearby_areas'] = $this->processArrayInput($request->input('nearby_areas', []));
        $validated['travel_tips'] = $this->processArrayInput($request->input('travel_tips', []));

        // Process new dynamic fields
        $validated['key_highlights'] = $this->processArrayInput($request->input('key_highlights', []));
        $validated['best_for_tags'] = $this->processArrayInput($request->input('best_for_tags', []));
        $validated['attractions_details'] = $this->processAttractionsDetails($request);
        $validated['popular_places'] = $this->processPopularPlaces($request);
        $validated['hotels_data'] = $this->processHotelsData($request);
        $validated['nearby_areas_detailed'] = $this->processNearbyAreasDetailed($request);
        $validated['more_nearby_destinations'] = $this->processMoreDestinations($request);
        $validated['travel_tips_faq'] = $this->processTravelTipsFaq($request);
        
        // Process gallery images
        $galleryImages = $request->input('gallery_images', []);
        $galleryAltTexts = $request->input('gallery_alt_text', []);
        $validated['gallery_images'] = $this->processGalleryImages($galleryImages, $galleryAltTexts);
        
        // Process quick facts
        $validated['quick_facts'] = [
            'language' => $request->input('quick_facts.language', ''),
            'time_zone' => $request->input('quick_facts.time_zone', ''),
            'currency' => $request->input('quick_facts.currency', ''),
            'emergency' => $request->input('quick_facts.emergency', ''),
            'voltage' => $request->input('quick_facts.voltage', ''),
            'climate' => $request->input('quick_facts.climate', ''),
        ];

        $destination->update($validated);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        // Delete main image if exists
        if ($destination->image && Storage::disk('public')->exists($destination->image)) {
            Storage::disk('public')->delete($destination->image);
        }
        
        // Delete hero image if exists
        if ($destination->hero_image && Storage::disk('public')->exists($destination->hero_image)) {
            Storage::disk('public')->delete($destination->hero_image);
        }

        $destination->delete();

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination deleted successfully.');
    }

    /**
     * Process array input for JSON fields
     */
    private function processArrayInput(array $input): array
    {
        return array_filter(array_map('trim', $input));
    }

    /**
     * Process attractions details
     */
    private function processAttractionsDetails(Request $request): array
    {
        $attractions = $request->input('attractions_details', []);
        $result = [];
        
        foreach ($attractions as $attraction) {
            if (!empty($attraction['name'])) {
                $result[] = [
                    'name' => $attraction['name'] ?? '',
                    'location' => $attraction['location'] ?? '',
                    'rating' => floatval($attraction['rating'] ?? 0),
                    'description' => $attraction['description'] ?? '',
                    'image' => $attraction['image'] ?? '',
                    'button_text' => $attraction['button_text'] ?? 'View Details',
                ];
            }
        }
        
        return $result;
    }

    /**
     * Process popular places
     */
    private function processPopularPlaces(Request $request): array
    {
        $places = $request->input('popular_places', []);
        $result = [];
        
        foreach ($places as $place) {
            if (!empty($place['name'])) {
                $result[] = [
                    'icon' => $place['icon'] ?? 'fas fa-map-pin',
                    'name' => $place['name'] ?? '',
                    'description' => $place['description'] ?? '',
                ];
            }
        }
        
        return $result;
    }

    /**
     * Process hotels data
     */
    private function processHotelsData(Request $request): array
    {
        $hotels = $request->input('hotels_data', []);
        $result = [];
        
        foreach ($hotels as $hotel) {
            if (!empty($hotel['name'])) {
                $result[] = [
                    'name' => $hotel['name'] ?? '',
                    'location' => $hotel['location'] ?? '',
                    'price' => intval($hotel['price'] ?? 0),
                    'rating' => floatval($hotel['rating'] ?? 0),
                    'recommendation' => intval($hotel['recommendation'] ?? 0),
                    'features' => !empty($hotel['features']) ? 
                        array_map('trim', explode(',', $hotel['features'])) : [],
                    'image' => $hotel['image'] ?? '',
                    'button_text' => $hotel['button_text'] ?? 'View Details',
                ];
            }
        }
        
        return $result;
    }

    /**
     * Process nearby areas detailed
     */
    private function processNearbyAreasDetailed(Request $request): array
    {
        $areas = $request->input('nearby_areas_detailed', []);
        $result = [];
        
        foreach ($areas as $area) {
            if (!empty($area['name'])) {
                $result[] = [
                    'name' => $area['name'] ?? '',
                    'distance' => $area['distance'] ?? '',
                    'description' => $area['description'] ?? '',
                    'image' => $area['image'] ?? '',
                    'drive_time' => $area['drive_time'] ?? '',
                    'button_text' => $area['button_text'] ?? 'Explore',
                ];
            }
        }
        
        return $result;
    }

    /**
     * Process more destinations
     */
    private function processMoreDestinations(Request $request): array
    {
        $destinations = $request->input('more_nearby_destinations', []);
        $result = [];
        
        foreach ($destinations as $dest) {
            if (!empty($dest['name'])) {
                $result[] = [
                    'icon' => $dest['icon'] ?? 'fas fa-location-dot',
                    'name' => $dest['name'] ?? '',
                    'distance' => $dest['distance'] ?? '',
                    'category' => $dest['category'] ?? '',
                ];
            }
        }
        
        return $result;
    }

    /**
     * Process travel tips FAQ
     */
    private function processTravelTipsFaq(Request $request): array
    {
        $tips = $request->input('travel_tips_faq', []);
        $result = [];
        
        foreach ($tips as $tip) {
            if (!empty($tip['title'])) {
                $result[] = [
                    'icon' => $tip['icon'] ?? 'fas fa-info-circle',
                    'title' => $tip['title'] ?? '',
                    'content' => $tip['content'] ?? '',
                ];
            }
        }
        
        return $result;
    }

    /**
     * Process gallery images
     */
    private function processGalleryImages(array $images, array $altTexts): array
    {
        $result = [];
        
        for ($i = 0; $i < count($images); $i++) {
            if (!empty($images[$i])) {
                $result[] = [
                    'url' => $images[$i],
                    'alt' => $altTexts[$i] ?? 'Gallery Image',
                ];
            }
        }
        
        return $result;
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $ids = $request->input('selected_items', []);

        if (empty($ids)) {
            return back()->with('error', 'No destinations selected.');
        }

        switch ($action) {
            case 'delete':
                Destination::whereIn('id', $ids)->delete();
                $message = 'Destinations deleted successfully.';
                break;
                
            case 'activate':
                Destination::whereIn('id', $ids)->update(['status' => 'active']);
                $message = 'Destinations activated successfully.';
                break;
                
            case 'deactivate':
                Destination::whereIn('id', $ids)->update(['status' => 'inactive']);
                $message = 'Destinations deactivated successfully.';
                break;
                
            default:
                return back()->with('error', 'Invalid action.');
        }

        return back()->with('success', $message);
    }
}