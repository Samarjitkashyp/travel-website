@extends('layouts.app')

@section('title', 'Hotels - Find Perfect Accommodations | Travel Explorer')

@section('content')
    <!-- Hotels Hero Section -->
    <section class="hotels-hero-section" style="
        padding-top: 120px;
        padding-bottom: 80px;
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                    url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80') center/cover no-repeat;
        min-height: 40vh;
        display: flex;
        align-items: center;
    ">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center text-white">
                    <h1 class="display-5 fw-bold mb-3 animate__animated animate__fadeInDown">
                        Find Your Perfect Stay
                    </h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                        Discover amazing hotels, resorts, and accommodations across India
                    </p>
                    
                    <!-- Hotels Search Box -->
                    <div class="animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="card border-0 shadow-lg">
                            <div class="card-body p-4">
                                <form id="hotelsSearchForm" action="{{ route('search.results') }}" method="GET">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-text bg-primary text-white border-0">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                </span>
                                                <input type="text" 
                                                       class="form-control border-0" 
                                                       name="location"
                                                       placeholder="Destination, city, or hotel name"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <span class="input-group-text bg-primary text-white border-0">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </span>
                                                <input type="date" 
                                                       class="form-control border-0" 
                                                       name="check_in"
                                                       placeholder="Check-in">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <span class="input-group-text bg-primary text-white border-0">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </span>
                                                <input type="date" 
                                                       class="form-control border-0" 
                                                       name="check_out"
                                                       placeholder="Check-out">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-primary w-100" type="submit">
                                                <i class="fas fa-search me-2"></i>Search
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hotels Filters -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row g-3">
                                <!-- Location Filter -->
                                <div class="col-lg-3 col-md-6">
                                    <label class="form-label fw-bold">Location</label>
                                    <select class="form-select" id="filterLocation">
                                        <option value="">All Locations</option>
                                        <option value="guwahati">Guwahati, Assam</option>
                                        <option value="goa">Goa</option>
                                        <option value="munnar">Munnar, Kerala</option>
                                        <option value="jaipur">Jaipur, Rajasthan</option>
                                        <option value="shimla">Shimla, Himachal</option>
                                        <option value="chennai">Chennai, Tamil Nadu</option>
                                        <option value="alleppey">Alleppey, Kerala</option>
                                        <option value="rishikesh">Rishikesh, Uttarakhand</option>
                                    </select>
                                </div>
                                
                                <!-- Price Range -->
                                <div class="col-lg-3 col-md-6">
                                    <label class="form-label fw-bold">Price Range (per night)</label>
                                    <select class="form-select" id="filterPrice">
                                        <option value="">All Prices</option>
                                        <option value="0-3000">Under ₹3,000</option>
                                        <option value="3000-6000">₹3,000 - ₹6,000</option>
                                        <option value="6000-10000">₹6,000 - ₹10,000</option>
                                        <option value="10000-15000">₹10,000 - ₹15,000</option>
                                        <option value="15000-99999">Above ₹15,000</option>
                                    </select>
                                </div>
                                
                                <!-- Hotel Type -->
                                <div class="col-lg-3 col-md-6">
                                    <label class="form-label fw-bold">Hotel Type</label>
                                    <select class="form-select" id="filterType">
                                        <option value="">All Types</option>
                                        <option value="luxury">Luxury Hotel</option>
                                        <option value="resort">Resort</option>
                                        <option value="heritage">Heritage Hotel</option>
                                        <option value="budget">Budget Hotel</option>
                                        <option value="boutique">Boutique Hotel</option>
                                        <option value="yoga">Yoga Retreat</option>
                                    </select>
                                </div>
                                
                                <!-- Rating -->
                                <div class="col-lg-3 col-md-6">
                                    <label class="form-label fw-bold">Minimum Rating</label>
                                    <select class="form-select" id="filterRating">
                                        <option value="">Any Rating</option>
                                        <option value="4.5">4.5+ Stars</option>
                                        <option value="4.0">4.0+ Stars</option>
                                        <option value="3.5">3.5+ Stars</option>
                                        <option value="3.0">3.0+ Stars</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Apply Filters Button -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div id="activeFilters" class="text-muted small">
                                            Showing all hotels
                                        </div>
                                        <div>
                                            <button class="btn btn-primary" id="applyHotelsFilter">
                                                <i class="fas fa-filter me-2"></i>Apply Filters
                                            </button>
                                            <button class="btn btn-outline-secondary ms-2" id="clearHotelsFilter" style="display: none;">
                                                <i class="fas fa-times me-2"></i>Clear Filters
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hotels Grid -->
            <div class="row" id="hotelsGrid">
                <?php $hotels = getDemoHotels(); ?>
                @foreach($hotels as $hotel)
                    <div class="col-lg-4 col-md-6 mb-4 hotel-item" 
                         data-location="{{ strtolower(explode(',', $hotel['location'])[0]) }}"
                         data-price="{{ $hotel['price'] }}"
                         data-type="{{ strtolower(explode(' ', $hotel['type'])[0]) }}"
                         data-rating="{{ $hotel['rating'] }}">
                        <div class="card hotel-card border-0 shadow-sm h-100">
                            <div class="position-relative overflow-hidden">
                                <img src="{{ $hotel['image'] }}" 
                                     class="card-img-top hotel-image" 
                                     alt="{{ $hotel['name'] }}"
                                     style="height: 220px; object-fit: cover;">
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-primary">
                                        <i class="fas fa-star me-1"></i>{{ $hotel['rating'] }}
                                    </span>
                                </div>
                                <div class="position-absolute bottom-0 start-0 m-3">
                                    <span class="badge bg-success">{{ $hotel['type'] }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title fw-bold mb-0">{{ $hotel['name'] }}</h5>
                                </div>
                                <p class="card-text text-muted mb-2">
                                    <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                    {{ $hotel['location'] }}
                                </p>
                                <p class="card-text small mb-3">
                                    {{ Str::limit($hotel['description'], 80) }}
                                </p>
                                
                                <!-- Features -->
                                <div class="mb-3">
                                    @foreach(array_slice($hotel['features'], 0, 3) as $feature)
                                        <span class="badge bg-light text-dark me-1 mb-1">
                                            <i class="fas fa-check text-success me-1"></i>{{ $feature }}
                                        </span>
                                    @endforeach
                                    @if(count($hotel['features']) > 3)
                                        <span class="badge bg-light text-dark mb-1">
                                            +{{ count($hotel['features']) - 3 }} more
                                        </span>
                                    @endif
                                </div>
                                
                                <!-- Price and Book Button -->
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <div>
                                        <span class="h5 text-primary mb-0">₹{{ number_format($hotel['price']) }}/night</span>
                                        <p class="text-muted small mb-0">Inclusive of taxes</p>
                                    </div>
                                    <a href="{{ url('/hotel/' . $hotel['slug']) }}" class="btn btn-primary">
                                        <i class="fas fa-eye me-1"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-5">
                <button class="btn btn-outline-primary btn-lg" id="loadMoreHotels">
                    <i class="fas fa-plus me-2"></i>Load More Hotels
                </button>
            </div>
        </div>
    </section>

    <!-- Why Book With Us -->
    <section class="section-padding">
        <div class="container">
            <div class="section-title">
                <h2>Why Book Hotels With Travel Explorer?</h2>
                <p>Experience hassle-free hotel bookings with these benefits</p>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-shield-alt fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Secure Booking</h4>
                        <p class="text-muted">
                            Your personal and payment information is protected with bank-level security.
                        </p>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-tags fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Best Price Guarantee</h4>
                        <p class="text-muted">
                            Find a lower price elsewhere? We'll match it and give you an additional discount.
                        </p>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm h-100 text-center p-4">
                        <div class="mb-3">
                            <i class="fas fa-headset fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">24/7 Customer Support</h4>
                        <p class="text-muted">
                            Our support team is available round the clock to assist you with any queries.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Destinations for Hotels -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="section-title">
                <h2>Popular Hotel Destinations</h2>
                <p>Find great accommodations in these popular destinations</p>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm overflow-hidden">
                        <img src="{{ asset('images/hotels/hotels-2.jpg') }}" 
                             class="card-img-top" 
                             alt="Guwahati Hotels"
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="fw-bold mb-2">Hotels in Guwahati</h5>
                            <p class="text-muted mb-3">
                                Luxury and budget hotels near Kamakhya Temple and Brahmaputra river.
                            </p>
                            <a href="{{ route('search.results') }}?location=guwahati" class="btn btn-outline-primary btn-sm">
                                View Hotels <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm overflow-hidden">
                        <img src="{{ asset('images/hotels/hotels-2.jpg') }}" 
                             class="card-img-top" 
                             alt="Goa Hotels"
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="fw-bold mb-2">Hotels in Goa</h5>
                            <p class="text-muted mb-3">
                                Beach resorts, luxury hotels, and budget stays across Goa's beaches.
                            </p>
                            <a href="{{ route('search.results') }}?location=goa" class="btn btn-outline-primary btn-sm">
                                View Hotels <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm overflow-hidden">
                        <img src="{{ asset('images/hotels/hotels-2.jpg') }}" 
                             class="card-img-top" 
                             alt="Munnar Hotels"
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="fw-bold mb-2">Hotels in Munnar</h5>
                            <p class="text-muted mb-3">
                                Hill station resorts and tea plantation stays in beautiful Munnar.
                            </p>
                            <a href="{{ route('search.results') }}?location=munnar" class="btn btn-outline-primary btn-sm">
                                View Hotels <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Subscription -->
    <section class="section-padding bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-3">Get Exclusive Hotel Deals</h2>
                    <p class="mb-0">
                        Subscribe to our newsletter and be the first to know about special offers, 
                        discounts, and new hotel additions.
                    </p>
                </div>
                <div class="col-lg-6">
                    <form id="hotelNewsletterForm">
                        <div class="input-group input-group-lg">
                            <input type="email" 
                                   class="form-control border-0" 
                                   placeholder="Enter your email address"
                                   required>
                            <button class="btn btn-light text-primary" type="submit">
                                <i class="fas fa-paper-plane me-2"></i>Subscribe
                            </button>
                        </div>
                        <div class="form-text text-light mt-2">
                            We respect your privacy. Unsubscribe at any time.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ============================================
        // HOTELS FILTER FUNCTIONALITY
        // ============================================
        const filterLocation = document.getElementById('filterLocation');
        const filterPrice = document.getElementById('filterPrice');
        const filterType = document.getElementById('filterType');
        const filterRating = document.getElementById('filterRating');
        const applyFilterBtn = document.getElementById('applyHotelsFilter');
        const clearFilterBtn = document.getElementById('clearHotelsFilter');
        const activeFilters = document.getElementById('activeFilters');
        const hotelItems = document.querySelectorAll('.hotel-item');
        
        // Apply Filter Functionality
        applyFilterBtn.addEventListener('click', function() {
            const location = filterLocation.value;
            const price = filterPrice.value;
            const type = filterType.value;
            const rating = filterRating.value;
            
            // Show loading state
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Filtering...';
            this.disabled = true;
            
            setTimeout(() => {
                let visibleCount = 0;
                let filterText = [];
                
                // Loop through all hotel items
                hotelItems.forEach(item => {
                    const itemLocation = item.getAttribute('data-location');
                    const itemPrice = parseFloat(item.getAttribute('data-price'));
                    const itemType = item.getAttribute('data-type');
                    const itemRating = parseFloat(item.getAttribute('data-rating'));
                    
                    // Check location filter
                    const locationMatch = !location || 
                        (location === 'guwahati' && itemLocation.includes('guwahati')) ||
                        (location === 'goa' && itemLocation.includes('goa')) ||
                        (location === 'munnar' && itemLocation.includes('munnar')) ||
                        (location === 'jaipur' && itemLocation.includes('jaipur')) ||
                        (location === 'shimla' && itemLocation.includes('shimla')) ||
                        (location === 'chennai' && itemLocation.includes('chennai')) ||
                        (location === 'alleppey' && itemLocation.includes('alleppey')) ||
                        (location === 'rishikesh' && itemLocation.includes('rishikesh'));
                    
                    // Check price filter
                    let priceMatch = true;
                    if (price) {
                        const [min, max] = price.split('-').map(Number);
                        priceMatch = itemPrice >= min && itemPrice <= max;
                    }
                    
                    // Check type filter
                    const typeMatch = !type || itemType.includes(type);
                    
                    // Check rating filter
                    const ratingMatch = !rating || itemRating >= parseFloat(rating);
                    
                    // Apply all filters
                    if (locationMatch && priceMatch && typeMatch && ratingMatch) {
                        item.style.display = 'block';
                        visibleCount++;
                        
                        // Add animation
                        item.classList.add('animate__animated', 'animate__fadeIn');
                        setTimeout(() => {
                            item.classList.remove('animate__animated', 'animate__fadeIn');
                        }, 1000);
                    } else {
                        item.style.display = 'none';
                    }
                });
                
                // Build filter text
                if (location) filterText.push('Location: ' + filterLocation.options[filterLocation.selectedIndex].text);
                if (price) filterText.push('Price: ' + filterPrice.options[filterPrice.selectedIndex].text);
                if (type) filterText.push('Type: ' + filterType.options[filterType.selectedIndex].text);
                if (rating) filterText.push('Rating: ' + filterRating.options[filterRating.selectedIndex].text);
                
                // Update active filters display
                if (filterText.length > 0) {
                    activeFilters.innerHTML = `Showing ${visibleCount} hotels (${filterText.join(', ')})`;
                    activeFilters.className = 'text-primary small fw-bold';
                    clearFilterBtn.style.display = 'block';
                } else {
                    activeFilters.innerHTML = 'Showing all hotels';
                    activeFilters.className = 'text-muted small';
                    clearFilterBtn.style.display = 'none';
                }
                
                // Reset button state
                this.innerHTML = '<i class="fas fa-filter me-2"></i>Apply Filters';
                this.disabled = false;
                
                // Show notification
                if (visibleCount === 0) {
                    showNotification('No hotels found matching your filters. Try different criteria.', 'warning');
                } else {
                    showNotification(`Found ${visibleCount} hotels matching your filters`, 'success');
                }
                
            }, 500);
        });
        
        // Clear Filter Functionality
        clearFilterBtn.addEventListener('click', function() {
            // Reset all filters
            filterLocation.value = '';
            filterPrice.value = '';
            filterType.value = '';
            filterRating.value = '';
            
            // Show all hotels
            hotelItems.forEach(item => {
                item.style.display = 'block';
                item.classList.add('animate__animated', 'animate__fadeIn');
                setTimeout(() => {
                    item.classList.remove('animate__animated', 'animate__fadeIn');
                }, 1000);
            });
            
            // Reset display
            activeFilters.innerHTML = 'Showing all hotels';
            activeFilters.className = 'text-muted small';
            this.style.display = 'none';
            
            // Show notification
            showNotification('All filters cleared. Showing all hotels.', 'info');
        });
        
        // ============================================
        // LOAD MORE HOTELS FUNCTIONALITY
        // ============================================
        document.getElementById('loadMoreHotels')?.addEventListener('click', function() {
            const button = this;
            const hotelsGrid = document.getElementById('hotelsGrid');
            
            // Show loading
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
            button.disabled = true;
            
            // Get current filter state
            const currentLocation = filterLocation.value;
            const currentPrice = filterPrice.value;
            const currentType = filterType.value;
            const currentRating = filterRating.value;
            
            setTimeout(() => {
                // Additional hotels data
                const additionalHotels = [
                    {
                        id: 9,
                        slug: "udaipur-lake-palace",
                        name: "Udaipur Lake Palace",
                        location: "Lake Pichola, Udaipur",
                        rating: 4.8,
                        price: 14500,
                        type: "Lake Palace Hotel",
                        image: "{{ asset('images/hotels/hotels-2.jpg') }}",
                        features: ['Lake View', 'Boat Transfer', 'Royal Dining', 'Cultural Events'],
                        description: "Floating palace hotel in the middle of Lake Pichola with stunning views."
                    },
                    {
                        id: 10,
                        slug: "darjeeling-tea-estate",
                        name: "Darjeeling Tea Estate Stay",
                        location: "Tea Gardens, Darjeeling",
                        rating: 4.4,
                        price: 4200,
                        type: "Tea Estate Hotel",
                        image: "{{ asset('images/hotels/hotels-2.jpg') }}",
                        features: ['Tea Tasting', 'Mountain View', 'Garden', 'Plantation Tour'],
                        description: "Stay in a colonial bungalow amidst Darjeeling's famous tea plantations."
                    },
                    {
                        id: 11,
                        slug: "kolkata-heritage",
                        name: "Kolkata Heritage Hotel",
                        location: "Park Street, Kolkata",
                        rating: 4.3,
                        price: 4800,
                        type: "Heritage Hotel",
                        image: "{{ asset('images/hotels/hotels-2.jpg') }}",
                        features: ['Heritage Building', 'Fine Dining', 'Art Gallery', 'Library'],
                        description: "Restored heritage property showcasing Kolkata's colonial architecture."
                    }
                ];
                
                // Add new hotels
                additionalHotels.forEach(hotel => {
                    // Check if hotel matches current filters
                    const locationMatch = !currentLocation || 
                        (currentLocation === 'goa' && hotel.location.toLowerCase().includes('goa')) ||
                        (currentLocation === 'munnar' && hotel.location.toLowerCase().includes('munnar'));
                    
                    let priceMatch = true;
                    if (currentPrice) {
                        const [min, max] = currentPrice.split('-').map(Number);
                        priceMatch = hotel.price >= min && hotel.price <= max;
                    }
                    
                    const typeMatch = !currentType || hotel.type.toLowerCase().includes(currentType);
                    const ratingMatch = !currentRating || hotel.rating >= parseFloat(currentRating);
                    
                    if (locationMatch && priceMatch && typeMatch && ratingMatch) {
                        const newHotel = `
                            <div class="col-lg-4 col-md-6 mb-4 hotel-item" 
                                 data-location="${hotel.location.split(',')[0].toLowerCase().trim()}"
                                 data-price="${hotel.price}"
                                 data-type="${hotel.type.split(' ')[0].toLowerCase()}"
                                 data-rating="${hotel.rating}">
                                <div class="card hotel-card border-0 shadow-sm h-100">
                                    <div class="position-relative overflow-hidden">
                                        <img src="${hotel.image}" 
                                             class="card-img-top hotel-image" 
                                             alt="${hotel.name}"
                                             style="height: 220px; object-fit: cover;">
                                        <div class="position-absolute top-0 end-0 m-3">
                                            <span class="badge bg-primary">
                                                <i class="fas fa-star me-1"></i>${hotel.rating}
                                            </span>
                                        </div>
                                        <div class="position-absolute bottom-0 start-0 m-3">
                                            <span class="badge bg-success">${hotel.type}</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h5 class="card-title fw-bold mb-0">${hotel.name}</h5>
                                        </div>
                                        <p class="card-text text-muted mb-2">
                                            <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                            ${hotel.location}
                                        </p>
                                        <p class="card-text small mb-3">
                                            ${hotel.description}
                                        </p>
                                        
                                        <!-- Features -->
                                        <div class="mb-3">
                                            ${hotel.features.slice(0, 3).map(feature => `
                                                <span class="badge bg-light text-dark me-1 mb-1">
                                                    <i class="fas fa-check text-success me-1"></i>${feature}
                                                </span>
                                            `).join('')}
                                            ${hotel.features.length > 3 ? `
                                                <span class="badge bg-light text-dark mb-1">
                                                    +${hotel.features.length - 3} more
                                                </span>
                                            ` : ''}
                                        </div>
                                        
                                        <!-- Price and Book Button -->
                                        <div class="d-flex justify-content-between align-items-center mt-auto">
                                            <div>
                                                <span class="h5 text-primary mb-0">₹${hotel.price.toLocaleString()}/night</span>
                                                <p class="text-muted small mb-0">Inclusive of taxes</p>
                                            </div>
                                            <a href="/hotel/${hotel.slug}" class="btn btn-primary">
                                                <i class="fas fa-eye me-1"></i>View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        hotelsGrid.innerHTML += newHotel;
                    }
                });
                
                // Update active filters with new count
                const visibleItems = document.querySelectorAll('.hotel-item[style*="block"], .hotel-item:not([style])');
                if (filterText && filterText.length > 0) {
                    activeFilters.innerHTML = `Showing ${visibleItems.length} hotels (${filterText.join(', ')})`;
                } else {
                    activeFilters.innerHTML = `Showing ${visibleItems.length} hotels`;
                }
                
                // Reset button
                button.innerHTML = '<i class="fas fa-plus me-2"></i>Load More Hotels';
                button.disabled = false;
                
                // Scroll to new hotels
                setTimeout(() => {
                    const newHotels = hotelsGrid.querySelectorAll('.hotel-item:nth-last-child(-n+3)');
                    if (newHotels.length > 0) {
                        newHotels[0].scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }, 100);
                
            }, 1000);
        });
        
        // ============================================
        // HOTELS SEARCH FORM VALIDATION
        // ============================================
        document.getElementById('hotelsSearchForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const locationInput = this.querySelector('input[name="location"]');
            const location = locationInput.value.trim();
            
            if (!location) {
                showNotification('Please enter a destination, city, or hotel name', 'warning');
                locationInput.focus();
                return;
            }
            
            // Show loading
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Searching...';
            submitBtn.disabled = true;
            
            // Submit after delay
            setTimeout(() => {
                this.submit();
            }, 800);
        });
        
        // ============================================
        // NEWSLETTER FORM SUBMISSION
        // ============================================
        document.getElementById('hotelNewsletterForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const emailInput = this.querySelector('input[type="email"]');
            const email = emailInput.value.trim();
            
            if (!email) {
                showNotification('Please enter your email address', 'warning');
                emailInput.focus();
                return;
            }
            
            // Validate email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showNotification('Please enter a valid email address', 'warning');
                return;
            }
            
            // Show loading
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Subscribing...';
            submitBtn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                // Show success message
                showNotification('Thank you for subscribing to our hotel deals newsletter!', 'success');
                
                // Reset form
                this.reset();
                
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 1500);
        });
        
        // ============================================
        // UTILITY FUNCTIONS
        // ============================================
        function showNotification(message, type = 'info') {
            // Remove existing notification
            const existingNotification = document.querySelector('.hotel-notification');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            // Determine icon
            let icon = 'info-circle';
            if (type === 'warning') icon = 'exclamation-triangle';
            if (type === 'success') icon = 'check-circle';
            
            // Create notification
            const notification = document.createElement('div');
            notification.className = `hotel-notification alert alert-${type} alert-dismissible fade show`;
            notification.style.cssText = `
                position: fixed;
                top: 100px;
                right: 20px;
                z-index: 9999;
                max-width: 400px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                border-radius: 10px;
                border: none;
            `;
            
            notification.innerHTML = `
                <div class="d-flex align-items-start">
                    <div class="me-3">
                        <i class="fas fa-${icon} fa-2x mt-1"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="alert-heading mb-2">${type === 'info' ? 'Information' : type.charAt(0).toUpperCase() + type.slice(1)}</h6>
                        <p class="mb-0">${message}</p>
                    </div>
                    <button type="button" class="btn-close ms-3" data-bs-dismiss="alert"></button>
                </div>
            `;
            
            // Add to page
            document.body.appendChild(notification);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 5000);
            
            // Add click to dismiss
            notification.addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-close') || !e.target.closest('.alert')) {
                    this.remove();
                }
            });
        }
    });
</script>
@endsection

@section('styles')
<style>
    /* ============================================
       HOTELS HERO SECTION
    ============================================ */
    .hotels-hero-section {
        position: relative;
    }
    
    .hotels-hero-section h1 {
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }
    
    .hotels-hero-section .card {
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }
    
    .hotels-hero-section .input-group-lg .form-control,
    .hotels-hero-section .input-group-lg .btn {
        height: 60px;
    }
    
    /* ============================================
       FILTER SECTION STYLES
    ============================================ */
    .form-label.fw-bold {
        font-size: 0.9rem;
        margin-bottom: 8px;
    }
    
    .form-select {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .form-select:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
    }
    
    /* ============================================
       HOTELS GRID STYLES
    ============================================ */
    .hotel-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .hotel-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
    }
    
    .hotel-image {
        transition: transform 0.5s ease;
    }
    
    .hotel-card:hover .hotel-image {
        transform: scale(1.05);
    }
    
    /* ============================================
       FEATURES BADGES
    ============================================ */
    .badge.bg-light {
        font-weight: 500;
        padding: 5px 10px;
        border: 1px solid #dee2e6;
    }
    
    /* ============================================
       BUTTON STYLES
    ============================================ */
    #applyHotelsFilter, #clearHotelsFilter {
        border-radius: 8px;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }
    
    #applyHotelsFilter:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
    }
    
    #clearHotelsFilter:hover {
        background-color: #6c757d;
        color: white;
        transform: translateY(-2px);
    }
    
    /* ============================================
       NEWSLETTER SECTION
    ============================================ */
    .bg-primary .form-control:focus {
        border-color: #ffffff;
        box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.25);
    }
    
    /* ============================================
       RESPONSIVE DESIGN
    ============================================ */
    @media (max-width: 768px) {
        .hotels-hero-section {
            padding-top: 100px;
            padding-bottom: 60px;
        }
        
        .hotels-hero-section .row.g-3 {
            flex-direction: column;
        }
        
        .hotels-hero-section .row.g-3 .col-md-4,
        .hotels-hero-section .row.g-3 .col-md-3,
        .hotels-hero-section .row.g-3 .col-md-2 {
            width: 100%;
            margin-bottom: 10px;
        }
        
        .hotel-image {
            height: 180px;
        }
    }
    
    @media (max-width: 576px) {
        .hotels-hero-section .input-group {
            flex-direction: column;
        }
        
        .hotels-hero-section .input-group-text,
        .hotels-hero-section .form-control,
        .hotels-hero-section .btn-primary {
            border-radius: 10px;
            width: 100%;
            margin-bottom: 10px;
        }
        
        .hotels-hero-section .input-group-text {
            border-radius: 10px 10px 0 0;
        }
        
        .hotels-hero-section .btn-primary {
            border-radius: 0 0 10px 10px;
        }
        
        .hotel-card .card-body {
            padding: 15px;
        }
        
        .hotel-card .card-title {
            font-size: 1.1rem;
        }
    }
    
    /* ============================================
       ANIMATIONS
    ============================================ */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate__fadeIn {
        animation-name: fadeIn;
        animation-duration: 0.5s;
    }
</style>
@endsection