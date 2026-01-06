@extends('layouts.admin')

@section('title', 'Edit Destination - Travel Explorer')
@section('page-title', 'Edit Destination: ' . $destination->name)

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.destinations.update', $destination) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Basic Information -->
                    <h5 class="mb-4">
                        <i class="fas fa-info-circle text-primary me-2"></i>Basic Information
                    </h5>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Destination Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $destination->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="location" class="form-label">Location *</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                   id="location" name="location" value="{{ old('location', $destination->location) }}" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="state" class="form-label">State *</label>
                            <select class="form-select @error('state') is-invalid @enderror" 
                                    id="state" name="state" required>
                                <option value="">Select State</option>
                                @foreach($states as $state)
                                    <option value="{{ $state }}" {{ old('state', $destination->state) == $state ? 'selected' : '' }}>
                                        {{ $state }}
                                    </option>
                                @endforeach
                            </select>
                            @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="category" class="form-label">Category *</label>
                            <select class="form-select @error('category') is-invalid @enderror" 
                                    id="category" name="category" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ old('category', $destination->category) == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type">
                                <option value="">Select Type</option>
                                @foreach($types as $type)
                                    <option value="{{ $type }}" {{ old('type', $destination->type) == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Pricing & Rating -->
                    <h5 class="mb-4">
                        <i class="fas fa-rupee-sign text-primary me-2"></i>Pricing & Rating
                    </h5>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="price" class="form-label">Starting Price (₹) *</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price', $destination->price) }}" min="0" required>
                            <small class="text-muted">Enter per person starting price</small>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="rating" class="form-label">Rating (1-5)</label>
                            <input type="number" step="0.1" class="form-control @error('rating') is-invalid @enderror" 
                                   id="rating" name="rating" value="{{ old('rating', $destination->rating) }}" min="0" max="5">
                            <small class="text-muted">Enter rating between 0-5</small>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Image Upload -->
                    <h5 class="mb-4">
                        <i class="fas fa-image text-primary me-2"></i>Destination Images
                    </h5>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <!-- Current Main Image -->
                            @if($destination->image)
                                <div class="mb-3">
                                    <label class="form-label">Current Main Image</label>
                                    <div>
                                        <img src="{{ asset('storage/' . $destination->image) }}" 
                                             alt="{{ $destination->name }}" 
                                             class="img-thumbnail" 
                                             style="max-height: 200px;">
                                    </div>
                                </div>
                            @endif
                            
                            <label for="image" class="form-label">
                                @if($destination->image)
                                    Change Main Image (Optional)
                                @else
                                    Upload Main Image
                                @endif
                            </label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            <small class="text-muted">Recommended size: 800x600px, Max: 2MB</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <label class="form-label">New Image Preview</label>
                                <img id="previewImage" src="" alt="Preview" 
                                     class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <!-- Current Hero Image -->
                            @if($destination->hero_image)
                                <div class="mb-3">
                                    <label class="form-label">Current Hero Image</label>
                                    <div>
                                        <img src="{{ asset('storage/' . $destination->hero_image) }}" 
                                             alt="{{ $destination->name }}" 
                                             class="img-thumbnail" 
                                             style="max-height: 200px;">
                                    </div>
                                </div>
                            @endif
                            
                            <label for="hero_image" class="form-label">
                                @if($destination->hero_image)
                                    Change Hero Image (Optional)
                                @else
                                    Upload Hero Image
                                @endif
                            </label>
                            <input type="file" class="form-control @error('hero_image') is-invalid @enderror" 
                                   id="hero_image" name="hero_image" accept="image/*">
                            <small class="text-muted">Recommended: 1920x500px, Max: 5MB</small>
                            @error('hero_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <!-- Hero Image Preview -->
                            <div id="heroImagePreview" class="mt-3" style="display: none;">
                                <label class="form-label">New Hero Image Preview</label>
                                <img id="previewHeroImage" src="" alt="Hero Preview" 
                                     class="img-thumbnail" style="max-height: 150px;">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Hero Section -->
                    <h5 class="mb-4">
                        <i class="fas fa-images text-primary me-2"></i>Hero Section Content
                    </h5>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="hero_title" class="form-label">Hero Title</label>
                            <input type="text" class="form-control" id="hero_title" name="hero_title" 
                                   value="{{ old('hero_title', $destination->hero_title) }}" placeholder="e.g., Explore Guwahati">
                            <small class="text-muted">Leave empty to use destination name</small>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="hero_subtitle" class="form-label">Hero Subtitle</label>
                            <input type="text" class="form-control" id="hero_subtitle" name="hero_subtitle" 
                                   value="{{ old('hero_subtitle', $destination->hero_subtitle) }}" placeholder="e.g., Gateway to North-East India">
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <h5 class="mb-4">
                        <i class="fas fa-file-alt text-primary me-2"></i>Description
                    </h5>
                    
                    <div class="mb-4">
                        <label for="description" class="form-label">Short Description *</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="summernote-description" name="description" rows="3">{{ old('description', $destination->description) }}</textarea>
                        <small class="text-muted">Brief description for cards and listings</small>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="overview" class="form-label">Detailed Overview</label>
                        <textarea class="form-control @error('overview') is-invalid @enderror" 
                                  id="summernote-overview" name="overview" rows="5">{{ old('overview', $destination->overview) }}</textarea>
                        <small class="text-muted">Detailed information about the destination</small>
                        @error('overview')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Additional Information -->
                    <h5 class="mb-4">
                        <i class="fas fa-cog text-primary me-2"></i>Additional Information
                    </h5>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="hotels_count" class="form-label">Hotels Count</label>
                            <input type="number" class="form-control @error('hotels_count') is-invalid @enderror" 
                                   id="hotels_count" name="hotels_count" value="{{ old('hotels_count', $destination->hotels_count) }}" min="0">
                            @error('hotels_count')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="best_time" class="form-label">Best Time to Visit</label>
                            <input type="text" class="form-control @error('best_time') is-invalid @enderror" 
                                   id="best_time" name="best_time" value="{{ old('best_time', $destination->best_time) }}">
                            <small class="text-muted">e.g., Oct-Mar, Year-round</small>
                            @error('best_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="ideal_duration" class="form-label">Ideal Duration</label>
                            <input type="text" class="form-control @error('ideal_duration') is-invalid @enderror" 
                                   id="ideal_duration" name="ideal_duration" value="{{ old('ideal_duration', $destination->ideal_duration) }}">
                            <small class="text-muted">e.g., 3-5 days, 1 week</small>
                            @error('ideal_duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Key Highlights & Best For -->
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <h5 class="mb-4">
                                <i class="fas fa-star text-primary me-2"></i>Key Highlights
                            </h5>
                            
                            <div id="keyHighlightsContainer">
                                @php
                                    $keyHighlights = old('key_highlights', $destination->key_highlights ?? []);
                                    if(empty($keyHighlights)) $keyHighlights = [''];
                                @endphp
                                
                                @foreach($keyHighlights as $index => $highlight)
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="key_highlights[]" 
                                               value="{{ $highlight }}" placeholder="e.g., Ancient Kamakhya Temple">
                                        <button type="button" class="btn btn-outline-danger remove-field">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="addKeyHighlight">
                                <i class="fas fa-plus me-1"></i>Add Highlight
                            </button>
                        </div>
                        
                        <div class="col-md-6">
                            <h5 class="mb-4">
                                <i class="fas fa-tags text-primary me-2"></i>Best For Tags
                            </h5>
                            
                            <div id="bestForContainer">
                                @php
                                    $bestForTags = old('best_for_tags', $destination->best_for_tags ?? []);
                                    if(empty($bestForTags)) $bestForTags = [''];
                                @endphp
                                
                                @foreach($bestForTags as $index => $tag)
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="best_for_tags[]" 
                                               value="{{ $tag }}" placeholder="e.g., Pilgrimage">
                                        <button type="button" class="btn btn-outline-danger remove-field">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="addBestFor">
                                <i class="fas fa-plus me-1"></i>Add Tag
                            </button>
                        </div>
                    </div>
                    
                    <!-- Basic Array Fields -->
                    <h5 class="mb-4">
                        <i class="fas fa-list text-primary me-2"></i>Basic Details
                    </h5>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Top Attractions (Simple)</label>
                            <div id="attractionsContainer">
                                @php
                                    $attractions = old('attractions', $destination->attractions ?? []);
                                    if(empty($attractions)) $attractions = [''];
                                @endphp
                                
                                @foreach($attractions as $index => $attraction)
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="attractions[]" 
                                               value="{{ $attraction }}" placeholder="Enter attraction name">
                                        <button type="button" class="btn btn-outline-danger remove-field">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="addAttraction">
                                <i class="fas fa-plus me-1"></i>Add Another
                            </button>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Nearby Areas (Simple)</label>
                            <div id="areasContainer">
                                @php
                                    $areas = old('nearby_areas', $destination->nearby_areas ?? []);
                                    if(empty($areas)) $areas = [''];
                                @endphp
                                
                                @foreach($areas as $index => $area)
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="nearby_areas[]" 
                                               value="{{ $area }}" placeholder="Enter nearby area name">
                                        <button type="button" class="btn btn-outline-danger remove-field">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="addArea">
                                <i class="fas fa-plus me-1"></i>Add Another
                            </button>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Travel Tips (Simple)</label>
                            <div id="tipsContainer">
                                @php
                                    $tips = old('travel_tips', $destination->travel_tips ?? []);
                                    if(empty($tips)) $tips = [''];
                                @endphp
                                
                                @foreach($tips as $index => $tip)
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="travel_tips[]" 
                                               value="{{ $tip }}" placeholder="Enter travel tip">
                                        <button type="button" class="btn btn-outline-danger remove-field">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="addTip">
                                <i class="fas fa-plus me-1"></i>Add Another
                            </button>
                        </div>
                    </div>
                    
                    <!-- =============================================== -->
                    <!-- DETAILED ATTRACTIONS WITH IMAGE UPLOAD -->
                    <!-- =============================================== -->
                    <h5 class="mb-4 mt-5">
                        <i class="fas fa-landmark text-primary me-2"></i>Detailed Attractions
                    </h5>
                    
                    <div id="detailedAttractionsContainer" class="mb-5">
                        @php
                            $attractionsDetails = old('attractions_details', $destination->attractions_details ?? []);
                            if(empty($attractionsDetails)) $attractionsDetails = [
                                [
                                    'name' => '',
                                    'location' => '',
                                    'rating' => '',
                                    'description' => '',
                                    'image' => '',
                                    'button_text' => 'View Details'
                                ]
                            ];
                        @endphp
                        
                        @foreach($attractionsDetails as $index => $attraction)
                        <div class="card mb-3 attraction-item">
                            <div class="card-body">
                                @if(isset($attraction['image']) && $attraction['image'])
                                    <div class="mb-3">
                                        <label class="form-label">Current Image</label>
                                        <div>
                                            <img src="{{ asset('storage/' . $attraction['image']) }}" 
                                                 alt="{{ $attraction['name'] }}" 
                                                 class="img-thumbnail" 
                                                 style="max-height: 100px;">
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Attraction Name</label>
                                        <input type="text" class="form-control" name="attractions_details[{{ $index }}][name]" 
                                               value="{{ $attraction['name'] }}" placeholder="e.g., Brahmaputra River Cruise">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Location</label>
                                        <input type="text" class="form-control" name="attractions_details[{{ $index }}][location]" 
                                               value="{{ $attraction['location'] }}" placeholder="e.g., Brahmaputra River">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Rating</label>
                                        <input type="number" step="0.1" class="form-control" 
                                               name="attractions_details[{{ $index }}][rating]" value="{{ $attraction['rating'] }}" placeholder="4.5" min="0" max="5">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="attractions_details[{{ $index }}][description]" 
                                                  rows="2" placeholder="Short description...">{{ $attraction['description'] }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Attraction Image</label>
                                        <input type="file" class="form-control attraction-image" 
                                               name="attractions_details[{{ $index }}][image]" accept="image/*">
                                        <small class="text-muted">Max: 2MB, Recommended: 600x400px</small>
                                        
                                        <!-- Image Preview -->
                                        <div class="attraction-preview mt-2" style="display: none;">
                                            <img src="" alt="Preview" class="img-thumbnail" style="max-height: 100px;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Button Text</label>
                                        <input type="text" class="form-control" name="attractions_details[{{ $index }}][button_text]" 
                                               value="{{ $attraction['button_text'] ?? 'View Details' }}" placeholder="Button text">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger mt-3 remove-detailed-attraction">
                                    <i class="fas fa-trash me-1"></i>Remove Attraction
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-outline-primary mb-5" id="addDetailedAttraction">
                        <i class="fas fa-plus me-1"></i>Add Detailed Attraction
                    </button>
                    
                    <!-- =============================================== -->
                    <!-- POPULAR PLACES -->
                    <!-- =============================================== -->
                    <h5 class="mb-4">
                        <i class="fas fa-map-pin text-primary me-2"></i>Other Popular Places
                    </h5>
                    
                    <div id="popularPlacesContainer" class="mb-5">
                        @php
                            $popularPlaces = old('popular_places', $destination->popular_places ?? []);
                            if(empty($popularPlaces)) $popularPlaces = [
                                [
                                    'icon' => 'fas fa-monument',
                                    'name' => '',
                                    'description' => ''
                                ]
                            ];
                        @endphp
                        
                        @foreach($popularPlaces as $index => $place)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Icon Class</label>
                                        <input type="text" class="form-control" name="popular_places[{{ $index }}][icon]" 
                                               value="{{ $place['icon'] ?? 'fas fa-monument' }}" placeholder="e.g., fas fa-monument">
                                    </div>
                                    <div class="col-md-9">
                                        <label class="form-label">Place Name</label>
                                        <input type="text" class="form-control" name="popular_places[{{ $index }}][name]" 
                                               value="{{ $place['name'] }}" placeholder="e.g., Navagraha Temple">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="popular_places[{{ $index }}][description]" 
                                                  rows="2" placeholder="e.g., Ancient temple complex">{{ $place['description'] }}</textarea>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger mt-3 remove-popular-place">
                                    <i class="fas fa-trash me-1"></i>Remove Place
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-outline-primary mb-5" id="addPopularPlace">
                        <i class="fas fa-plus me-1"></i>Add Popular Place
                    </button>
                    
                    <!-- =============================================== -->
                    <!-- HOTELS DATA WITH IMAGE UPLOAD -->
                    <!-- =============================================== -->
                    <h5 class="mb-4">
                        <i class="fas fa-hotel text-primary me-2"></i>Hotels & Stays
                    </h5>
                    
                    <div id="hotelsContainer" class="mb-5">
                        @php
                            $hotelsData = old('hotels_data', $destination->hotels_data ?? []);
                            if(empty($hotelsData)) $hotelsData = [
                                [
                                    'name' => '',
                                    'location' => '',
                                    'price' => '',
                                    'rating' => '',
                                    'recommendation' => '',
                                    'features' => '',
                                    'image' => '',
                                    'button_text' => 'View Details'
                                ]
                            ];
                        @endphp
                        
                        @foreach($hotelsData as $index => $hotel)
                        <div class="card mb-3 hotel-item">
                            <div class="card-body">
                                @if(isset($hotel['image']) && $hotel['image'])
                                    <div class="mb-3">
                                        <label class="form-label">Current Image</label>
                                        <div>
                                            <img src="{{ asset('storage/' . $hotel['image']) }}" 
                                                 alt="{{ $hotel['name'] }}" 
                                                 class="img-thumbnail" 
                                                 style="max-height: 100px;">
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Hotel Name</label>
                                        <input type="text" class="form-control" name="hotels_data[{{ $index }}][name]" 
                                               value="{{ $hotel['name'] }}" placeholder="e.g., Radisson Blu Guwahati">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Location</label>
                                        <input type="text" class="form-control" name="hotels_data[{{ $index }}][location]" 
                                               value="{{ $hotel['location'] }}" placeholder="e.g., GS Road, Guwahati">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Price (₹)</label>
                                        <input type="number" class="form-control" name="hotels_data[{{ $index }}][price]" 
                                               value="{{ $hotel['price'] }}" placeholder="6168" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Rating</label>
                                        <input type="number" step="0.1" class="form-control" 
                                               name="hotels_data[{{ $index }}][rating]" value="{{ $hotel['rating'] }}" placeholder="4.5" min="0" max="5">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Recommendation %</label>
                                        <input type="number" class="form-control" name="hotels_data[{{ $index }}][recommendation]" 
                                               value="{{ $hotel['recommendation'] }}" placeholder="94" min="0" max="100">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Features (Comma separated)</label>
                                        <input type="text" class="form-control" 
                                               name="hotels_data[{{ $index }}][features]" 
                                               value="{{ is_array($hotel['features']) ? implode(', ', $hotel['features']) : $hotel['features'] }}"
                                               placeholder="Free WiFi, Pool, Spa, Restaurant">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Hotel Image</label>
                                        <input type="file" class="form-control hotel-image" 
                                               name="hotels_data[{{ $index }}][image]" accept="image/*">
                                        <small class="text-muted">Max: 2MB, Recommended: 800x600px</small>
                                        
                                        <!-- Image Preview -->
                                        <div class="hotel-preview mt-2" style="display: none;">
                                            <img src="" alt="Preview" class="img-thumbnail" style="max-height: 100px;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Button Text</label>
                                        <input type="text" class="form-control" name="hotels_data[{{ $index }}][button_text]" 
                                               value="{{ $hotel['button_text'] ?? 'View Details' }}" placeholder="Button text">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger mt-3 remove-hotel">
                                    <i class="fas fa-trash me-1"></i>Remove Hotel
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-outline-primary mb-5" id="addHotel">
                        <i class="fas fa-plus me-1"></i>Add Hotel
                    </button>
                    
                    <!-- =============================================== -->
                    <!-- NEARBY AREAS DETAILED WITH IMAGE UPLOAD -->
                    <!-- =============================================== -->
                    <h5 class="mb-4">
                        <i class="fas fa-map-marked-alt text-primary me-2"></i>Nearby Areas (Detailed)
                    </h5>
                    
                    <div id="nearbyAreasContainer" class="mb-5">
                        @php
                            $nearbyAreasDetailed = old('nearby_areas_detailed', $destination->nearby_areas_detailed ?? []);
                            if(empty($nearbyAreasDetailed)) $nearbyAreasDetailed = [
                                [
                                    'name' => '',
                                    'distance' => '',
                                    'description' => '',
                                    'image' => '',
                                    'drive_time' => '',
                                    'button_text' => 'Explore'
                                ]
                            ];
                        @endphp
                        
                        @foreach($nearbyAreasDetailed as $index => $area)
                        <div class="card mb-3 area-item">
                            <div class="card-body">
                                @if(isset($area['image']) && $area['image'])
                                    <div class="mb-3">
                                        <label class="form-label">Current Image</label>
                                        <div>
                                            <img src="{{ asset('storage/' . $area['image']) }}" 
                                                 alt="{{ $area['name'] }}" 
                                                 class="img-thumbnail" 
                                                 style="max-height: 100px;">
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Area Name</label>
                                        <input type="text" class="form-control" name="nearby_areas_detailed[{{ $index }}][name]" 
                                               value="{{ $area['name'] }}" placeholder="e.g., Shillong, Meghalaya">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Distance</label>
                                        <input type="text" class="form-control" name="nearby_areas_detailed[{{ $index }}][distance]" 
                                               value="{{ $area['distance'] }}" placeholder="e.g., 12 km from Guwahati">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="nearby_areas_detailed[{{ $index }}][description]" 
                                                  rows="3" placeholder="e.g., Scotland of the East with beautiful hills">{{ $area['description'] }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Area Image</label>
                                        <input type="file" class="form-control area-image" 
                                               name="nearby_areas_detailed[{{ $index }}][image]" accept="image/*">
                                        <small class="text-muted">Max: 2MB, Recommended: 600x400px</small>
                                        
                                        <!-- Image Preview -->
                                        <div class="area-preview mt-2" style="display: none;">
                                            <img src="" alt="Preview" class="img-thumbnail" style="max-height: 100px;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Drive Time</label>
                                        <input type="text" class="form-control" name="nearby_areas_detailed[{{ $index }}][drive_time]" 
                                               value="{{ $area['drive_time'] }}" placeholder="e.g., 3h drive">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Button Text</label>
                                        <input type="text" class="form-control" name="nearby_areas_detailed[{{ $index }}][button_text]" 
                                               value="{{ $area['button_text'] ?? 'Explore' }}" placeholder="Button text">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger mt-3 remove-area">
                                    <i class="fas fa-trash me-1"></i>Remove Area
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-outline-primary mb-5" id="addNearbyArea">
                        <i class="fas fa-plus me-1"></i>Add Nearby Area
                    </button>
                    
                    <!-- =============================================== -->
                    <!-- MORE NEARBY DESTINATIONS -->
                    <!-- =============================================== -->
                    <h5 class="mb-4">
                        <i class="fas fa-location-dot text-primary me-2"></i>More Nearby Destinations
                    </h5>
                    
                    <div id="moreDestinationsContainer" class="mb-5">
                        @php
                            $moreDestinations = old('more_nearby_destinations', $destination->more_nearby_destinations ?? []);
                            if(empty($moreDestinations)) $moreDestinations = [
                                [
                                    'icon' => 'fas fa-mountain',
                                    'name' => '',
                                    'distance' => '',
                                    'category' => ''
                                ]
                            ];
                        @endphp
                        
                        @foreach($moreDestinations as $index => $dest)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Icon Class</label>
                                        <input type="text" class="form-control" name="more_nearby_destinations[{{ $index }}][icon]" 
                                               value="{{ $dest['icon'] ?? 'fas fa-mountain' }}" placeholder="e.g., fas fa-mountain">
                                    </div>
                                    <div class="col-md-9">
                                        <label class="form-label">Destination Name</label>
                                        <input type="text" class="form-control" name="more_nearby_destinations[{{ $index }}][name]" 
                                               value="{{ $dest['name'] }}" placeholder="e.g., Haflong Hills">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Distance</label>
                                        <input type="text" class="form-control" name="more_nearby_destinations[{{ $index }}][distance]" 
                                               value="{{ $dest['distance'] }}" placeholder="e.g., 114 km">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Category</label>
                                        <input type="text" class="form-control" name="more_nearby_destinations[{{ $index }}][category]" 
                                               value="{{ $dest['category'] }}" placeholder="e.g., Hill station">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger mt-3 remove-more-destination">
                                    <i class="fas fa-trash me-1"></i>Remove Destination
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-outline-primary mb-5" id="addMoreDestination">
                        <i class="fas fa-plus me-1"></i>Add More Destination
                    </button>
                    
                    <!-- =============================================== -->
                    <!-- PHOTO GALLERY WITH IMAGE UPLOAD -->
                    <!-- =============================================== -->
                    <h5 class="mb-4">
                        <i class="fas fa-images text-primary me-2"></i>Photo Gallery
                    </h5>
                    
                    <div id="galleryContainer" class="mb-5">
                        @php
                            $galleryImages = collect($destination->gallery_images ?? []);
                            $existingImages = $galleryImages->pluck('url')->toArray();
                            $existingAltTexts = $galleryImages->pluck('alt')->toArray();
                            
                            if(empty($existingImages)) {
                                $existingImages = [''];
                                $existingAltTexts = [''];
                            }
                        @endphp
                        
                        @foreach($existingImages as $index => $image)
                        <div class="row g-3 mb-3 gallery-row">
                            @if($image && Storage::exists(str_replace('storage/', '', $image)))
                                <div class="col-12 mb-2">
                                    <label class="form-label">Current Image</label>
                                    <div>
                                        <img src="{{ asset('storage/' . str_replace('storage/', '', $image)) }}" 
                                             alt="{{ $existingAltTexts[$index] ?? '' }}" 
                                             class="img-thumbnail" 
                                             style="max-height: 100px;">
                                    </div>
                                </div>
                            @endif
                            
                            <div class="col-md-8">
                                <label class="form-label">Gallery Image</label>
                                <input type="file" class="form-control gallery-image" 
                                       name="gallery_images[]" accept="image/*">
                                <small class="text-muted">Max: 2MB, Recommended: 800x600px</small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Alt Text</label>
                                <input type="text" class="form-control" name="gallery_alt_text[]" 
                                       value="{{ $existingAltTexts[$index] ?? '' }}" placeholder="Description of image">
                                
                                <!-- Image Preview -->
                                <div class="gallery-preview mt-2" style="display: none;">
                                    <img src="" alt="Preview" class="img-thumbnail" style="max-height: 80px;">
                                </div>
                                
                                <button type="button" class="btn btn-sm btn-outline-danger mt-2 remove-gallery-image">
                                    <i class="fas fa-trash me-1"></i>Remove
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-outline-primary mb-5" id="addGalleryImage">
                        <i class="fas fa-plus me-1"></i>Add Gallery Image
                    </button>
                    
                    <!-- =============================================== -->
                    <!-- TRAVEL TIPS & FAQ -->
                    <!-- =============================================== -->
                    <h5 class="mb-4">
                        <i class="fas fa-lightbulb text-primary me-2"></i>Travel Tips & FAQ
                    </h5>
                    
                    <div id="travelTipsContainer" class="mb-5">
                        @php
                            $travelTips = old('travel_tips_faq', $destination->travel_tips_faq ?? []);
                            if(empty($travelTips)) $travelTips = [
                                [
                                    'icon' => 'fas fa-suitcase',
                                    'title' => '',
                                    'content' => ''
                                ]
                            ];
                        @endphp
                        
                        @foreach($travelTips as $index => $tip)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Icon Class</label>
                                        <input type="text" class="form-control" name="travel_tips_faq[{{ $index }}][icon]" 
                                               value="{{ $tip['icon'] ?? 'fas fa-suitcase' }}" placeholder="e.g., fas fa-suitcase">
                                    </div>
                                    <div class="col-md-9">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="travel_tips_faq[{{ $index }}][title]" 
                                               value="{{ $tip['title'] }}" placeholder="e.g., Best Time to Visit">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Content</label>
                                        <textarea class="form-control" name="travel_tips_faq[{{ $index }}][content]" 
                                                  rows="4" placeholder="Detailed information...">{{ $tip['content'] }}</textarea>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger mt-3 remove-travel-tip">
                                    <i class="fas fa-trash me-1"></i>Remove Travel Tip
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-outline-primary mb-5" id="addTravelTip">
                        <i class="fas fa-plus me-1"></i>Add Travel Tip
                    </button>
                    
                    <!-- =============================================== -->
                    <!-- QUICK FACTS -->
                    <!-- =============================================== -->
                    <h5 class="mb-4">
                        <i class="fas fa-clipboard-list text-primary me-2"></i>Quick Facts
                    </h5>
                    
                    <div class="row g-3 mb-5">
                        <div class="col-md-6">
                            <label class="form-label">Language</label>
                            <input type="text" class="form-control" name="quick_facts[language]" 
                                   value="{{ old('quick_facts.language', $destination->quick_facts['language'] ?? 'Assamese, Hindi, English') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Time Zone</label>
                            <input type="text" class="form-control" name="quick_facts[time_zone]" 
                                   value="{{ old('quick_facts.time_zone', $destination->quick_facts['time_zone'] ?? 'IST (UTC+5:30)') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Currency</label>
                            <input type="text" class="form-control" name="quick_facts[currency]" 
                                   value="{{ old('quick_facts.currency', $destination->quick_facts['currency'] ?? 'Indian Rupee (₹)') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Emergency Numbers</label>
                            <input type="text" class="form-control" name="quick_facts[emergency]" 
                                   value="{{ old('quick_facts.emergency', $destination->quick_facts['emergency'] ?? '112, 108') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Voltage</label>
                            <input type="text" class="form-control" name="quick_facts[voltage]" 
                                   value="{{ old('quick_facts.voltage', $destination->quick_facts['voltage'] ?? '230V, 50Hz') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Climate</label>
                            <input type="text" class="form-control" name="quick_facts[climate]" 
                                   value="{{ old('quick_facts.climate', $destination->quick_facts['climate'] ?? 'Tropical Monsoon') }}">
                        </div>
                    </div>
                    
                    <!-- Status -->
                    <div class="mb-4">
                        <label class="form-label">Status</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" 
                                       id="statusActive" value="active" 
                                       {{ old('status', $destination->status) == 'active' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusActive">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" 
                                       id="statusInactive" value="inactive"
                                       {{ old('status', $destination->status) == 'inactive' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusInactive">
                                    Inactive
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" 
                                       id="statusDraft" value="draft"
                                       {{ old('status', $destination->status) == 'draft' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusDraft">
                                    Draft
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="d-flex justify-content-between mt-5 pt-4 border-top">
                        <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Destination
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // ✅ SUMMERNOTE EDITOR INITIALIZATION
    $(document).ready(function() {
        // Short Description Editor
        $('#summernote-description').summernote({
            height: 150,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            placeholder: 'Write short description here...'
        });
        
        // Detailed Overview Editor
        $('#summernote-overview').summernote({
            height: 300,
            toolbar: [
                ['style', ['style', 'fontsize', 'color']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                ['para', ['ul', 'ol', 'paragraph', 'height']],
                ['insert', ['link', 'picture', 'video', 'table', 'hr']],
                ['misc', ['undo', 'redo']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            placeholder: 'Write detailed overview here...'
        });
        
        console.log('Summernote editors initialized successfully!');
    });

    // Main Image Preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewDiv = document.getElementById('imagePreview');
                const previewImg = document.getElementById('previewImage');
                
                previewImg.src = e.target.result;
                previewDiv.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Hero Image Preview
    document.getElementById('hero_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewDiv = document.getElementById('heroImagePreview');
                const previewImg = document.getElementById('previewHeroImage');
                
                previewImg.src = e.target.result;
                previewDiv.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
    
    // ================================================================
    // IMAGE PREVIEW FUNCTIONS
    // ================================================================

    // Function to handle image preview for dynamically added items
    function setupImagePreview(inputSelector, previewSelector) {
        document.addEventListener('change', function(e) {
            if (e.target.matches(inputSelector)) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewDiv = e.target.closest('.col-md-6, .col-md-8').querySelector(previewSelector);
                        const previewImg = previewDiv.querySelector('img');
                        
                        previewImg.src = e.target.result;
                        previewDiv.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            }
        });
    }

    // Setup previews for different image types
    setupImagePreview('.attraction-image', '.attraction-preview');
    setupImagePreview('.hotel-image', '.hotel-preview');
    setupImagePreview('.area-image', '.area-preview');
    setupImagePreview('.gallery-image', '.gallery-preview');

    // ================================================================
    // DYNAMIC FORM FIELD FUNCTIONS
    // ================================================================
    
    let attractionCounter = {{ count($destination->attractions_details ?? []) }};
    let popularPlaceCounter = {{ count($destination->popular_places ?? []) }};
    let hotelCounter = {{ count($destination->hotels_data ?? []) }};
    let areaCounter = {{ count($destination->nearby_areas_detailed ?? []) }};
    let destinationCounter = {{ count($destination->more_nearby_destinations ?? []) }};
    let travelTipCounter = {{ count($destination->travel_tips_faq ?? []) }};
    let galleryCounter = {{ count($destination->gallery_images ?? []) }};

    // Key Highlights
    document.getElementById('addKeyHighlight').addEventListener('click', function() {
        const container = document.getElementById('keyHighlightsContainer');
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="text" class="form-control" name="key_highlights[]" 
                   placeholder="e.g., Ancient Kamakhya Temple">
            <button type="button" class="btn btn-outline-danger remove-field">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(div);
        div.querySelector('.remove-field').addEventListener('click', function() {
            div.remove();
        });
    });

    // Best For Tags
    document.getElementById('addBestFor').addEventListener('click', function() {
        const container = document.getElementById('bestForContainer');
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="text" class="form-control" name="best_for_tags[]" 
                   placeholder="e.g., Pilgrimage">
            <button type="button" class="btn btn-outline-danger remove-field">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(div);
        div.querySelector('.remove-field').addEventListener('click', function() {
            div.remove();
        });
    });

    // Basic Attractions
    document.getElementById('addAttraction').addEventListener('click', function() {
        const container = document.getElementById('attractionsContainer');
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="text" class="form-control" name="attractions[]" 
                   placeholder="Enter attraction name">
            <button type="button" class="btn btn-outline-danger remove-field">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(div);
        div.querySelector('.remove-field').addEventListener('click', function() {
            div.remove();
        });
    });

    // Basic Areas
    document.getElementById('addArea').addEventListener('click', function() {
        const container = document.getElementById('areasContainer');
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="text" class="form-control" name="nearby_areas[]" 
                   placeholder="Enter nearby area name">
            <button type="button" class="btn btn-outline-danger remove-field">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(div);
        div.querySelector('.remove-field').addEventListener('click', function() {
            div.remove();
        });
    });

    // Basic Tips
    document.getElementById('addTip').addEventListener('click', function() {
        const container = document.getElementById('tipsContainer');
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="text" class="form-control" name="travel_tips[]" 
                   placeholder="Enter travel tip">
            <button type="button" class="btn btn-outline-danger remove-field">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(div);
        div.querySelector('.remove-field').addEventListener('click', function() {
            div.remove();
        });
    });

    // Detailed Attractions
    document.getElementById('addDetailedAttraction').addEventListener('click', function() {
        const container = document.getElementById('detailedAttractionsContainer');
        const index = attractionCounter++;
        
        const card = document.createElement('div');
        card.className = 'card mb-3 attraction-item';
        card.innerHTML = `
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Attraction Name</label>
                        <input type="text" class="form-control" 
                               name="attractions_details[${index}][name]" 
                               placeholder="e.g., Brahmaputra River Cruise">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Location</label>
                        <input type="text" class="form-control" 
                               name="attractions_details[${index}][location]" 
                               placeholder="e.g., Brahmaputra River">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Rating</label>
                        <input type="number" step="0.1" class="form-control" 
                               name="attractions_details[${index}][rating]" 
                               placeholder="4.5" min="0" max="5">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" 
                                  name="attractions_details[${index}][description]" 
                                  rows="2" placeholder="Short description..."></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Attraction Image</label>
                        <input type="file" class="form-control attraction-image" 
                               name="attractions_details[${index}][image]" accept="image/*">
                        <small class="text-muted">Max: 2MB, Recommended: 600x400px</small>
                        
                        <!-- Image Preview -->
                        <div class="attraction-preview mt-2" style="display: none;">
                            <img src="" alt="Preview" class="img-thumbnail" style="max-height: 100px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Button Text</label>
                        <input type="text" class="form-control" 
                               name="attractions_details[${index}][button_text]" 
                               value="View Details" placeholder="Button text">
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger mt-3 remove-detailed-attraction">
                    <i class="fas fa-trash me-1"></i>Remove Attraction
                </button>
            </div>
        `;
        container.appendChild(card);
        
        // Setup image preview for new attraction
        const attractionInput = card.querySelector('.attraction-image');
        attractionInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewDiv = card.querySelector('.attraction-preview');
                    const previewImg = previewDiv.querySelector('img');
                    
                    previewImg.src = e.target.result;
                    previewDiv.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
        
        card.querySelector('.remove-detailed-attraction').addEventListener('click', function() {
            card.remove();
        });
    });

    // Popular Places
    document.getElementById('addPopularPlace').addEventListener('click', function() {
        const container = document.getElementById('popularPlacesContainer');
        const index = popularPlaceCounter++;
        
        const card = document.createElement('div');
        card.className = 'card mb-3';
        card.innerHTML = `
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Icon Class</label>
                        <input type="text" class="form-control" 
                               name="popular_places[${index}][icon]" 
                               value="fas fa-monument" placeholder="e.g., fas fa-monument">
                    </div>
                    <div class="col-md-9">
                        <label class="form-label">Place Name</label>
                        <input type="text" class="form-control" 
                               name="popular_places[${index}][name]" 
                               placeholder="e.g., Navagraha Temple">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" 
                                  name="popular_places[${index}][description]" 
                                  rows="2" placeholder="e.g., Ancient temple complex"></textarea>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger mt-3 remove-popular-place">
                    <i class="fas fa-trash me-1"></i>Remove Place
                </button>
            </div>
        `;
        container.appendChild(card);
        
        card.querySelector('.remove-popular-place').addEventListener('click', function() {
            card.remove();
        });
    });

    // Hotels
    document.getElementById('addHotel').addEventListener('click', function() {
        const container = document.getElementById('hotelsContainer');
        const index = hotelCounter++;
        
        const card = document.createElement('div');
        card.className = 'card mb-3 hotel-item';
        card.innerHTML = `
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Hotel Name</label>
                        <input type="text" class="form-control" 
                               name="hotels_data[${index}][name]" 
                               placeholder="e.g., Radisson Blu Guwahati">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Location</label>
                        <input type="text" class="form-control" 
                               name="hotels_data[${index}][location]" 
                               placeholder="e.g., GS Road, Guwahati">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Price (₹)</label>
                        <input type="number" class="form-control" 
                               name="hotels_data[${index}][price]" 
                               placeholder="6168" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Rating</label>
                        <input type="number" step="0.1" class="form-control" 
                               name="hotels_data[${index}][rating]" 
                               placeholder="4.5" min="0" max="5">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Recommendation %</label>
                        <input type="number" class="form-control" 
                               name="hotels_data[${index}][recommendation]" 
                               placeholder="94" min="0" max="100">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Features (Comma separated)</label>
                        <input type="text" class="form-control" 
                               name="hotels_data[${index}][features]" 
                               placeholder="Free WiFi, Pool, Spa, Restaurant">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Hotel Image</label>
                        <input type="file" class="form-control hotel-image" 
                               name="hotels_data[${index}][image]" accept="image/*">
                        <small class="text-muted">Max: 2MB, Recommended: 800x600px</small>
                        
                        <!-- Image Preview -->
                        <div class="hotel-preview mt-2" style="display: none;">
                            <img src="" alt="Preview" class="img-thumbnail" style="max-height: 100px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Button Text</label>
                        <input type="text" class="form-control" 
                               name="hotels_data[${index}][button_text]" 
                               value="View Details" placeholder="Button text">
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger mt-3 remove-hotel">
                    <i class="fas fa-trash me-1"></i>Remove Hotel
                </button>
            </div>
        `;
        container.appendChild(card);
        
        // Setup image preview for new hotel
        const hotelInput = card.querySelector('.hotel-image');
        hotelInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewDiv = card.querySelector('.hotel-preview');
                    const previewImg = previewDiv.querySelector('img');
                    
                    previewImg.src = e.target.result;
                    previewDiv.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
        
        card.querySelector('.remove-hotel').addEventListener('click', function() {
            card.remove();
        });
    });

    // Nearby Areas
    document.getElementById('addNearbyArea').addEventListener('click', function() {
        const container = document.getElementById('nearbyAreasContainer');
        const index = areaCounter++;
        
        const card = document.createElement('div');
        card.className = 'card mb-3 area-item';
        card.innerHTML = `
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Area Name</label>
                        <input type="text" class="form-control" 
                               name="nearby_areas_detailed[${index}][name]" 
                               placeholder="e.g., Shillong, Meghalaya">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Distance</label>
                        <input type="text" class="form-control" 
                               name="nearby_areas_detailed[${index}][distance]" 
                               placeholder="e.g., 12 km from Guwahati">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" 
                                  name="nearby_areas_detailed[${index}][description]" 
                                  rows="3" placeholder="e.g., Scotland of the East with beautiful hills"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Area Image</label>
                        <input type="file" class="form-control area-image" 
                               name="nearby_areas_detailed[${index}][image]" accept="image/*">
                        <small class="text-muted">Max: 2MB, Recommended: 600x400px</small>
                        
                        <!-- Image Preview -->
                        <div class="area-preview mt-2" style="display: none;">
                            <img src="" alt="Preview" class="img-thumbnail" style="max-height: 100px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Drive Time</label>
                        <input type="text" class="form-control" 
                               name="nearby_areas_detailed[${index}][drive_time]" 
                               placeholder="e.g., 3h drive">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Button Text</label>
                        <input type="text" class="form-control" 
                               name="nearby_areas_detailed[${index}][button_text]" 
                               value="Explore" placeholder="Button text">
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger mt-3 remove-area">
                    <i class="fas fa-trash me-1"></i>Remove Area
                </button>
            </div>
        `;
        container.appendChild(card);
        
        // Setup image preview for new area
        const areaInput = card.querySelector('.area-image');
        areaInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewDiv = card.querySelector('.area-preview');
                    const previewImg = previewDiv.querySelector('img');
                    
                    previewImg.src = e.target.result;
                    previewDiv.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
        
        card.querySelector('.remove-area').addEventListener('click', function() {
            card.remove();
        });
    });

    // More Nearby Destinations
    document.getElementById('addMoreDestination').addEventListener('click', function() {
        const container = document.getElementById('moreDestinationsContainer');
        const index = destinationCounter++;
        
        const card = document.createElement('div');
        card.className = 'card mb-3';
        card.innerHTML = `
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Icon Class</label>
                        <input type="text" class="form-control" 
                               name="more_nearby_destinations[${index}][icon]" 
                               value="fas fa-mountain" placeholder="e.g., fas fa-mountain">
                    </div>
                    <div class="col-md-9">
                        <label class="form-label">Destination Name</label>
                        <input type="text" class="form-control" 
                               name="more_nearby_destinations[${index}][name]" 
                               placeholder="e.g., Haflong Hills">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Distance</label>
                        <input type="text" class="form-control" 
                               name="more_nearby_destinations[${index}][distance]" 
                               placeholder="e.g., 114 km">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <input type="text" class="form-control" 
                               name="more_nearby_destinations[${index}][category]" 
                               placeholder="e.g., Hill station">
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger mt-3 remove-more-destination">
                    <i class="fas fa-trash me-1"></i>Remove Destination
                </button>
            </div>
        `;
        container.appendChild(card);
        
        card.querySelector('.remove-more-destination').addEventListener('click', function() {
            card.remove();
        });
    });

    // Photo Gallery
    document.getElementById('addGalleryImage').addEventListener('click', function() {
        const container = document.getElementById('galleryContainer');
        const index = galleryCounter++;
        
        const row = document.createElement('div');
        row.className = 'row g-3 mb-3 gallery-row';
        row.innerHTML = `
            <div class="col-md-8">
                <label class="form-label">Gallery Image</label>
                <input type="file" class="form-control gallery-image" 
                       name="gallery_images[]" accept="image/*">
                <small class="text-muted">Max: 2MB, Recommended: 800x600px</small>
            </div>
            <div class="col-md-4">
                <label class="form-label">Alt Text</label>
                <input type="text" class="form-control" 
                       name="gallery_alt_text[]" 
                       placeholder="Description of image">
                
                <!-- Image Preview -->
                <div class="gallery-preview mt-2" style="display: none;">
                    <img src="" alt="Preview" class="img-thumbnail" style="max-height: 80px;">
                </div>
                
                <button type="button" class="btn btn-sm btn-outline-danger mt-2 remove-gallery-image">
                    <i class="fas fa-trash me-1"></i>Remove
                </button>
            </div>
        `;
        container.appendChild(row);
        
        // Setup image preview for new gallery image
        const galleryInput = row.querySelector('.gallery-image');
        galleryInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewDiv = row.querySelector('.gallery-preview');
                    const previewImg = previewDiv.querySelector('img');
                    
                    previewImg.src = e.target.result;
                    previewDiv.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
        
        row.querySelector('.remove-gallery-image').addEventListener('click', function() {
            row.remove();
        });
    });

    // Travel Tips
    document.getElementById('addTravelTip').addEventListener('click', function() {
        const container = document.getElementById('travelTipsContainer');
        const index = travelTipCounter++;
        
        const card = document.createElement('div');
        card.className = 'card mb-3';
        card.innerHTML = `
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Icon Class</label>
                        <input type="text" class="form-control" 
                               name="travel_tips_faq[${index}][icon]" 
                               value="fas fa-suitcase" placeholder="e.g., fas fa-suitcase">
                    </div>
                    <div class="col-md-9">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" 
                               name="travel_tips_faq[${index}][title]" 
                               placeholder="e.g., Best Time to Visit">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Content</label>
                        <textarea class="form-control" 
                                  name="travel_tips_faq[${index}][content]" 
                                  rows="4" placeholder="Detailed information..."></textarea>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger mt-3 remove-travel-tip">
                    <i class="fas fa-trash me-1"></i>Remove Travel Tip
                </button>
            </div>
        `;
        container.appendChild(card);
        
        card.querySelector('.remove-travel-tip').addEventListener('click', function() {
            card.remove();
        });
    });

    // Remove existing fields
    document.querySelectorAll('.remove-field').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.input-group').remove();
        });
    });

    // Remove dynamic sections
    document.querySelectorAll('.remove-detailed-attraction, .remove-popular-place, .remove-hotel, .remove-area, .remove-more-destination, .remove-gallery-image, .remove-travel-tip').forEach(button => {
        button.addEventListener('click', function() {
            const item = this.closest('.card, .gallery-row');
            if (item) {
                item.remove();
            }
        });
    });
</script>
@endsection