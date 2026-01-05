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
            'description' => 'required|string',
            'overview' => 'nullable|string',
            'hotels_count' => 'nullable|integer|min:0',
            'best_time' => 'nullable|string|max:100',
            'ideal_duration' => 'nullable|string|max:50',
            'type' => 'nullable|string|max:50',
            'status' => 'required|in:active,inactive,draft',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($request->name);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('destinations', 'public');
            $validated['image'] = $imagePath;
        }

        // Handle JSON fields
        $validated['attractions'] = $this->processArrayInput($request->input('attractions', []));
        $validated['nearby_areas'] = $this->processArrayInput($request->input('nearby_areas', []));
        $validated['travel_tips'] = $this->processArrayInput($request->input('travel_tips', []));

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
            'description' => 'required|string',
            'overview' => 'nullable|string',
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

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($destination->image && Storage::disk('public')->exists($destination->image)) {
                Storage::disk('public')->delete($destination->image);
            }
            
            $imagePath = $request->file('image')->store('destinations', 'public');
            $validated['image'] = $imagePath;
        }

        // Handle JSON fields
        $validated['attractions'] = $this->processArrayInput($request->input('attractions', []));
        $validated['nearby_areas'] = $this->processArrayInput($request->input('nearby_areas', []));
        $validated['travel_tips'] = $this->processArrayInput($request->input('travel_tips', []));

        $destination->update($validated);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        // Delete image if exists
        if ($destination->image && Storage::disk('public')->exists($destination->image)) {
            Storage::disk('public')->delete($destination->image);
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