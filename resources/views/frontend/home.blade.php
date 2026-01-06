@extends('layouts.app')

@section('title', 'Travel Explorer - Find Your Perfect Destination')

@section('content')
    <!-- Hero Section with Toggleable Advanced Search -->
    <section class="hero-section" style="
        padding-top: 150px; 
        padding-bottom: 100px; 
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                    url('https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80') center/cover no-repeat;
        min-height: 85vh;
        display: flex;
        align-items: center;
    ">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center text-white">
                    <h1 class="display-4 fw-bold mb-4 animate__animated animate__fadeInDown">
                        Discover Amazing Travel Destinations
                    </h1>
                    <p class="lead mb-5 animate__animated animate__fadeInUp animate__delay-1s">
                        Explore the world's most beautiful places, find perfect accommodations, and create unforgettable memories with our travel platform.
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3 animate__animated animate__fadeInUp animate__delay-2s">
                        <a href="#destinations" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-map-marked-alt me-2"></i>Explore Destinations
                        </a>
                        <a href="#hotels" class="btn btn-outline-light btn-lg px-5">
                            <i class="fas fa-hotel me-2"></i>Find Hotels
                        </a>
                    </div>
                    
                    <!-- Simple Search Box -->
                    <div class="mt-5 animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="card border-0 shadow-lg">
                            <div class="card-body p-4">
                                <form id="heroQuickSearch" action="{{ route('search.results') }}" method="GET">
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-primary text-white border-0">
                                            <i class="fas fa-search"></i>
                                        </span>
                                        <input type="text" 
                                               class="form-control border-0" 
                                               name="q"
                                               placeholder="Search destinations, hotels, attractions..."
                                               required>
                                        <button class="btn btn-primary border-0" type="submit">
                                            Search
                                        </button>
                                    </div>
                                    
                                    <!-- Toggle Advanced Search Button -->
                                    <div class="text-center mt-3">
                                        <button type="button" 
                                                class="btn btn-link text-decoration-none" 
                                                id="toggleAdvancedComponentBtn">
                                            <i class="fas fa-sliders-h me-2"></i>
                                            <span>Show Advanced Search Filters</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Advanced Search Container (Initially Hidden) -->
    <div class="container-fluid bg-light py-5" id="advancedSearchContainer" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Include Advanced Search Component -->
                    @include('components.advanced-search')
                    
                    <!-- Close Button -->
                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-outline-secondary" id="closeAdvancedSearchBtn">
                            <i class="fas fa-times me-2"></i>Close Advanced Filters
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Destinations -->
    <section id="destinations" class="section-padding bg-light">
        <div class="container">
            <div class="section-title">
                <h2>Featured Destinations</h2>
                <p>Discover our handpicked collection of amazing travel destinations</p>
            </div>

            <!-- Search Filters -->
            <div class="row mb-5">
                <div class="col-md-8 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <select class="form-select" id="stateFilter">
                                        <option value="">All States</option>
                                        <option value="assam">Assam</option>
                                        <option value="goa">Goa</option>
                                        <option value="kerala">Kerala</option>
                                        <option value="rajasthan">Rajasthan</option>
                                        <option value="himachal">Himachal Pradesh</option>
                                        <option value="uttarakhand">Uttarakhand</option>
                                        <option value="tamilnadu">Tamil Nadu</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" id="categoryFilter">
                                        <option value="">All Categories</option>
                                        <option value="hill">Hill Station</option>
                                        <option value="beach">Beach</option>
                                        <option value="heritage">Heritage</option>
                                        <option value="wildlife">Wildlife</option>
                                        <option value="adventure">Adventure</option>
                                        <option value="religious">Religious</option>
                                        <option value="historical">Historical</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary w-100" id="applyFilterBtn">
                                        <i class="fas fa-filter me-2"></i>Apply Filter
                                    </button>
                                    <button class="btn btn-outline-secondary w-100 mt-2" id="clearFilterBtn" style="display: none;">
                                        <i class="fas fa-times me-2"></i>Clear Filter
                                    </button>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div id="filterStatus" class="text-center text-muted small">
                                    @if(isset($destinations) && count($destinations) > 0)
                                        Showing {{ count($destinations) }} destinations
                                    @else
                                        Showing demo destinations
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Destinations Grid with Dynamic Data -->
            <div class="row" id="destinationsGrid">
                @php
                    $destinations = $destinations ?? [];
                @endphp
                
                @if(count($destinations) > 0)
                    <!-- Real destinations from database -->
                    @foreach($destinations as $destination)
                        <div class="col-lg-4 col-md-6 mb-4 destination-item" 
                            data-state="{{ strtolower($destination->state) }}" 
                            data-category="{{ strtolower($destination->category) }}"
                            data-price="{{ $destination->price }}">
                            <div class="destination-card animate__animated animate__fadeInUp">
                                <div class="position-relative overflow-hidden">
                                    <!-- Destination Image -->
                                    @if($destination->image)
                                        <img src="{{ asset('storage/' . $destination->image) }}" 
                                            class="card-img-top" 
                                            alt="{{ $destination->name }}"
                                            style="height: 200px; object-fit: cover;"
                                            onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1552733407-5d5c46c3bb3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80';">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1552733407-5d5c46c3bb3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                                            class="card-img-top" 
                                            alt="{{ $destination->name }}"
                                            style="height: 200px; object-fit: cover;">
                                    @endif
                                    
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-primary">
                                            <i class="fas fa-star me-1"></i>{{ $destination->rating ?? '4.5' }}
                                        </span>
                                    </div>
                                    <div class="position-absolute bottom-0 start-0 m-3">
                                        @php
                                            $badgeClass = 'bg-primary';
                                            if($destination->category == 'Hill Station') $badgeClass = 'bg-warning text-dark';
                                            elseif($destination->category == 'Beach') $badgeClass = 'bg-info';
                                            elseif($destination->category == 'Heritage') $badgeClass = 'bg-success';
                                            elseif($destination->category == 'Wildlife') $badgeClass = 'bg-dark';
                                            elseif($destination->category == 'Adventure') $badgeClass = 'bg-danger';
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $destination->category }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title fw-bold">{{ $destination->name }}</h5>
                                        <span class="text-primary fw-bold">₹{{ number_format($destination->price) }}</span>
                                    </div>
                                    <p class="card-text text-muted mb-2">
                                        <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                        {{ $destination->location }}, {{ $destination->state }}
                                    </p>
                                    <p class="card-text mb-4">
                                        {{ Str::limit(strip_tags($destination->description), 100) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('destination.show', $destination->slug) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye me-1"></i>View Details
                                        </a>
                                        <div>
                                            <small class="text-muted">
                                                <i class="fas fa-hotel me-1"></i>
                                                {{ $destination->hotels_count ?? 0 }} Hotels
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Demo destinations (fallback) -->
                    <!-- Destination 1: Guwahati (Assam, Heritage) -->
                    <div class="col-lg-4 col-md-6 mb-4 destination-item" 
                        data-state="assam" 
                        data-category="heritage"
                        data-price="8500">
                        <div class="destination-card animate__animated animate__fadeInUp">
                            <div class="position-relative overflow-hidden">
                                <img src="{{ asset('images/destinations/guwahati.jpg') }}" 
                                    class="card-img-top" 
                                    alt="Guwahati, Assam"
                                    onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1552733407-5d5c46c3bb3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80';"
                                    style="height: 200px; object-fit: cover;">
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-primary">
                                        <i class="fas fa-star me-1"></i>4.7
                                    </span>
                                </div>
                                <div class="position-absolute bottom-0 start-0 m-3">
                                    <span class="badge bg-success">Heritage</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title fw-bold">Guwahati, Assam</h5>
                                    <span class="text-primary fw-bold">₹8,500</span>
                                </div>
                                <p class="card-text text-muted mb-2">
                                    <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                    Assam, North-East India
                                </p>
                                <p class="card-text mb-4">
                                    Gateway to North-East with Kamakhya Temple, Brahmaputra river, and rich cultural heritage.
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ url('/destination/guwahati') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i>View Details
                                    </a>
                                    <div>
                                        <small class="text-muted">
                                            <i class="fas fa-hotel me-1"></i>
                                            42 Hotels
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Destination 2: Goa (Goa, Beach) -->
                    <div class="col-lg-4 col-md-6 mb-4 destination-item" 
                        data-state="goa" 
                        data-category="beach"
                        data-price="12000">
                        <div class="destination-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                            <div class="position-relative overflow-hidden">
                                <img src="{{ asset('images/destinations/goa-destinations.avif') }}" 
                                    class="card-img-top" 
                                    alt="Goa Beach"
                                    onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80';"
                                    style="height: 200px; object-fit: cover;">
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-primary">
                                        <i class="fas fa-star me-1"></i>4.8
                                    </span>
                                </div>
                                <div class="position-absolute bottom-0 start-0 m-3">
                                    <span class="badge bg-info">Beach</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title fw-bold">Goa Beaches</h5>
                                    <span class="text-primary fw-bold">₹12,000</span>
                                </div>
                                <p class="card-text text-muted mb-2">
                                    <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                    Goa, West India
                                </p>
                                <p class="card-text mb-4">
                                    Famous for pristine beaches, Portuguese architecture, vibrant nightlife and seafood.
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ url('/destination/goa') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i>View Details
                                    </a>
                                    <div>
                                        <small class="text-muted">
                                            <i class="fas fa-hotel me-1"></i>
                                            68 Hotels
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Destination 3: Munnar (Kerala, Hill Station) -->
                    <div class="col-lg-4 col-md-6 mb-4 destination-item" 
                        data-state="kerala" 
                        data-category="hill"
                        data-price="9500">
                        <div class="destination-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                            <div class="position-relative overflow-hidden">
                                <img src="{{ asset('images/destinations/Munnar_hillstation_kerala.jpg') }}" 
                                    class="card-img-top" 
                                    alt="Munnar"
                                    onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1519681393784-d120267933ba?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80';"
                                    style="height: 200px; object-fit: cover;">
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-primary">
                                        <i class="fas fa-star me-1"></i>4.6
                                    </span>
                                </div>
                                <div class="position-absolute bottom-0 start-0 m-3">
                                    <span class="badge bg-warning text-dark">Hill Station</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title fw-bold">Munnar, Kerala</h5>
                                    <span class="text-primary fw-bold">₹9,500</span>
                                </div>
                                <p class="card-text text-muted mb-2">
                                    <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                    Kerala, South India
                                </p>
                                <p class="card-text mb-4">
                                    Beautiful hill station with tea plantations, waterfalls, and pleasant climate.
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ url('/destination/munnar') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye me-1"></i>View Details
                                    </a>
                                    <div>
                                        <small class="text-muted">
                                            <i class="fas fa-hotel me-1"></i>
                                            35 Hotels
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- View More Button -->
            <div class="text-center mt-5">
                <button class="btn btn-outline-primary btn-lg" id="loadMoreDestinations">
                    <i class="fas fa-plus me-2"></i>Load More Destinations
                </button>
            </div>
        </div>
    </section>

    <!-- ============================================
        FEATURED HOTELS SECTION - UPDATED & WORKING
    ============================================ -->
    <section id="hotels" class="section-padding">
        <div class="container">
            <div class="section-title">
                <h2>Featured Hotels</h2>
                <p>Find the perfect accommodation for your stay</p>
            </div>

            <!-- Hotels Carousel (Owl Carousel) - Now with 5 hotels, 3 visible at a time -->
            <div class="owl-carousel owl-theme hotels-carousel">
                <!-- Hotel 1: Taj Hotel, Guwahati -->
                <div class="item">
                    <div class="card hotel-card border-0 shadow-sm">
                        <img src="{{ asset('images/hotels/hotels-2.jpg') }}" 
                             class="card-img-top hotel-image" 
                             alt="Taj Hotel, Guwahati"
                             onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80';">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-bold">Taj Hotel, Guwahati</h5>
                                <span class="text-success fw-bold">
                                    <i class="fas fa-star text-warning"></i> 4.8
                                </span>
                            </div>
                            <p class="card-text text-muted mb-2">
                                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                Near Kamakhya Temple, Guwahati
                            </p>
                            <p class="card-text small text-muted mb-3">
                                <i class="fas fa-building me-1"></i>5-star Luxury Hotel
                            </p>
                            <div class="mb-3">
                                <span class="badge bg-light text-dark me-1 mb-1">Free WiFi</span>
                                <span class="badge bg-light text-dark me-1 mb-1">Swimming Pool</span>
                                <span class="badge bg-light text-dark me-1 mb-1">Spa</span>
                                <span class="badge bg-light text-dark me-1 mb-1">Restaurant</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h5 text-primary mb-0">₹5,200/night</span>
                                    <p class="text-muted small mb-0">Inclusive of taxes</p>
                                </div>
                                <a href="{{ url('/hotel/taj-guwahati') }}" class="btn btn-primary btn-sm book-hotel-btn">
                                    <i class="fas fa-bookmark me-1"></i>Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hotel 2: Goa Marriott Resort -->
                <div class="item">
                    <div class="card hotel-card border-0 shadow-sm">
                        <img src="{{ asset('images/hotels/hotels-2.jpg') }}" 
                             class="card-img-top hotel-image" 
                             alt="Goa Marriott Resort"
                             onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1551882547-ff3700d75d25?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80';">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-bold">Goa Marriott Resort</h5>
                                <span class="text-success fw-bold">
                                    <i class="fas fa-star text-warning"></i> 4.6
                                </span>
                            </div>
                            <p class="card-text text-muted mb-2">
                                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                Miramar Beach, Goa
                            </p>
                            <p class="card-text small text-muted mb-3">
                                <i class="fas fa-building me-1"></i>Beach Resort
                            </p>
                            <div class="mb-3">
                                <span class="badge bg-light text-dark me-1 mb-1">Beach View</span>
                                <span class="badge bg-light text-dark me-1 mb-1">All Inclusive</span>
                                <span class="badge bg-light text-dark me-1 mb-1">Kids Club</span>
                                <span class="badge bg-light text-dark me-1 mb-1">Water Sports</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h5 text-primary mb-0">₹7,800/night</span>
                                    <p class="text-muted small mb-0">Breakfast included</p>
                                </div>
                                <a href="{{ url('/hotel/goa-marriott') }}" class="btn btn-primary btn-sm book-hotel-btn">
                                    <i class="fas fa-bookmark me-1"></i>Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hotel 3: Tea Country Resort, Munnar -->
                <div class="item">
                    <div class="card hotel-card border-0 shadow-sm">
                        <img src="{{ asset('images/hotels/hotels-2.jpg') }}" 
                             class="card-img-top hotel-image" 
                             alt="Tea Country Resort, Munnar"
                             onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1571896349842-3c7ad8e27b86?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80';">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-bold">Tea Country Resort</h5>
                                <span class="text-success fw-bold">
                                    <i class="fas fa-star text-warning"></i> 4.5
                                </span>
                            </div>
                            <p class="card-text text-muted mb-2">
                                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                Tea Gardens, Munnar
                            </p>
                            <p class="card-text small text-muted mb-3">
                                <i class="fas fa-building me-1"></i>Hill Station Resort
                            </p>
                            <div class="mb-3">
                                <span class="badge bg-light text-dark me-1 mb-1">Mountain View</span>
                                <span class="badge bg-light text-dark me-1 mb-1">Tea Plantation</span>
                                <span class="badge bg-light text-dark me-1 mb-1">Bonfire</span>
                                <span class="badge bg-light text-dark me-1 mb-1">Trekking</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h5 text-primary mb-0">₹4,500/night</span>
                                    <p class="text-muted small mb-0">Free cancellation</p>
                                </div>
                                <a href="{{ url('/hotel/tea-country-munnar') }}" class="btn btn-primary btn-sm book-hotel-btn">
                                    <i class="fas fa-bookmark me-1"></i>Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hotel 4: Rambagh Palace, Jaipur -->
                <div class="item">
                    <div class="card hotel-card border-0 shadow-sm">
                        <img src="{{ asset('images/hotels/hotels-2.jpg') }}" 
                             class="card-img-top hotel-image" 
                             alt="Rambagh Palace, Jaipur"
                             onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80';">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-bold">Rambagh Palace</h5>
                                <span class="text-success fw-bold">
                                    <i class="fas fa-star text-warning"></i> 4.9
                                </span>
                            </div>
                            <p class="card-text text-muted mb-2">
                                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                Palace Road, Jaipur
                            </p>
                            <p class="card-text small text-muted mb-3">
                                <i class="fas fa-building me-1"></i>Heritage Palace Hotel
                            </p>
                            <div class="mb-3">
                                <span class="badge bg-light text-dark me-1 mb-1">Royal Suites</span>
                                <span class="badge bg-light text-dark me-1 mb-1">Fine Dining</span>
                                <span class="badge bg-light text-dark me-1 mb-1">Spa & Wellness</span>
                                <span class="badge bg-light text-dark me-1 mb-1">Butler Service</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h5 text-primary mb-0">₹12,500/night</span>
                                    <p class="text-muted small mb-0">Luxury experience</p>
                                </div>
                                <a href="{{ url('/hotel/rambagh-palace') }}" class="btn btn-primary btn-sm book-hotel-btn">
                                    <i class="fas fa-bookmark me-1"></i>Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hotel 5: Shimla Winter Retreat -->
                <div class="item">
                    <div class="card hotel-card border-0 shadow-sm">
                        <img src="{{ asset('images/hotels/hotels-2.jpg') }}" 
                             class="card-img-top hotel-image" 
                             alt="Shimla Winter Retreat"
                             onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1551632436-cbf8dd35ad39?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80';">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-bold">Shimla Winter Retreat</h5>
                                <span class="text-success fw-bold">
                                    <i class="fas fa-star text-warning"></i> 4.3
                                </span>
                            </div>
                            <p class="card-text text-muted mb-2">
                                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                The Mall Road, Shimla
                            </p>
                            <p class="card-text small text-muted mb-3">
                                <i class="fas fa-building me-1"></i>Colonial Style Hotel
                            </p>
                            <div class="mb-3">
                                <span class="badge bg-light text-dark me-1 mb-1">Fireplace</span>
                                <span class="badge bg-light text-dark me-1 mb-1">Snow View</span>
                                <span class="badge bg-light text-dark me-1 mb-1">Library</span>
                                <span class="badge bg-light text-dark me-1 mb-1">Garden</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h5 text-primary mb-0">₹3,800/night</span>
                                    <p class="text-muted small mb-0">Winter special</p>
                                </div>
                                <a href="{{ url('/hotel/shimla-winter-retreat') }}" class="btn btn-primary btn-sm book-hotel-btn">
                                    <i class="fas fa-bookmark me-1"></i>Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View All Hotels Button -->
            <div class="text-center mt-5">
                <a href="{{ url('/hotels') }}" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-hotel me-2"></i>View All Hotels
                </a>
            </div>
        </div>
    </section>

    <!-- Travel Packages -->
    <section id="packages" class="section-padding bg-light">
        <div class="container">
            <div class="section-title">
                <h2>Travel Packages</h2>
                <p>All-inclusive packages for worry-free travel</p>
            </div>

            <!-- Packages Swiper -->
            <div class="swiper packages-swiper">
                <div class="swiper-wrapper">
                    @for($i = 1; $i <= 5; $i++)
                        <div class="swiper-slide">
                            <div class="card package-card border-0 shadow-lg h-100">
                                <div class="position-relative">
                                    <img src="https://images.unsplash.com/photo-{{ ['1552733407-5d5c46c3bb3b', '1520250497591-112f2f40a3f4', '1519681393784-d120267933ba', '1516483638261-f4dbaf036963', '1539635278303-d4002c07eae3'][$i-1] }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                                         class="card-img-top" 
                                         alt="Package {{ $i }}">
                                    <div class="position-absolute top-0 start-0 m-3">
                                        <span class="badge bg-danger">-{{ rand(10, 30) }}%</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Package {{ $i }} - {{ rand(3, 7) }} Days</h5>
                                    <p class="card-text text-muted mb-3">
                                        <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                        Multiple Destinations
                                    </p>
                                    <ul class="list-unstyled mb-4">
                                        @for($j = 0; $j < 4; $j++)
                                            <li class="mb-2">
                                                <i class="fas fa-check text-success me-2"></i>
                                                {{ ['Hotel Accommodation', 'Breakfast Included', 'Sightseeing Tour', 'Transportation'][$j] }}
                                            </li>
                                        @endfor
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="text-decoration-line-through text-muted me-2">
                                                ₹{{ rand(20000, 40000) }}
                                            </span>
                                            <span class="h4 text-primary mb-0">
                                                ₹{{ rand(15000, 35000) }}
                                            </span>
                                        </div>
                                        <button class="btn btn-primary">
                                            <i class="fas fa-shopping-cart me-1"></i>Book Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
                <!-- Add Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="section-padding">
        <div class="container">
            <div class="section-title">
                <h2>Traveler Testimonials</h2>
                <p>What our happy travelers say about us</p>
            </div>

            <!-- Slick Slider for Testimonials -->
            <div class="slick-slider testimonials-slider">
                @for($i = 1; $i <= 4; $i++)
                    <div class="testimonial-item p-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <img src="https://randomuser.me/api/portraits/{{ ['men', 'women'][$i % 2] }}/{{ $i + 20 }}.jpg" 
                                         class="rounded-circle mb-3" 
                                         alt="User {{ $i }}"
                                         width="80" 
                                         height="80">
                                    <h5 class="card-title mb-1">Traveler {{ $i }}</h5>
                                    <div class="text-warning mb-3">
                                        @for($j = 0; $j < 5; $j++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p class="card-text text-muted">
                                    "{{ 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.' }}"
                                </p>
                                <p class="text-end text-muted mt-3 mb-0">
                                    <small>
                                        Visited: {{ ['Guwahati', 'Goa', 'Kerala', 'Rajasthan'][$i-1] }}
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section-padding bg-dark text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="fw-bold mb-4">Why Choose Travel Explorer?</h2>
                    <p class="lead mb-4">
                        We're committed to providing you with the best travel experience, from finding the perfect destination to booking your dream accommodation.
                    </p>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-shield-alt fa-2x text-primary"></i>
                                </div>
                                <div>
                                    <h5>Safe & Secure</h5>
                                    <p class="text-light">Secure bookings and verified partners</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-headset fa-2x text-primary"></i>
                                </div>
                                <div>
                                    <h5>24/7 Support</h5>
                                    <p class="text-light">Round-the-clock customer assistance</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-tags fa-2x text-primary"></i>
                                </div>
                                <div>
                                    <h5>Best Prices</h5>
                                    <p class="text-light">Guaranteed lowest prices</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-map-marked-alt fa-2x text-primary"></i>
                                </div>
                                <div>
                                    <h5>Wide Coverage</h5>
                                    <p class="text-light">Destinations across India</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                             class="img-fluid rounded shadow-lg" 
                             alt="About Us">
                        <div class="position-absolute bottom-0 start-0 bg-primary text-white p-4 m-3 rounded shadow">
                            <h4 class="mb-0">5000+</h4>
                            <p class="mb-0">Happy Travelers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section-padding">
        <div class="container">
            <div class="section-title">
                <h2>Contact Us</h2>
                <p>Get in touch with us for any queries or assistance</p>
            </div>
            
            <div class="row">
                <!-- Left Side: Google Map -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-body p-4">
                            <h4 class="mb-4">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>Our Location
                            </h4>
                            <!-- Google Map Embed -->
                            <div class="map-container rounded overflow-hidden mb-4">
                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3660.041692425675!2d91.74577417529312!3d26.14449627793077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x375a5946b1e8d5c7%3A0x73c4f13fcb46c6a8!2sGuwahati%2C%20Assam!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin" 
                                    width="100%" 
                                    height="400" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade"
                                    class="rounded">
                                </iframe>
                            </div>
                            
                            <!-- Contact Information -->
                            <div class="contact-info">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="me-3">
                                        <i class="fas fa-map-marker-alt text-primary fa-lg"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Our Office Address</h6>
                                        <p class="text-muted mb-0">123 Travel Street, Tourism City, Guwahati, Assam 781001</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-start mb-3">
                                    <div class="me-3">
                                        <i class="fas fa-phone-alt text-primary fa-lg"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Call Us</h6>
                                        <p class="text-muted mb-0">+91 98765 43210<br>+91 98765 43211</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-start">
                                    <div class="me-3">
                                        <i class="fas fa-envelope text-primary fa-lg"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Email Us</h6>
                                        <p class="text-muted mb-0">info@travelexplorer.com<br>support@travelexplorer.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Contact Form -->
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-body p-5">
                            <h4 class="mb-4">
                                <i class="fas fa-paper-plane text-primary me-2"></i>Send Us a Message
                            </h4>
                            <p class="text-muted mb-4">Have questions about our travel services? Fill out the form below and we'll get back to you within 24 hours.</p>
                            
                            <form id="contactForm">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">
                                                <i class="fas fa-user me-1 text-primary"></i>Full Name
                                            </label>
                                            <input type="text" class="form-control" id="name" placeholder="Enter your full name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label">
                                                <i class="fas fa-envelope me-1 text-primary"></i>Email Address
                                            </label>
                                            <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone" class="form-label">
                                                <i class="fas fa-phone me-1 text-primary"></i>Phone Number
                                            </label>
                                            <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subject" class="form-label">
                                                <i class="fas fa-tag me-1 text-primary"></i>Subject
                                            </label>
                                            <select class="form-select" id="subject" required>
                                                <option value="" selected disabled>Select a subject</option>
                                                <option value="booking">Booking Inquiry</option>
                                                <option value="package">Package Information</option>
                                                <option value="hotel">Hotel Reservation</option>
                                                <option value="payment">Payment Issue</option>
                                                <option value="other">Other Inquiry</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="message" class="form-label">
                                                <i class="fas fa-comment-dots me-1 text-primary"></i>Your Message
                                            </label>
                                            <textarea class="form-control" id="message" rows="4" placeholder="Type your message here..." required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" id="newsletter">
                                            <label class="form-check-label" for="newsletter">
                                                Subscribe to our newsletter for travel tips & offers
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg w-100">
                                            <i class="fas fa-paper-plane me-2"></i>Send Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Hours -->
            <div class="row mt-5">
                <div class="col-lg-12 mx-auto">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center mb-3 mb-md-0">
                                    <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                                    <h5 class="fw-bold">Business Hours</h5>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="mb-2"><strong>Monday - Friday:</strong></p>
                                            <p class="text-muted">9:00 AM - 8:00 PM</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-2"><strong>Saturday - Sunday:</strong></p>
                                            <p class="text-muted">10:00 AM - 6:00 PM</p>
                                        </div>
                                    </div>
                                    <p class="text-muted mt-2 mb-0">
                                        <i class="fas fa-info-circle me-1"></i>
                                        24/7 emergency support available for existing bookings
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ============================================
        // 1. ADVANCED SEARCH TOGGLE FUNCTIONALITY
        // ============================================
        const toggleAdvancedComponentBtn = document.getElementById('toggleAdvancedComponentBtn');
        const closeAdvancedSearchBtn = document.getElementById('closeAdvancedSearchBtn');
        const advancedSearchContainer = document.getElementById('advancedSearchContainer');
        const heroQuickSearch = document.getElementById('heroQuickSearch');
        
        // Toggle Advanced Search Component
        toggleAdvancedComponentBtn.addEventListener('click', function() {
            // Disable button during transition
            this.disabled = true;
            
            // Show advanced search container
            advancedSearchContainer.style.display = 'block';
            
            // Trigger reflow to enable transition
            void advancedSearchContainer.offsetWidth;
            
            // Add show class for animation
            advancedSearchContainer.classList.add('show');
            
            // Update button state
            updateToggleButtonState(true);
            
            // Scroll to advanced search
            setTimeout(() => {
                advancedSearchContainer.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Focus on first input in advanced search
                const firstInput = advancedSearchContainer.querySelector('input, select, textarea');
                if (firstInput) {
                    firstInput.focus();
                }
            }, 300);
            
            // Show notification
            showNotification('Advanced search filters opened. You can now apply multiple filters for precise results.', 'info');
        });
        
        // Close Advanced Search
        closeAdvancedSearchBtn.addEventListener('click', function() {
            // Remove show class for hide animation
            advancedSearchContainer.classList.remove('show');
            
            // Update toggle button
            updateToggleButtonState(false);
            
            // Re-enable toggle button after animation
            setTimeout(() => {
                toggleAdvancedComponentBtn.disabled = false;
                
                // Hide container after animation
                setTimeout(() => {
                    advancedSearchContainer.style.display = 'none';
                }, 300);
            }, 300);
            
            // Scroll back to hero
            document.querySelector('.hero-section').scrollIntoView({ 
                behavior: 'smooth',
                block: 'center'
            });
        });
        
        // Update Toggle Button State
        function updateToggleButtonState(isOpen) {
            const toggleText = toggleAdvancedComponentBtn.querySelector('span');
            const icon = toggleAdvancedComponentBtn.querySelector('i');
            
            if (isOpen) {
                toggleText.textContent = 'Advanced Filters Active';
                icon.className = 'fas fa-check me-2 text-success';
                toggleAdvancedComponentBtn.classList.add('active');
            } else {
                toggleText.textContent = 'Show Advanced Search Filters';
                icon.className = 'fas fa-sliders-h me-2';
                toggleAdvancedComponentBtn.classList.remove('active');
            }
        }
        
        // ============================================
        // 2. QUICK SEARCH FORM SUBMISSION
        // ============================================
        heroQuickSearch.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const searchInput = this.querySelector('input[name="q"]');
            const searchQuery = searchInput.value.trim();
            
            if (!searchQuery) {
                showNotification('Please enter a destination, hotel, or attraction name', 'warning');
                searchInput.focus();
                return;
            }
            
            // Show loading
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Searching...';
            submitBtn.disabled = true;
            
            // Add search to recent searches (localStorage)
            saveRecentSearch(searchQuery);
            
            // Submit after delay
            setTimeout(() => {
                this.submit();
            }, 800);
        });
        
        // ============================================
        // 3. DESTINATION FILTERS - WORKING FUNCTIONALITY
        // ============================================
        const stateFilter = document.getElementById('stateFilter');
        const categoryFilter = document.getElementById('categoryFilter');
        const applyFilterBtn = document.getElementById('applyFilterBtn');
        const clearFilterBtn = document.getElementById('clearFilterBtn');
        const filterStatus = document.getElementById('filterStatus');
        const destinationItems = document.querySelectorAll('.destination-item');
        
        // Apply Filter Functionality
        applyFilterBtn.addEventListener('click', function() {
            const selectedState = stateFilter.value;
            const selectedCategory = categoryFilter.value;
            
            // Show loading state
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Filtering...';
            this.disabled = true;
            
            setTimeout(() => {
                let visibleCount = 0;
                
                // Loop through all destination items
                destinationItems.forEach(item => {
                    const itemState = item.getAttribute('data-state');
                    const itemCategory = item.getAttribute('data-category');
                    
                    // Check if item matches filter criteria
                    const stateMatch = !selectedState || itemState === selectedState;
                    const categoryMatch = !selectedCategory || itemCategory === selectedCategory;
                    
                    if (stateMatch && categoryMatch) {
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
                
                // Update status message
                updateFilterStatus(selectedState, selectedCategory, visibleCount);
                
                // Show/hide clear filter button
                if (selectedState || selectedCategory) {
                    clearFilterBtn.style.display = 'block';
                } else {
                    clearFilterBtn.style.display = 'none';
                }
                
                // Reset button state
                this.innerHTML = '<i class="fas fa-filter me-2"></i>Apply Filter';
                this.disabled = false;
                
                // Scroll to filtered results
                if (visibleCount > 0) {
                    document.getElementById('destinationsGrid').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
                
                // Show notification
                if (visibleCount === 0) {
                    showNotification('No destinations found matching your filters. Try different criteria.', 'warning');
                } else {
                    showNotification(`Found ${visibleCount} destinations matching your filters`, 'success');
                }
                
            }, 500);
        });
        
        // Clear Filter Functionality
        clearFilterBtn.addEventListener('click', function() {
            // Reset dropdowns
            stateFilter.value = '';
            categoryFilter.value = '';
            
            // Show all items
            destinationItems.forEach(item => {
                item.style.display = 'block';
                item.classList.add('animate__animated', 'animate__fadeIn');
                setTimeout(() => {
                    item.classList.remove('animate__animated', 'animate__fadeIn');
                }, 1000);
            });
            
            // Update status
            filterStatus.innerHTML = 'Showing all destinations';
            filterStatus.className = 'text-center text-muted small';
            
            // Hide clear button
            this.style.display = 'none';
            
            // Show notification
            showNotification('All filters cleared. Showing all destinations.', 'info');
        });
        
        // Update Filter Status Message
        function updateFilterStatus(state, category, count) {
            let statusText = '';
            
            if (!state && !category) {
                statusText = 'Showing all destinations';
                filterStatus.className = 'text-center text-muted small';
            } else {
                const stateText = state ? `State: ${getStateName(state)}` : '';
                const categoryText = category ? `Category: ${getCategoryName(category)}` : '';
                const separator = (state && category) ? ' | ' : '';
                
                statusText = `Showing ${count} destinations`;
                if (stateText || categoryText) {
                    statusText += ` (${stateText}${separator}${categoryText})`;
                }
                filterStatus.className = 'text-center text-primary small fw-bold';
            }
            
            filterStatus.innerHTML = statusText;
        }
        
        // Helper functions for display names
        function getStateName(stateCode) {
            const states = {
                'assam': 'Assam',
                'goa': 'Goa', 
                'kerala': 'Kerala',
                'rajasthan': 'Rajasthan',
                'himachal': 'Himachal Pradesh',
                'uttarakhand': 'Uttarakhand',
                'tamilnadu': 'Tamil Nadu'
            };
            return states[stateCode] || stateCode;
        }
        
        function getCategoryName(categoryCode) {
            const categories = {
                'hill': 'Hill Station',
                'beach': 'Beach',
                'heritage': 'Heritage',
                'wildlife': 'Wildlife',
                'adventure': 'Adventure',
                'religious': 'Religious',
                'historical': 'Historical'
            };
            return categories[categoryCode] || categoryCode;
        }
        
        // ============================================
        // 4. HOTELS OWL CAROUSEL INITIALIZATION
        // ============================================
        function initializeHotelsCarousel() {
            if ($.fn.owlCarousel) {
                $('.hotels-carousel').owlCarousel({
                    loop: true,          // Loop enabled for continuous scrolling
                    margin: 30,          // Space between items
                    nav: true,           // Show navigation arrows
                    dots: true,          // Show pagination dots
                    autoplay: true,      // Auto play carousel
                    autoplayTimeout: 3000, // 3 seconds between slides
                    autoplayHoverPause: true, // Pause on hover
                    responsive: {
                        0: { 
                            items: 1,    // Mobile: 1 hotel visible
                            nav: false   // Hide arrows on mobile
                        },
                        600: { 
                            items: 2,    // Tablet: 2 hotels visible
                            nav: false
                        },
                        1000: { 
                            items: 3     // Desktop: 3 hotels visible (as requested)
                        }
                    }
                });
            }
        }
        
        // ============================================
        // 5. LOAD MORE DESTINATIONS
        // ============================================
        document.getElementById('loadMoreDestinations')?.addEventListener('click', function() {
            const button = this;
            const destinationsGrid = document.getElementById('destinationsGrid');
            
            // Show loading
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
            button.disabled = true;
            
            // Simulate loading more destinations
            setTimeout(() => {
                // Get current filter state
                const currentState = stateFilter.value;
                const currentCategory = categoryFilter.value;
                
                // Additional destinations data
                const additionalDestinations = [
                    {
                        id: 10,
                        name: "Shimla, Himachal",
                        state: "himachal",
                        category: "hill",
                        price: "8,500",
                        image: "{{ asset('images/destinations/shimla-14.avif') }}",
                        description: "Queen of hill stations with colonial architecture and scenic beauty.",
                        hotels: 40,
                        rating: 4.4
                    },
                    {
                        id: 11,
                        name: "Varanasi, Uttar Pradesh",
                        state: "uttarakhand",
                        category: "religious",
                        price: "6,500",
                        image: "{{ asset('images/destinations/Varanasi.jpg') }}",
                        description: "Spiritual capital on the banks of Ganges, famous for ghats and temples.",
                        hotels: 55,
                        rating: 4.7
                    },
                    {
                        id: 12,
                        name: "Andaman Islands",
                        state: "goa",
                        category: "beach",
                        price: "18,000",
                        image: "{{ asset('images/destinations/andaman_islands.webp') }}",
                        description: "Pristine islands with coral reefs, water sports and exotic beaches.",
                        hotels: 25,
                        rating: 4.9
                    }
                ];
                
                // Add new destinations
                additionalDestinations.forEach(dest => {
                    // Check if destination matches current filters
                    const stateMatch = !currentState || dest.state === currentState;
                    const categoryMatch = !currentCategory || dest.category === currentCategory;
                    
                    if (stateMatch && categoryMatch) {
                        const newDestination = `
                            <div class="col-lg-4 col-md-6 mb-4 destination-item" 
                                 data-state="${dest.state}" 
                                 data-category="${dest.category}"
                                 data-price="${dest.price.replace(',', '')}">
                                <div class="destination-card animate__animated animate__fadeInUp">
                                    <div class="position-relative overflow-hidden">
                                        <img src="${dest.image}" 
                                             class="card-img-top" 
                                             alt="${dest.name}">
                                        <div class="position-absolute top-0 end-0 m-3">
                                            <span class="badge bg-primary">
                                                <i class="fas fa-star me-1"></i>${dest.rating}
                                            </span>
                                        </div>
                                        <div class="position-absolute bottom-0 start-0 m-3">
                                            <span class="badge ${getCategoryBadgeClass(dest.category)}">
                                                ${getCategoryName(dest.category)}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h5 class="card-title fw-bold">${dest.name}</h5>
                                            <span class="text-primary fw-bold">₹${dest.price}</span>
                                        </div>
                                        <p class="card-text text-muted mb-2">
                                            <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                            ${getStateName(dest.state)}
                                        </p>
                                        <p class="card-text mb-4">
                                            ${dest.description}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="/destination/${dest.id}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye me-1"></i>View Details
                                            </a>
                                            <div>
                                                <small class="text-muted">
                                                    <i class="fas fa-hotel me-1"></i>
                                                    ${dest.hotels} Hotels
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        destinationsGrid.innerHTML += newDestination;
                    }
                });
                
                // Update filter status with new count
                const visibleItems = document.querySelectorAll('.destination-item[style*="block"], .destination-item:not([style])');
                updateFilterStatus(currentState, currentCategory, visibleItems.length);
                
                // Reset button
                button.innerHTML = '<i class="fas fa-plus me-2"></i>Load More Destinations';
                button.disabled = false;
                
                // Scroll to new destinations
                setTimeout(() => {
                    const newDestinations = destinationsGrid.querySelectorAll('.destination-item:nth-last-child(-n+3)');
                    if (newDestinations.length > 0) {
                        newDestinations[0].scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }, 100);
                
            }, 1000);
        });
        
        // Helper function for category badge classes
        function getCategoryBadgeClass(category) {
            const badgeClasses = {
                'hill': 'bg-warning text-dark',
                'beach': 'bg-info',
                'heritage': 'bg-success',
                'wildlife': 'bg-dark',
                'adventure': 'bg-danger',
                'religious': 'bg-secondary',
                'historical': 'bg-primary'
            };
            return badgeClasses[category] || 'bg-primary';
        }
        
        // ============================================
        // 6. CONTACT FORM SUBMISSION
        // ============================================
        document.getElementById('contactForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                subject: document.getElementById('subject').value,
                message: document.getElementById('message').value
            };
            
            // Validate form
            if (!formData.name || !formData.email || !formData.subject || !formData.message) {
                showNotification('Please fill in all fields', 'warning');
                return;
            }
            
            // Validate email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(formData.email)) {
                showNotification('Please enter a valid email address', 'warning');
                return;
            }
            
            // Show loading
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
            submitBtn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                // Show success message
                showNotification('Thank you for your message! We will get back to you soon.', 'success');
                
                // Reset form
                this.reset();
                
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 1500);
        });
        
        // ============================================
        // 7. SLIDER INITIALIZATION (ALL SLIDERS)
        // ============================================
        function initializeSliders() {
            // Initialize Hotels Owl Carousel
            initializeHotelsCarousel();
            
            // Initialize Swiper for Packages
            if (typeof Swiper !== 'undefined') {
                new Swiper('.packages-swiper', {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    breakpoints: {
                        640: { slidesPerView: 2 },
                        1024: { slidesPerView: 3 },
                    },
                });
            }
            
            // Initialize Slick Slider for Testimonials
            if ($.fn.slick) {
                $('.testimonials-slider').slick({
                    dots: true,
                    infinite: true,
                    speed: 300,
                    slidesToShow: 1,
                    adaptiveHeight: true,
                    arrows: true,
                    prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
                    nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                arrows: false,
                                dots: true
                            }
                        }
                    ]
                });
            }
        }
        
        // ============================================
        // 8. UTILITY FUNCTIONS
        // ============================================
        // Save Recent Search
        function saveRecentSearch(searchTerm) {
            try {
                const recentSearches = JSON.parse(localStorage.getItem('recentSearches') || '[]');
                
                // Remove if already exists
                const index = recentSearches.indexOf(searchTerm);
                if (index !== -1) {
                    recentSearches.splice(index, 1);
                }
                
                // Add to beginning
                recentSearches.unshift(searchTerm);
                
                // Keep only last 5 searches
                if (recentSearches.length > 5) {
                    recentSearches.pop();
                }
                
                localStorage.setItem('recentSearches', JSON.stringify(recentSearches));
            } catch (e) {
                console.log('Could not save recent search:', e);
            }
        }
        
        // Show Notification
        function showNotification(message, type = 'info') {
            // Remove existing notification
            const existingNotification = document.querySelector('.hero-notification');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            // Determine icon
            let icon = 'info-circle';
            if (type === 'warning') icon = 'exclamation-triangle';
            if (type === 'success') icon = 'check-circle';
            if (type === 'error') icon = 'times-circle';
            
            // Create notification
            const notification = document.createElement('div');
            notification.className = `hero-notification alert alert-${type} alert-dismissible fade show`;
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
        
        // ============================================
        // 9. KEYBOARD SHORTCUTS
        // ============================================
        document.addEventListener('keydown', function(e) {
            // ESC to close advanced search
            if (e.key === 'Escape' && advancedSearchContainer.classList.contains('show')) {
                closeAdvancedSearchBtn.click();
            }
            
            // Ctrl/Cmd + F to focus on quick search
            if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                e.preventDefault();
                const searchInput = heroQuickSearch.querySelector('input[name="q"]');
                searchInput.focus();
                searchInput.select();
            }
            
            // Ctrl/Cmd + / to toggle advanced search
            if ((e.ctrlKey || e.metaKey) && e.key === '/') {
                e.preventDefault();
                if (advancedSearchContainer.classList.contains('show')) {
                    closeAdvancedSearchBtn.click();
                } else {
                    toggleAdvancedComponentBtn.click();
                }
            }
            
            // Ctrl/Cmd + Shift + F to focus on destination filters
            if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.key === 'F') {
                e.preventDefault();
                stateFilter.focus();
            }
        });
    
        // ============================================
        // 10. INITIALIZE EVERYTHING
        // ============================================
        // Initialize all sliders
        initializeSliders();
        
        // Initialize recent searches
        function initRecentSearches() {
            try {
                const recentSearches = JSON.parse(localStorage.getItem('recentSearches') || '[]');
                if (recentSearches.length > 0) {
                    console.log('Recent searches:', recentSearches);
                }
            } catch (e) {
                console.log('Could not load recent searches');
            }
        }
        initRecentSearches();
        
        // Initialize filter status
        updateFilterStatus('', '', destinationItems.length);
        
        // Initialize hotel booking buttons
        document.querySelectorAll('.book-hotel-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const hotelName = this.closest('.hotel-card').querySelector('.card-title').textContent;
                showNotification(`Redirecting to ${hotelName} booking page...`, 'info');
                
                // Redirect after 1 second
                setTimeout(() => {
                    window.location.href = this.href;
                }, 1000);
            });
        });
    });
</script>
@endsection

@section('styles')
<style>
    /* ============================================
       HERO SECTION STYLES
    ============================================ */
    .hero-section {
        position: relative;
    }
    
    .hero-section h1 {
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }
    
    /* Quick Search Box */
    .hero-section .card {
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }
    
    .hero-section .input-group-lg .form-control,
    .hero-section .input-group-lg .btn {
        height: 60px;
        font-size: 1.1rem;
    }
    
    .hero-section .input-group-text {
        border-radius: 15px 0 0 15px;
        padding: 0 20px;
    }
    
    .hero-section .btn-primary {
        border-radius: 0 15px 15px 0;
        padding: 0 30px;
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        border: none;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    /* Toggle Button Styling */
    #toggleAdvancedComponentBtn {
        color: #3498db;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    #toggleAdvancedComponentBtn:hover {
        color: #2c3e50;
        transform: translateY(-2px);
    }
    
    #toggleAdvancedComponentBtn i {
        transition: transform 0.3s ease;
    }
    
    #toggleAdvancedComponentBtn:hover i {
        transform: rotate(15deg);
    }
    
    #toggleAdvancedComponentBtn.active {
        color: #28a745;
    }
    
    /* Advanced Search Container */
    #advancedSearchContainer {
        animation: slideDown 0.5s ease forwards;
        box-shadow: 0 -5px 20px rgba(0,0,0,0.1);
        position: relative;
        z-index: 100;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease, opacity 0.5s ease;
    }
    
    #advancedSearchContainer.show {
        max-height: 2000px;
        opacity: 1;
    }
    
    /* ============================================
       DESTINATION FILTER STYLES
    ============================================ */
    #filterStatus {
        transition: all 0.3s ease;
    }
    
    .destination-item {
        transition: all 0.5s ease;
    }
    
    /* Category Badges */
    .badge.bg-warning.text-dark {
        background-color: #ffc107 !important;
    }
    
    .badge.bg-info {
        background-color: #17a2b8 !important;
    }
    
    .badge.bg-success {
        background-color: #28a745 !important;
    }
    
    .badge.bg-dark {
        background-color: #343a40 !important;
    }
    
    .badge.bg-danger {
        background-color: #dc3545 !important;
    }
    
    .badge.bg-secondary {
        background-color: #6c757d !important;
    }
    
    /* ============================================
       HOTELS SECTION STYLES
    ============================================ */
    .hotels-carousel .owl-stage {
        display: flex;
        padding: 20px 0;
    }
    
    .hotels-carousel .owl-item {
        padding: 10px;
    }
    
    .hotel-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .hotel-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
    }
    
    .hotel-image {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }
    
    /* Owl Carousel Navigation */
    .hotels-carousel .owl-nav {
        position: absolute;
        top: 50%;
        width: 100%;
        transform: translateY(-50%);
    }
    
    .hotels-carousel .owl-prev,
    .hotels-carousel .owl-next {
        position: absolute;
        background: rgba(255, 255, 255, 0.9) !important;
        border-radius: 50% !important;
        width: 50px;
        height: 50px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        font-size: 24px !important;
        color: #3498db !important;
        box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }
    
    .hotels-carousel .owl-prev:hover,
    .hotels-carousel .owl-next:hover {
        background: #3498db !important;
        color: white !important;
        transform: scale(1.1);
    }
    
    .hotels-carousel .owl-prev {
        left: -25px;
    }
    
    .hotels-carousel .owl-next {
        right: -25px;
    }
    
    /* Owl Carousel Dots */
    .hotels-carousel .owl-dots {
        margin-top: 20px;
        text-align: center;
    }
    
    .hotels-carousel .owl-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #ddd !important;
        margin: 0 5px;
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .hotels-carousel .owl-dot.active {
        background: #3498db !important;
        transform: scale(1.3);
    }
    
    /* Book Now Button Styling */
    .book-hotel-btn {
        transition: all 0.3s ease;
        border-radius: 25px;
        padding: 8px 20px;
    }
    
    .book-hotel-btn:hover {
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
    }
    
    /* ============================================
       DESTINATIONS, HOTELS & PACKAGES STYLES
    ============================================ */
    .destination-card, .package-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }
    
    .destination-card:hover, .package-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2) !important;
    }
    
    .owl-carousel .owl-item {
        padding: 15px;
    }
    
    .swiper {
        padding: 30px 10px 50px !important;
    }
    
    .swiper-slide {
        height: auto;
    }
    
    .slick-slider {
        margin: 0 -15px;
    }
    
    .slick-slide > div {
        padding: 0 15px;
    }
    
    .testimonial-item .card {
        height: 100%;
    }
    
    /* ============================================
       ABOUT SECTION
    ============================================ */
    #about .position-relative img {
        filter: brightness(0.9);
    }
    
    /* ============================================
       SECTION SPACING
    ============================================ */
    .section-padding {
        padding: 80px 0;
    }
    
    .section-title {
        text-align: center;
        margin-bottom: 50px;
        position: relative;
    }
    
    .section-title h2 {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 15px;
    }
    
    .section-title p {
        color: #666;
        max-width: 700px;
        margin: 0 auto;
    }
    
    /* ============================================
       NOTIFICATION STYLES
    ============================================ */
    .hero-notification {
        animation: slideInRight 0.3s ease forwards;
    }
    
    /* ============================================
       ANIMATION KEYFRAMES
    ============================================ */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideUp {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }
    
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    /* ============================================
       RESPONSIVE DESIGN
    ============================================ */
    @media (max-width: 768px) {
        .hero-section {
            padding-top: 120px;
            padding-bottom: 60px;
            min-height: auto;
        }
        
        .section-padding {
            padding: 60px 0;
        }
        
        .display-4 {
            font-size: 2.5rem;
        }
        
        .hero-section .input-group-lg .form-control,
        .hero-section .input-group-lg .btn {
            height: 50px;
        }
        
        /* Hotels Carousel Responsive */
        .hotels-carousel .owl-prev,
        .hotels-carousel .owl-next {
            display: none !important;
        }
        
        .hotel-image {
            height: 180px;
        }
        
        /* Filter responsive */
        .row.g-3 {
            flex-direction: column;
        }
        
        .row.g-3 .col-md-4 {
            width: 100%;
            margin-bottom: 10px;
        }
        
        #clearFilterBtn {
            margin-top: 10px;
        }
    }
    
    @media (max-width: 576px) {
        .hero-section .input-group {
            flex-direction: column;
        }
        
        .hero-section .input-group-text,
        .hero-section .form-control,
        .hero-section .btn-primary {
            border-radius: 10px;
            width: 100%;
            margin-bottom: 10px;
        }
        
        .hero-section .input-group-text {
            border-radius: 10px 10px 0 0;
        }
        
        .hero-section .btn-primary {
            border-radius: 0 0 10px 10px;
        }
        
        .d-flex.flex-wrap {
            flex-direction: column;
            gap: 10px !important;
        }
        
        .d-flex.flex-wrap .btn {
            width: 100%;
        }
        
        /* Hotel cards responsive */
        .hotel-card .card-body {
            padding: 15px;
        }
        
        .hotel-card .card-title {
            font-size: 1.1rem;
        }
        
        /* Destination cards responsive */
        .destination-card .card-body {
            padding: 15px;
        }
        
        .destination-card .card-title {
            font-size: 1.1rem;
        }
    }
    
    /* ============================================
       FILTER BUTTON STYLING
    ============================================ */
    #applyFilterBtn {
        transition: all 0.3s ease;
        border-radius: 8px;
        padding: 10px 15px;
    }
    
    #applyFilterBtn:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
    }
    
    #clearFilterBtn {
        transition: all 0.3s ease;
        border-radius: 8px;
        padding: 8px 15px;
    }
    
    #clearFilterBtn:hover {
        background-color: #6c757d;
        color: white;
        transform: translateY(-2px);
    }
    
    /* ============================================
       FORM SELECT STYLING
    ============================================ */
    .form-select {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
        padding: 10px 15px;
    }
    
    .form-select:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
    }
    
    /* ============================================
       CLOSE BUTTON STYLING
    ============================================ */
    #closeAdvancedSearchBtn {
        transition: all 0.3s ease;
        border-radius: 50px;
        padding: 10px 30px;
    }
    
    #closeAdvancedSearchBtn:hover {
        background-color: #6c757d;
        color: white;
        transform: translateY(-2px);
    }
</style>
@endsection