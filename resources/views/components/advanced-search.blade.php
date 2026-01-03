{{-- 
    Advanced Filterable Search Form Component
    File: resources/views/components/advanced-search.blade.php
    
    Features:
    1. Multi-level filtering (Destination, Hotels, Packages)
    2. Date range picker
    3. Price range slider
    4. Multiple selection options
    5. Responsive design
    6. AJAX ready
--}}

<div class="advanced-search-form mb-5">
    <div class="card border-0 shadow-lg">
        <div class="card-header bg-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-search-plus me-2"></i>Advanced Search
                </h4>
                <button type="button" class="btn btn-light btn-sm" id="toggleAdvancedSearch">
                    <i class="fas fa-sliders-h me-1"></i> Show/Hide Filters
                </button>
            </div>
        </div>
        
        <div class="card-body p-4" id="advancedSearchBody">
            <!-- ✅ FIXED: Changed action to search.results route -->
            <form id="advancedSearchForm" action="{{ route('search.results') }}" method="GET">
                <!-- Search Type Selection -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-filter me-2"></i>What are you looking for?
                        </h6>
                        <div class="d-flex flex-wrap gap-2" id="searchTypeTabs">
                            {{-- 
                                Search Type Tabs:
                                - Uses Bootstrap button group for search type selection
                                - Each button toggles different filter sections
                                - Active state is managed by JavaScript
                            --}}
                            <input type="radio" class="btn-check" name="search_type" value="destination" id="typeDestination" checked>
                            <label class="btn btn-outline-primary" for="typeDestination">
                                <i class="fas fa-map-marker-alt me-2"></i>Destinations
                            </label>
                            
                            <input type="radio" class="btn-check" name="search_type" value="hotel" id="typeHotel">
                            <label class="btn btn-outline-primary" for="typeHotel">
                                <i class="fas fa-hotel me-2"></i>Hotels
                            </label>
                            
                            <input type="radio" class="btn-check" name="search_type" value="package" id="typePackage">
                            <label class="btn btn-outline-primary" for="typePackage">
                                <i class="fas fa-suitcase-rolling me-2"></i>Packages
                            </label>
                            
                            <input type="radio" class="btn-check" name="search_type" value="attraction" id="typeAttraction">
                            <label class="btn btn-outline-primary" for="typeAttraction">
                                <i class="fas fa-camera me-2"></i>Attractions
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Main Search Row -->
                <div class="row g-3 mb-4">
                    {{-- 
                        Location Search Field:
                        - Primary search input for location/destination
                        - Autocomplete functionality via JavaScript
                        - Font Awesome icon for visual cue
                    --}}
                    <div class="col-md-6 col-lg-4">
                        <label class="form-label">
                            <i class="fas fa-map-marker-alt text-primary me-1"></i>Location / Destination
                        </label>
                        <div class="input-group">
                            <input type="text" 
                                   class="form-control" 
                                   id="searchLocation"
                                   name="location"
                                   placeholder="Enter city, state, or destination"
                                   data-autocomplete-url="{{ route('autocomplete.locations') }}">
                            <span class="input-group-text">
                                <i class="fas fa-crosshairs"></i>
                            </span>
                        </div>
                        <div class="form-text">E.g., Guwahati, Goa, Kerala</div>
                    </div>

                    {{-- 
                        Category Selector:
                        - Dropdown for destination categories
                        - Bootstrap select with search option
                        - Multiple selection enabled
                    --}}
                    <div class="col-md-6 col-lg-3">
                        <label class="form-label">
                            <i class="fas fa-tags text-primary me-1"></i>Category
                        </label>
                        <select class="form-select select2-multiple" 
                                id="searchCategory" 
                                name="categories[]"
                                multiple
                                data-placeholder="Select categories">
                            <option value="hill">Hill Station</option>
                            <option value="beach">Beach</option>
                            <option value="heritage">Heritage</option>
                            <option value="wildlife">Wildlife</option>
                            <option value="religious">Religious</option>
                            <option value="adventure">Adventure</option>
                            <option value="cultural">Cultural</option>
                            <option value="historical">Historical</option>
                        </select>
                    </div>

                    {{-- 
                        Date Range Picker:
                        - For travel dates selection
                        - Uses Bootstrap datepicker
                        - Check-in and check-out dates
                    --}}
                    <div class="col-md-6 col-lg-3">
                        <label class="form-label">
                            <i class="fas fa-calendar-alt text-primary me-1"></i>Travel Dates
                        </label>
                        <div class="input-group">
                            <input type="text" 
                                   class="form-control datepicker" 
                                   id="checkInDate"
                                   name="check_in"
                                   placeholder="Check-in"
                                   readonly>
                            <span class="input-group-text">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <input type="text" 
                                   class="form-control datepicker" 
                                   id="checkOutDate"
                                   name="check_out"
                                   placeholder="Check-out"
                                   readonly>
                        </div>
                    </div>

                    {{-- 
                        Guest Count Selector:
                        - Adults, children, and rooms selection
                        - Increment/decrement buttons
                        - Responsive layout
                    --}}
                    <div class="col-md-6 col-lg-2">
                        <label class="form-label">
                            <i class="fas fa-users text-primary me-1"></i>Guests & Rooms
                        </label>
                        <div class="input-group">
                            <button type="button" class="btn btn-outline-secondary" id="decrementGuests">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="text" 
                                   class="form-control text-center" 
                                   id="guestCount"
                                   name="guests"
                                   value="2"
                                   readonly>
                            <button type="button" class="btn btn-outline-secondary" id="incrementGuests">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="mt-2">
                            <select class="form-select form-select-sm" name="rooms">
                                <option value="1">1 Room</option>
                                <option value="2" selected>2 Rooms</option>
                                <option value="3">3 Rooms</option>
                                <option value="4">4+ Rooms</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Advanced Filters Section -->
                <div class="advanced-filters" id="advancedFilters">
                    <div class="row g-3 mb-4">
                        {{-- 
                            Price Range Filter:
                            - Bootstrap slider for price range
                            - Live price display
                            - Minimum and maximum price inputs
                        --}}
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">
                                <i class="fas fa-rupee-sign text-primary me-1"></i>Price Range
                            </label>
                            <div class="mb-2">
                                <input type="range" 
                                       class="form-range" 
                                       id="priceRange"
                                       min="0" 
                                       max="50000" 
                                       step="500"
                                       value="10000">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <input type="number" 
                                           class="form-control form-control-sm" 
                                           id="minPrice"
                                           name="min_price"
                                           placeholder="Min"
                                           min="0"
                                           max="50000">
                                </div>
                                <div class="col-6">
                                    <input type="number" 
                                           class="form-control form-control-sm" 
                                           id="maxPrice"
                                           name="max_price"
                                           placeholder="Max"
                                           min="0"
                                           max="50000"
                                           value="10000">
                                </div>
                            </div>
                            <div class="form-text">Range: ₹<span id="priceDisplay">0 - 10,000</span></div>
                        </div>

                        {{-- 
                            Rating Filter:
                            - Star rating selection
                            - Visual star icons
                            - Minimum rating requirement
                        --}}
                        <div class="col-md-6 col-lg-3">
                            <label class="form-label">
                                <i class="fas fa-star text-primary me-1"></i>Minimum Rating
                            </label>
                            <div class="rating-stars mb-3">
                                {{-- 
                                    Rating Stars:
                                    - Interactive star rating
                                    - Each star represents a rating level
                                    - Click to select minimum rating
                                --}}
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star rating-star" data-rating="{{ $i }}"></i>
                                @endfor
                                <input type="hidden" name="min_rating" id="minRating" value="3">
                            </div>
                            <div class="form-text">Select minimum star rating</div>
                        </div>

                        {{-- 
                            Distance Filter:
                            - Distance from city center
                            - Slider for distance range
                            - Kilometers measurement
                        --}}
                        <div class="col-md-6 col-lg-3">
                            <label class="form-label">
                                <i class="fas fa-route text-primary me-1"></i>Distance from Center
                            </label>
                            <select class="form-select" name="distance">
                                <option value="">Any Distance</option>
                                <option value="5">Within 5 km</option>
                                <option value="10">Within 10 km</option>
                                <option value="20" selected>Within 20 km</option>
                                <option value="50">Within 50 km</option>
                                <option value="100">Within 100 km</option>
                            </select>
                        </div>

                        {{-- 
                            Sort Options:
                            - Result sorting criteria
                            - Dropdown with various sorting options
                            - Default is relevance
                        --}}
                        <div class="col-md-6 col-lg-2">
                            <label class="form-label">
                                <i class="fas fa-sort-amount-down text-primary me-1"></i>Sort By
                            </label>
                            <select class="form-select" name="sort_by">
                                <option value="relevance">Relevance</option>
                                <option value="price_low">Price: Low to High</option>
                                <option value="price_high">Price: High to Low</option>
                                <option value="rating">Rating</option>
                                <option value="distance">Distance</option>
                                <option value="popularity">Popularity</option>
                            </select>
                        </div>
                    </div>

                    <!-- Amenities and Features -->
                    <div class="row g-3 mb-4">
                        {{-- 
                            Amenities Checkboxes:
                            - Hotel amenities selection
                            - Grid layout with icons
                            - Checkbox group for multiple selection
                        --}}
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="fas fa-concierge-bell text-primary me-1"></i>Amenities
                            </label>
                            <div class="row g-2">
                                @foreach(['wifi', 'pool', 'spa', 'parking', 'restaurant', 'gym', 'breakfast', 'ac'] as $amenity)
                                    <div class="col-6 col-sm-4 col-md-6 col-lg-3">
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   name="amenities[]" 
                                                   value="{{ $amenity }}"
                                                   id="amenity{{ ucfirst($amenity) }}">
                                            <label class="form-check-label" for="amenity{{ ucfirst($amenity) }}">
                                                <i class="fas fa-{{ 
                                                    $amenity == 'wifi' ? 'wifi' : 
                                                    ($amenity == 'pool' ? 'swimming-pool' : 
                                                    ($amenity == 'spa' ? 'spa' : 
                                                    ($amenity == 'parking' ? 'parking' : 
                                                    ($amenity == 'restaurant' ? 'utensils' : 
                                                    ($amenity == 'gym' ? 'dumbbell' : 
                                                    ($amenity == 'breakfast' ? 'coffee' : 'snowflake')))))) 
                                                }} me-1"></i>
                                                {{ ucfirst($amenity) }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- 
                            Destination Features:
                            - Destination-specific features
                            - Checkbox group for activities
                            - Icons for visual representation
                        --}}
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="fas fa-mountain text-primary me-1"></i>Activities & Features
                            </label>
                            <div class="row g-2">
                                @foreach(['hiking', 'shopping', 'nightlife', 'family', 'couple', 'solo', 'photography', 'food'] as $feature)
                                    <div class="col-6 col-sm-4 col-md-6 col-lg-3">
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   name="features[]" 
                                                   value="{{ $feature }}"
                                                   id="feature{{ ucfirst($feature) }}">
                                            <label class="form-check-label" for="feature{{ ucfirst($feature) }}">
                                                <i class="fas fa-{{ 
                                                    $feature == 'hiking' ? 'hiking' : 
                                                    ($feature == 'shopping' ? 'shopping-bag' : 
                                                    ($feature == 'nightlife' ? 'glass-cheers' : 
                                                    ($feature == 'family' ? 'home' : 
                                                    ($feature == 'couple' ? 'heart' : 
                                                    ($feature == 'solo' ? 'user' : 
                                                    ($feature == 'photography' ? 'camera' : 'utensils')))))) 
                                                }} me-1"></i>
                                                {{ ucfirst($feature) }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Additional Filters -->
                    <div class="row g-3">
                        {{-- 
                            Hotel Type Filter:
                            - Type of accommodation
                            - Radio buttons for single selection
                            - Visual icons for each type
                        --}}
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">
                                <i class="fas fa-building text-primary me-1"></i>Hotel Type
                            </label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach(['all', 'hotel', 'resort', 'homestay', 'villa'] as $type)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="hotel_type" 
                                               value="{{ $type }}"
                                               id="type{{ ucfirst($type) }}"
                                               {{ $type == 'all' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="type{{ ucfirst($type) }}">
                                            <i class="fas fa-{{ 
                                                $type == 'all' ? 'building' : 
                                                ($type == 'hotel' ? 'hotel' : 
                                                ($type == 'resort' ? 'umbrella-beach' : 
                                                ($type == 'homestay' ? 'home' : 'house'))) 
                                            }} me-1"></i>
                                            {{ ucfirst($type) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- 
                            Transportation Filter:
                            - Travel preferences
                            - Checkbox group for transport options
                            - Multiple selection allowed
                        --}}
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">
                                <i class="fas fa-car text-primary me-1"></i>Transportation
                            </label>
                            <div class="d-flex flex-wrap gap-3">
                                @foreach(['flight', 'train', 'bus', 'car'] as $transport)
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               name="transportation[]" 
                                               value="{{ $transport }}"
                                               id="transport{{ ucfirst($transport) }}">
                                        <label class="form-check-label" for="transport{{ ucfirst($transport) }}">
                                            <i class="fas fa-{{ $transport }} me-1"></i>
                                            {{ ucfirst($transport) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- 
                            Budget Level:
                            - Quick budget selection
                            - Radio buttons for budget tiers
                            - Color-coded for easy identification
                        --}}
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">
                                <i class="fas fa-wallet text-primary me-1"></i>Budget Level
                            </label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach([
                                    ['value' => 'budget', 'label' => 'Budget', 'color' => 'success'],
                                    ['value' => 'mid', 'label' => 'Mid-range', 'color' => 'primary'],
                                    ['value' => 'luxury', 'label' => 'Luxury', 'color' => 'warning'],
                                    ['value' => 'all', 'label' => 'All', 'color' => 'secondary']
                                ] as $budget)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="budget" 
                                               value="{{ $budget['value'] }}"
                                               id="budget{{ ucfirst($budget['value']) }}"
                                               {{ $budget['value'] == 'all' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="budget{{ ucfirst($budget['value']) }}">
                                            <span class="badge bg-{{ $budget['color'] }}">{{ $budget['label'] }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            {{-- 
                                Reset Button:
                                - Clears all form fields
                                - Resets to default values
                                - Confirmation before reset
                            --}}
                            <button type="button" class="btn btn-outline-secondary" id="resetFilters">
                                <i class="fas fa-redo me-1"></i>Reset All Filters
                            </button>
                            
                            {{-- 
                                Save Search Button:
                                - Saves current search criteria
                                - For registered users only
                                - Creates saved search profiles
                            --}}
                            <button type="button" class="btn btn-outline-primary" id="saveSearch">
                                <i class="fas fa-save me-1"></i>Save Search
                            </button>
                            
                            {{-- 
                                Filter Counter:
                                - Shows number of active filters
                                - Updates dynamically
                                - Click to view active filters
                            --}}
                            <span class="badge bg-info ms-2" id="activeFilterCount">0 filters active</span>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        {{-- 
                            Search Button:
                            - Primary action button
                            - Large and prominent
                            - With loading state
                            - Submits the form
                        --}}
                        <button type="submit" class="btn btn-primary btn-lg px-5" id="searchButton">
                            <i class="fas fa-search me-2"></i>Search Now
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- 
    ===================================================================
    CSS STYLES
    ===================================================================
    Component-specific styles
    - Ensures proper spacing and layout
    - Custom styling for interactive elements
    - Responsive design adjustments
--}}
<style>
    .advanced-search-form {
        /* Main container styling */
        margin-bottom: 2rem;
    }
    
    .advanced-search-form .card {
        /* Card styling */
        border-radius: 15px;
        overflow: hidden;
    }
    
    .advanced-search-form .card-header {
        /* Header styling */
        border-bottom: none;
        border-radius: 15px 15px 0 0 !important;
    }
    
    .advanced-search-form .form-label {
        /* Label styling */
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }
    
    /* Rating Stars Styling */
    .rating-stars {
        font-size: 1.5rem;
        color: #ddd;
        cursor: pointer;
    }
    
    .rating-star {
        transition: color 0.2s ease;
        margin-right: 2px;
    }
    
    .rating-star:hover,
    .rating-star.active {
        color: #ffc107;
    }
    
    /* Price Range Slider Styling */
    .form-range::-webkit-slider-thumb {
        background: #3498db;
    }
    
    .form-range::-moz-range-thumb {
        background: #3498db;
    }
    
    /* Checkbox and Radio Custom Styling */
    .form-check-input:checked {
        background-color: #3498db;
        border-color: #3498db;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .advanced-search-form .btn-lg {
            padding-left: 2rem;
            padding-right: 2rem;
            font-size: 1rem;
        }
        
        .advanced-filters .row > div {
            margin-bottom: 1rem;
        }
    }
    
    /* Animation for showing/hiding filters */
    .advanced-filters {
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    /* Loading state for search button */
    .btn-loading {
        position: relative;
        color: transparent !important;
    }
    
    .btn-loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin: -10px 0 0 -10px;
        border: 2px solid rgba(255,255,255,0.3);
        border-top-color: #fff;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>

{{-- 
    ===================================================================
    JAVASCRIPT FUNCTIONALITY
    ===================================================================
    All interactive functionality for the advanced search form
    - Event handlers
    - Form validation
    - Dynamic updates
    - AJAX integration
--}}
<script>
    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // ============================================================
        // 1. VARIABLE DECLARATIONS
        // ============================================================
        const form = document.getElementById('advancedSearchForm');
        const toggleButton = document.getElementById('toggleAdvancedSearch');
        const advancedFilters = document.getElementById('advancedFilters');
        const priceRange = document.getElementById('priceRange');
        const minPriceInput = document.getElementById('minPrice');
        const maxPriceInput = document.getElementById('maxPrice');
        const priceDisplay = document.getElementById('priceDisplay');
        const ratingStars = document.querySelectorAll('.rating-star');
        const minRatingInput = document.getElementById('minRating');
        const searchTypeTabs = document.querySelectorAll('input[name="search_type"]');
        const resetButton = document.getElementById('resetFilters');
        const saveSearchButton = document.getElementById('saveSearch');
        const searchButton = document.getElementById('searchButton');
        const activeFilterCount = document.getElementById('activeFilterCount');
        const guestCountInput = document.getElementById('guestCount');
        const decrementGuests = document.getElementById('decrementGuests');
        const incrementGuests = document.getElementById('incrementGuests');
        
        // ============================================================
        // 2. INITIALIZATION FUNCTION
        // ============================================================
        function initAdvancedSearch() {
            // Initialize price range display
            updatePriceDisplay();
            
            // Initialize rating stars
            initializeRatingStars();
            
            // Initialize guest counter
            initializeGuestCounter();
            
            // Set up event listeners
            setupEventListeners();
            
            // Count active filters
            updateActiveFilterCount();
            
            // Initialize date pickers if library is available
            initializeDatePickers();
        }
        
        // ============================================================
        // 3. PRICE RANGE FUNCTIONALITY
        // ============================================================
        function updatePriceDisplay() {
            // Update the price range display text
            const minPrice = minPriceInput.value || 0;
            const maxPrice = maxPriceInput.value || priceRange.value;
            priceDisplay.textContent = `${formatCurrency(minPrice)} - ${formatCurrency(maxPrice)}`;
        }
        
        function formatCurrency(amount) {
            // Format number as Indian currency
            return new Intl.NumberFormat('en-IN').format(amount);
        }
        
        // ============================================================
        // 4. RATING STARS FUNCTIONALITY
        // ============================================================
        function initializeRatingStars() {
            const currentRating = parseInt(minRatingInput.value);
            
            // Set active stars based on current rating
            ratingStars.forEach((star, index) => {
                if (index < currentRating) {
                    star.classList.add('active');
                }
                
                // Add click event to each star
                star.addEventListener('click', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));
                    
                    // Update rating input value
                    minRatingInput.value = rating;
                    
                    // Update star display
                    ratingStars.forEach((s, i) => {
                        if (i < rating) {
                            s.classList.add('active');
                        } else {
                            s.classList.remove('active');
                        }
                    });
                    
                    // Update filter count
                    updateActiveFilterCount();
                });
            });
        }
        
        // ============================================================
        // 5. GUEST COUNTER FUNCTIONALITY
        // ============================================================
        function initializeGuestCounter() {
            // Decrement guests button
            decrementGuests.addEventListener('click', function() {
                let currentCount = parseInt(guestCountInput.value);
                if (currentCount > 1) {
                    guestCountInput.value = currentCount - 1;
                    updateActiveFilterCount();
                }
            });
            
            // Increment guests button
            incrementGuests.addEventListener('click', function() {
                let currentCount = parseInt(guestCountInput.value);
                if (currentCount < 20) {
                    guestCountInput.value = currentCount + 1;
                    updateActiveFilterCount();
                }
            });
        }
        
        // ============================================================
        // 6. DATE PICKER INITIALIZATION
        // ============================================================
        function initializeDatePickers() {
            // Check if datepicker library is available
            if (typeof $.fn.datepicker !== 'undefined') {
                $('.datepicker').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                    startDate: new Date()
                });
            } else {
                // Fallback to native date input
                $('.datepicker').attr('type', 'date');
            }
        }
        
        // ============================================================
        // 7. EVENT LISTENER SETUP
        // ============================================================
        function setupEventListeners() {
            // Toggle advanced filters
            toggleButton.addEventListener('click', function() {
                advancedFilters.style.display = 
                    advancedFilters.style.display === 'none' ? 'block' : 'none';
                this.innerHTML = advancedFilters.style.display === 'none' ? 
                    '<i class="fas fa-sliders-h me-1"></i> Show Filters' : 
                    '<i class="fas fa-sliders-h me-1"></i> Hide Filters';
            });
            
            // Price range slider changes
            priceRange.addEventListener('input', function() {
                maxPriceInput.value = this.value;
                updatePriceDisplay();
                updateActiveFilterCount();
            });
            
            // Min price input changes
            minPriceInput.addEventListener('change', function() {
                if (parseInt(this.value) > parseInt(maxPriceInput.value)) {
                    this.value = maxPriceInput.value;
                }
                updatePriceDisplay();
                updateActiveFilterCount();
            });
            
            // Max price input changes
            maxPriceInput.addEventListener('change', function() {
                if (parseInt(this.value) < parseInt(minPriceInput.value)) {
                    this.value = minPriceInput.value;
                }
                priceRange.value = this.value;
                updatePriceDisplay();
                updateActiveFilterCount();
            });
            
            // Search type tab changes
            searchTypeTabs.forEach(tab => {
                tab.addEventListener('change', function() {
                    updateFormBasedOnSearchType(this.value);
                    updateActiveFilterCount();
                });
            });
            
            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                handleFormSubmission();
            });
            
            // Reset filters
            resetButton.addEventListener('click', function() {
                if (confirm('Are you sure you want to reset all filters?')) {
                    resetAllFilters();
                }
            });
            
            // Save search
            saveSearchButton.addEventListener('click', function() {
                saveCurrentSearch();
            });
            
            // Update filter count on any change
            form.addEventListener('change', updateActiveFilterCount);
            form.addEventListener('input', updateActiveFilterCount);
        }
        
        // ============================================================
        // 8. SEARCH TYPE-BASED FORM UPDATES
        // ============================================================
        function updateFormBasedOnSearchType(type) {
            // Show/hide relevant form sections based on search type
            const hotelSpecific = document.querySelectorAll('.hotel-specific');
            const destinationSpecific = document.querySelectorAll('.destination-specific');
            const packageSpecific = document.querySelectorAll('.package-specific');
            
            // Reset all
            hotelSpecific.forEach(el => el.style.display = 'none');
            destinationSpecific.forEach(el => el.style.display = 'none');
            packageSpecific.forEach(el => el.style.display = 'none');
            
            // Show relevant ones
            switch(type) {
                case 'hotel':
                    hotelSpecific.forEach(el => el.style.display = 'block');
                    break;
                case 'destination':
                    destinationSpecific.forEach(el => el.style.display = 'block');
                    break;
                case 'package':
                    packageSpecific.forEach(el => el.style.display = 'block');
                    break;
            }
        }
        
        // ============================================================
        // 9. ACTIVE FILTER COUNTER
        // ============================================================
        function updateActiveFilterCount() {
            let count = 0;
            
            // Count location filter
            if (document.getElementById('searchLocation').value.trim()) count++;
            
            // Count selected categories
            const selectedCategories = Array.from(document.querySelectorAll('#searchCategory option:checked')).length;
            count += selectedCategories;
            
            // Count date filters
            if (document.getElementById('checkInDate').value || document.getElementById('checkOutDate').value) count++;
            
            // Count price filters
            if (document.getElementById('minPrice').value || document.getElementById('maxPrice').value !== "10000") count++;
            
            // Count rating filter (if not default)
            if (document.getElementById('minRating').value !== "3") count++;
            
            // Count amenities
            const selectedAmenities = Array.from(document.querySelectorAll('input[name="amenities[]"]:checked')).length;
            count += selectedAmenities;
            
            // Count features
            const selectedFeatures = Array.from(document.querySelectorAll('input[name="features[]"]:checked')).length;
            count += selectedFeatures;
            
            // Update display
            activeFilterCount.textContent = `${count} filter${count !== 1 ? 's' : ''} active`;
            
            // Update badge color based on count
            if (count === 0) {
                activeFilterCount.className = 'badge bg-secondary';
            } else if (count <= 3) {
                activeFilterCount.className = 'badge bg-success';
            } else if (count <= 6) {
                activeFilterCount.className = 'badge bg-warning';
            } else {
                activeFilterCount.className = 'badge bg-danger';
            }
        }
        
        // ============================================================
        // 10. FORM SUBMISSION HANDLER
        // ============================================================
        function handleFormSubmission() {
            // Show loading state
            searchButton.classList.add('btn-loading');
            searchButton.disabled = true;
            
            // Collect form data
            const formData = new FormData(form);
            const searchParams = new URLSearchParams();
            
            // Convert FormData to URLSearchParams
            for (let [key, value] of formData.entries()) {
                if (Array.isArray(value)) {
                    value.forEach(v => searchParams.append(key, v));
                } else {
                    searchParams.append(key, value);
                }
            }
            
            // Simulate API call (replace with actual AJAX call)
            setTimeout(() => {
                // In production, this would be:
                // fetch(form.action, {
                //     method: form.method,
                //     body: formData
                // })
                // .then(response => response.json())
                // .then(data => {
                //     // Handle response
                // });
                
                // For demo, redirect to search results page
                window.location.href = `/search/results?${searchParams.toString()}`;
                
                // Reset loading state
                searchButton.classList.remove('btn-loading');
                searchButton.disabled = false;
            }, 1000);
        }
        
        // ============================================================
        // 11. RESET ALL FILTERS
        // ============================================================
        function resetAllFilters() {
            // Reset form
            form.reset();
            
            // Reset price range
            priceRange.value = 10000;
            minPriceInput.value = '';
            maxPriceInput.value = 10000;
            
            // Reset rating
            minRatingInput.value = 3;
            ratingStars.forEach((star, index) => {
                if (index < 3) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
            
            // Reset guest count
            guestCountInput.value = 2;
            
            // Update displays
            updatePriceDisplay();
            updateActiveFilterCount();
            
            // Show success message
            showToast('All filters have been reset', 'success');
        }
        
        // ============================================================
        // 12. SAVE SEARCH FUNCTIONALITY
        // ============================================================
        function saveCurrentSearch() {
            // Check if user is logged in (in production)
            // if (!userLoggedIn) {
            //     showToast('Please login to save searches', 'warning');
            //     return;
            // }
            
            // Collect search criteria
            const searchCriteria = {
                location: document.getElementById('searchLocation').value,
                categories: Array.from(document.querySelectorAll('#searchCategory option:checked')).map(o => o.value),
                dates: {
                    checkIn: document.getElementById('checkInDate').value,
                    checkOut: document.getElementById('checkOutDate').value
                },
                guests: guestCountInput.value,
                priceRange: {
                    min: minPriceInput.value,
                    max: maxPriceInput.value
                },
                rating: minRatingInput.value
            };
            
            // Save to localStorage for demo (in production, save to database)
            const savedSearches = JSON.parse(localStorage.getItem('savedSearches') || '[]');
            savedSearches.push({
                id: Date.now(),
                name: `Search for ${searchCriteria.location || 'Any Location'}`,
                criteria: searchCriteria,
                date: new Date().toISOString()
            });
            localStorage.setItem('savedSearches', JSON.stringify(savedSearches));
            
            // Show success message
            showToast('Search saved successfully!', 'success');
        }
        
        // ============================================================
        // 13. UTILITY FUNCTIONS
        // ============================================================
        function showToast(message, type = 'info') {
            // Create toast element
            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-white bg-${type} border-0`;
            toast.setAttribute('role', 'alert');
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;
            
            // Add to page
            document.body.appendChild(toast);
            
            // Initialize and show toast
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
            
            // Remove after hidden
            toast.addEventListener('hidden.bs.toast', function() {
                document.body.removeChild(toast);
            });
        }
        
        // ============================================================
        // 14. AUTOCOMPLETE FUNCTIONALITY
        // ============================================================
        function setupAutocomplete() {
            const locationInput = document.getElementById('searchLocation');
            const autocompleteUrl = locationInput.getAttribute('data-autocomplete-url');
            
            if (!autocompleteUrl) return;
            
            let timeoutId;
            
            locationInput.addEventListener('input', function() {
                clearTimeout(timeoutId);
                
                const query = this.value.trim();
                if (query.length < 2) return;
                
                timeoutId = setTimeout(() => {
                    fetch(`${autocompleteUrl}?q=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            // Create autocomplete dropdown
                            showAutocompleteDropdown(data, locationInput);
                        })
                        .catch(error => console.error('Autocomplete error:', error));
                }, 300);
            });
        }
        
        function showAutocompleteDropdown(suggestions, inputElement) {
            // Remove existing dropdown
            const existingDropdown = document.getElementById('autocompleteDropdown');
            if (existingDropdown) existingDropdown.remove();
            
            if (suggestions.length === 0) return;
            
            // Create dropdown
            const dropdown = document.createElement('div');
            dropdown.id = 'autocompleteDropdown';
            dropdown.className = 'autocomplete-dropdown position-absolute bg-white border rounded shadow-sm';
            dropdown.style.width = inputElement.offsetWidth + 'px';
            dropdown.style.top = (inputElement.offsetTop + inputElement.offsetHeight) + 'px';
            dropdown.style.left = inputElement.offsetLeft + 'px';
            dropdown.style.zIndex = '1000';
            
            // Add suggestions
            suggestions.forEach(suggestion => {
                const item = document.createElement('div');
                item.className = 'autocomplete-item p-2 border-bottom';
                item.innerHTML = `
                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                    ${suggestion.name}
                    <small class="text-muted d-block">${suggestion.type}</small>
                `;
                item.addEventListener('click', function() {
                    inputElement.value = suggestion.name;
                    dropdown.remove();
                });
                dropdown.appendChild(item);
            });
            
            // Add to DOM
            inputElement.parentElement.appendChild(dropdown);
            
            // Remove dropdown on click outside
            document.addEventListener('click', function removeDropdown(e) {
                if (!dropdown.contains(e.target) && e.target !== inputElement) {
                    dropdown.remove();
                    document.removeEventListener('click', removeDropdown);
                }
            });
        }
        
        // ============================================================
        // 15. INITIALIZE COMPONENT
        // ============================================================
        // Call initialization function
        initAdvancedSearch();
        
        // Setup autocomplete
        setupAutocomplete();
    });
</script>