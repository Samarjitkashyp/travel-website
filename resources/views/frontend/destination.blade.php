@extends('layouts.app')

@section('title', 'Destination Details - Travel Explorer')

@section('content')
    <!-- Destination Hero Section -->
    <section class="destination-hero">
        <div class="hero-image" style="
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), 
                        url('https://images.unsplash.com/photo-1552733407-5d5c46c3bb3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80');
            height: 500px;
            background-size: cover;
            background-position: center;
            position: relative;
        ">
            <div class="container h-100">
                <div class="row h-100 align-items-end">
                    <div class="col-lg-8 text-white pb-5">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent p-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white">Home</a></li>
                                <li class="breadcrumb-item"><a href="#destinations" class="text-white">Destinations</a></li>
                                <li class="breadcrumb-item active text-white" aria-current="page">Destination Details</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInUp">Guwahati, Assam</h1>
                        <div class="d-flex flex-wrap gap-3 animate__animated animate__fadeInUp animate__delay-1s">
                            <span class="badge bg-primary fs-6 p-2">
                                <i class="fas fa-map-marker-alt me-2"></i>North-East India
                            </span>
                            <span class="badge bg-success fs-6 p-2">
                                <i class="fas fa-star me-2"></i>4.5/5 Rating
                            </span>
                            <span class="badge bg-info fs-6 p-2">
                                <i class="fas fa-rupee-sign me-2"></i>Budget Friendly
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 text-white pb-5">
                        <div class="card bg-dark bg-opacity-75 border-0 shadow-lg">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="fas fa-info-circle me-2"></i>Quick Info
                                </h5>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <small class="text-light">Best Time to Visit</small>
                                        <p class="mb-0 fw-bold">Oct - Mar</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <small class="text-light">Ideal Duration</small>
                                        <p class="mb-0 fw-bold">3-5 Days</p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-light">Avg. Cost</small>
                                        <p class="mb-0 fw-bold">₹8,000-15,000</p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-light">Type</small>
                                        <p class="mb-0 fw-bold">City, Cultural</p>
                                    </div>
                                </div>
                                <button class="btn btn-primary w-100 mt-3">
                                    <i class="fas fa-calendar-alt me-2"></i>Plan Your Trip
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row">
            <!-- Left Sidebar - Table of Contents -->
            <div class="col-lg-3 mb-4">
                <div class="sticky-top" style="top: 100px;">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Jump to Section</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <a href="#overview" class="list-group-item list-group-item-action border-0">
                                    <i class="fas fa-eye me-2 text-primary"></i>Overview
                                </a>
                                <a href="#attractions" class="list-group-item list-group-item-action border-0">
                                    <i class="fas fa-camera me-2 text-primary"></i>Top Attractions
                                </a>
                                <a href="#hotels" class="list-group-item list-group-item-action border-0">
                                    <i class="fas fa-hotel me-2 text-primary"></i>Nearby Hotels
                                </a>
                                <a href="#areas" class="list-group-item list-group-item-action border-0">
                                    <i class="fas fa-map-marked-alt me-2 text-primary"></i>Nearby Areas
                                </a>
                                <a href="#gallery" class="list-group-item list-group-item-action border-0">
                                    <i class="fas fa-images me-2 text-primary"></i>Photo Gallery
                                </a>
                                <a href="#travel-tips" class="list-group-item list-group-item-action border-0">
                                    <i class="fas fa-lightbulb me-2 text-primary"></i>Travel Tips
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Contact -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title mb-3">
                                <i class="fas fa-headset me-2 text-primary"></i>Need Help?
                            </h6>
                            <p class="text-muted small mb-3">Contact our travel experts</p>
                            <button class="btn btn-outline-primary btn-sm w-100 mb-2">
                                <i class="fas fa-phone-alt me-1"></i> Call Now
                            </button>
                            <button class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-comment-alt me-1"></i> Chat Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="col-lg-9">
                <!-- Overview Section -->
                <section id="overview" class="mb-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="mb-4">
                                <i class="fas fa-eye text-primary me-2"></i>Overview
                            </h2>
                           
                            <!-- ✅ Short Description -->
                            <div class="lead summernote-content">
                                {!! $destination->description !!}
                            </div>

                            <!-- ✅ Detailed Overview -->
                            <div class="mt-4 summernote-content">
                                {!! $destination->overview !!}
                            </div>
                            
                            <!-- Key Highlights -->
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h5 class="text-primary mb-3">
                                        <i class="fas fa-check-circle me-2"></i>Key Highlights
                                    </h5>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-chevron-right text-primary me-2"></i>
                                            Ancient Kamakhya Temple
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-chevron-right text-primary me-2"></i>
                                            Brahmaputra River Cruises
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-chevron-right text-primary me-2"></i>
                                            Umananda Island (Peacock Island)
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-chevron-right text-primary me-2"></i>
                                            Assam State Zoo and Botanical Garden
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-chevron-right text-primary me-2"></i>
                                            Fancy Bazaar - Shopping Hub
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-primary mb-3">
                                        <i class="fas fa-map-signs me-2"></i>Best For
                                    </h5>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge bg-light text-dark p-2">
                                            <i class="fas fa-pray me-1"></i> Pilgrimage
                                        </span>
                                        <span class="badge bg-light text-dark p-2">
                                            <i class="fas fa-camera me-1"></i> Photography
                                        </span>
                                        <span class="badge bg-light text-dark p-2">
                                            <i class="fas fa-utensils me-1"></i> Food Tours
                                        </span>
                                        <span class="badge bg-light text-dark p-2">
                                            <i class="fas fa-shopping-bag me-1"></i> Shopping
                                        </span>
                                        <span class="badge bg-light text-dark p-2">
                                            <i class="fas fa-leaf me-1"></i> Nature Walks
                                        </span>
                                        <span class="badge bg-light text-dark p-2">
                                            <i class="fas fa-water me-1"></i> River Activities
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Top Attractions Section -->
                <section id="attractions" class="mb-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="mb-4">
                                <i class="fas fa-camera text-primary me-2"></i>Top Attractions
                            </h2>
                            <p class="text-muted mb-4">Explore the must-visit places in and around Guwahati</p>

                            <!-- Owl Carousel for Attractions -->
                            <div class="owl-carousel attractions-carousel">
                                @for($i = 1; $i <= 6; $i++)
                                    <div class="item">
                                        <div class="card attraction-card border-0 h-100">
                                            <img src="https://images.unsplash.com/photo-{{ 
                                                ['1552733407-5d5c46c3bb3b', '1520250497591-112f2f40a3f4', 
                                                 '1519681393784-d120267933ba', '1516483638261-f4dbaf036963',
                                                 '1539635278303-d4002c07eae3', '1544551763-46a013bb70d5'][$i-1] 
                                            }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                                                 class="card-img-top" 
                                                 alt="Attraction {{ $i }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ 
                                                    ['Kamakhya Temple', 'Brahmaputra River Cruise', 
                                                     'Umananda Island', 'Assam State Zoo',
                                                     'Fancy Bazaar', 'Saraighat Bridge'][$i-1] 
                                                }}</h5>
                                                <p class="card-text text-muted small">
                                                    <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                                    {{ 
                                                        ['Nilachal Hill', 'Brahmaputra River', 
                                                         'Peacock Island', 'Jalukbari',
                                                         'City Center', 'Saraighat'][$i-1] 
                                                    }}
                                                </p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="badge bg-primary">
                                                        <i class="fas fa-star me-1"></i>4.{{ rand(2, 8) }}
                                                    </span>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        View Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>

                            <!-- More Attractions List -->
                            <div class="mt-5">
                                <h5 class="mb-3">Other Popular Places</h5>
                                <div class="row">
                                    @for($i = 1; $i <= 6; $i++)
                                        <div class="col-md-6 mb-3">
                                            <div class="d-flex align-items-start p-3 border rounded">
                                                <div class="flex-shrink-0">
                                                    <i class="fas fa-{{ 
                                                        ['monument', 'mountain', 'water', 'tree', 'shopping-cart', 'university'][$i-1] 
                                                    }} text-primary fa-2x me-3"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-1">{{ 
                                                        ['Navagraha Temple', 'Chandubi Lake', 
                                                         'Deepor Beel', 'Botanical Garden',
                                                         'GS Road Market', 'Gauhati University'][$i-1] 
                                                    }}</h6>
                                                    <p class="text-muted small mb-0">
                                                        {{ 
                                                            ['Ancient temple complex', 'Natural lake perfect for picnics',
                                                             'Bird watching paradise', 'Lush green botanical park',
                                                             'Popular shopping street', 'Prestigious educational institute'][$i-1] 
                                                        }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Nearby Hotels Section -->
                <section id="hotels" class="mb-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2 class="mb-0">
                                    <i class="fas fa-hotel text-primary me-2"></i>Nearby Hotels & Stays
                                </h2>
                                <a href="#" class="btn btn-outline-primary">
                                    <i class="fas fa-filter me-1"></i> Filter Hotels
                                </a>
                            </div>
                            <p class="text-muted mb-4">Find the perfect accommodation for your stay in Guwahati</p>

                            <!-- Hotel Filters -->
                            <div class="row mb-4">
                                <div class="col-md-8">
                                    <div class="d-flex flex-wrap gap-2">
                                        <button class="btn btn-sm btn-outline-primary active">All</button>
                                        <button class="btn btn-sm btn-outline-primary">Budget (Under ₹2000)</button>
                                        <button class="btn btn-sm btn-outline-primary">Mid-range (₹2000-5000)</button>
                                        <button class="btn btn-sm btn-outline-primary">Luxury (₹5000+)</button>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-swimming-pool me-1"></i> Pool
                                        </button>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-utensils me-1"></i> Restaurant
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-4 text-md-end mt-2 mt-md-0">
                                    <select class="form-select form-select-sm w-auto d-inline-block">
                                        <option>Sort by: Rating</option>
                                        <option>Price: Low to High</option>
                                        <option>Price: High to Low</option>
                                        <option>Distance</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Hotels List -->
                            <div class="row">
                                @for($i = 1; $i <= 6; $i++)
                                    <div class="col-lg-6 mb-4">
                                        <div class="card hotel-listing-card border-0 shadow-sm h-100">
                                            <div class="row g-0 h-100">
                                                <div class="col-md-5">
                                                    <img src="https://images.unsplash.com/photo-{{ 
                                                        ['1566073771259-6a8506099945', '1551882547-ff3700d75d25',
                                                         '1571896349842-3c7ad8e27b86', '1564501049412-61c2a3083791',
                                                         '1520250497591-112f2f40a3f4', '1551632436-cbf8dd35ad39'][$i-1] 
                                                    }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                                         class="img-fluid rounded-start h-100" 
                                                         style="object-fit: cover;"
                                                         alt="Hotel {{ $i }}">
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                                            <h5 class="card-title mb-0">{{ 
                                                                ['Radisson Blu Guwahati', 'Novotel Guwahati',
                                                                 'Hotel Dynasty', 'Brahmaputra Jungle Resort',
                                                                 'Vivanta Guwahati', 'Hotel Shiva Palace'][$i-1] 
                                                            }}</h5>
                                                            <span class="badge bg-warning text-dark">
                                                                {{ rand(3, 5) }}<i class="fas fa-star ms-1"></i>
                                                            </span>
                                                        </div>
                                                        <p class="text-muted small mb-2">
                                                            <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                                            {{ 
                                                                ['GS Road', 'Paltan Bazaar', 'Beltola', 
                                                                 'Jalukbari', 'Khanapara', 'Pandu'][$i-1] 
                                                            }}, Guwahati
                                                        </p>
                                                        <div class="mb-3">
                                                            @for($j = 0; $j < rand(2, 4); $j++)
                                                                <span class="badge bg-light text-dark me-1 mb-1">
                                                                    {{ ['Free WiFi', 'Pool', 'Spa', 'Restaurant', 'Parking', 'AC'][$j] }}
                                                                </span>
                                                            @endfor
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <span class="h5 text-primary mb-0">₹{{ rand(1500, 8000) }}</span>
                                                                <small class="text-muted d-block">per night</small>
                                                            </div>
                                                            <div class="text-end">
                                                                <small class="text-success d-block">
                                                                    <i class="fas fa-check-circle me-1"></i>
                                                                    {{ rand(85, 99) }}% Recommended
                                                                </small>
                                                                <button class="btn btn-primary btn-sm mt-1">
                                                                    <i class="fas fa-eye me-1"></i> View Details
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>

                            <!-- View All Hotels Button -->
                            <div class="text-center mt-4">
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-plus me-2"></i>Load More Hotels
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Nearby Areas Section -->
                <section id="areas" class="mb-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="mb-4">
                                <i class="fas fa-map-marked-alt text-primary me-2"></i>Nearby Areas & Places to Explore
                            </h2>
                            <p class="text-muted mb-4">Discover interesting places around Guwahati</p>

                            <!-- Swiper for Nearby Areas -->
                            <div class="swiper areas-swiper mb-5">
                                <div class="swiper-wrapper">
                                    @for($i = 1; $i <= 5; $i++)
                                        <div class="swiper-slide">
                                            <div class="card area-card border-0 h-100">
                                                <img src="https://images.unsplash.com/photo-{{ 
                                                    ['1552733407-5d5c46c3bb3b', '1520250497591-112f2f40a3f4',
                                                     '1519681393784-d120267933ba', '1516483638261-f4dbaf036963',
                                                     '1539635278303-d4002c07eae3'][$i-1] 
                                                }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                                                     class="card-img-top" 
                                                     alt="Area {{ $i }}">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ 
                                                        ['Shillong, Meghalaya', 'Kaziranga National Park',
                                                         'Cherrapunji', 'Majuli Island', 'Tawang'][$i-1] 
                                                    }}</h5>
                                                    <p class="text-muted small">
                                                        <i class="fas fa-road me-1"></i>
                                                        {{ rand(50, 300) }} km from Guwahati
                                                    </p>
                                                    <p class="card-text">
                                                        {{ 
                                                            ['Scotland of the East with beautiful hills',
                                                             'Famous for one-horned rhinoceros',
                                                             'Wettest place on earth with stunning waterfalls',
                                                             'World\'s largest river island',
                                                             'Buddhist monasteries and scenic beauty'][$i-1] 
                                                        }}
                                                    </p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="badge bg-primary">
                                                            <i class="fas fa-clock me-1"></i>
                                                            {{ rand(2, 8) }}h drive
                                                        </span>
                                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                                            Explore
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>

                            <!-- Other Nearby Areas List -->
                            <h5 class="mb-3">More Nearby Destinations</h5>
                            <div class="row">
                                @for($i = 1; $i <= 6; $i++)
                                    <div class="col-md-4 mb-3">
                                        <div class="d-flex align-items-center p-3 border rounded">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-{{ 
                                                    ['mountain', 'tree', 'water', 'umbrella-beach', 'city', 'monument'][$i-1] 
                                                }} text-primary fa-2x me-3"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ 
                                                    ['Haflong Hills', 'Manas National Park',
                                                     'Brahmaputra Beach', 'Goalpara',
                                                     'Dispur', 'Sualkuchi'][$i-1] 
                                                }}</h6>
                                                <p class="text-muted small mb-0">
                                                    {{ rand(50, 150) }} km • {{ 
                                                        ['Hill station', 'Wildlife sanctuary',
                                                         'River beach', 'Historical town',
                                                         'State capital', 'Silk village'][$i-1] 
                                                    }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Photo Gallery Section -->
                <section id="gallery" class="mb-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="mb-4">
                                <i class="fas fa-images text-primary me-2"></i>Photo Gallery
                            </h2>
                            <p class="text-muted mb-4">Visual journey through Guwahati</p>

                            <!-- Gallery Grid -->
                            <div class="row g-3">
                                @for($i = 1; $i <= 9; $i++)
                                    <div class="col-md-4 col-sm-6">
                                        <div class="gallery-item position-relative overflow-hidden rounded">
                                            <img src="https://images.unsplash.com/photo-{{ 
                                                ['1552733407-5d5c46c3bb3b', '1520250497591-112f2f40a3f4',
                                                 '1519681393784-d120267933ba', '1516483638261-f4dbaf036963',
                                                 '1539635278303-d4002c07eae3', '1544551763-46a013bb70d5',
                                                 '1506905925346-21bda4d32df4', '1533105079780-92b9be482077',
                                                 '1519925610903-0cad6a038a4c'][$i-1] 
                                            }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                                                 class="img-fluid w-100" 
                                                 style="height: 200px; object-fit: cover;"
                                                 alt="Gallery Image {{ $i }}">
                                            <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 opacity-0 transition-all">
                                                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#galleryModal">
                                                    <i class="fas fa-expand"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>

                            <!-- View More Gallery Button -->
                            <div class="text-center mt-4">
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-camera me-2"></i>View More Photos
                                </button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Travel Tips Section -->
                <section id="travel-tips">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="mb-4">
                                <i class="fas fa-lightbulb text-primary me-2"></i>Travel Tips & Information
                            </h2>

                            <!-- Accordion for Travel Tips -->
                            <div class="accordion" id="travelTipsAccordion">
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="accordion-item mb-3 border rounded">
                                        <h3 class="accordion-header">
                                            <button class="accordion-button {{ $i == 1 ? '' : 'collapsed' }}" 
                                                    type="button" 
                                                    data-bs-toggle="collapse" 
                                                    data-bs-target="#tip{{ $i }}">
                                                <i class="fas fa-{{ 
                                                    ['suitcase', 'utensils', 'bus', 'money-bill-wave', 'user-shield'][$i-1] 
                                                }} text-primary me-3"></i>
                                                {{ 
                                                    ['Best Time to Visit', 'Local Food to Try',
                                                     'Transportation Guide', 'Budget Planning',
                                                     'Safety Tips'][$i-1] 
                                                }}
                                            </button>
                                        </h3>
                                        <div id="tip{{ $i }}" 
                                             class="accordion-collapse collapse {{ $i == 1 ? 'show' : '' }}" 
                                             data-bs-parent="#travelTipsAccordion">
                                            <div class="accordion-body">
                                                <p>{{ 
                                                    ['October to March offers pleasant weather with temperatures between 10°C to 25°C. Monsoons (June-September) bring heavy rainfall but lush greenery.',
                                                     'Must-try dishes: Assamese Thali, Fish Tenga, Duck Roast, Pitha (rice cakes), and Assam Tea. Don\'t miss local markets for authentic flavors.',
                                                     'Autorickshaws and taxis are readily available. Use app-based cabs for better rates. Public buses connect major areas. Ferry services for river crossings.',
                                                     'Budget travelers: ₹800-1500/day. Mid-range: ₹2000-4000/day. Luxury: ₹5000+/day. Include accommodation, food, transport, and sightseeing costs.',
                                                     'Guwahati is generally safe. Avoid isolated areas at night. Keep valuables secure. Drink bottled water. Respect local customs and temple rules.'][$i-1] 
                                                }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>

                            <!-- Quick Facts -->
                            <div class="mt-5">
                                <h5 class="mb-3">
                                    <i class="fas fa-clipboard-list text-primary me-2"></i>Quick Facts
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <i class="fas fa-language text-primary me-2"></i>
                                                <strong>Language:</strong> Assamese, Hindi, English
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-money-bill-wave text-primary me-2"></i>
                                                <strong>Currency:</strong> Indian Rupee (₹)
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-plug text-primary me-2"></i>
                                                <strong>Voltage:</strong> 230V, 50Hz
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li class="mb-2">
                                                <i class="fas fa-clock text-primary me-2"></i>
                                                <strong>Time Zone:</strong> IST (UTC+5:30)
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-phone text-primary me-2"></i>
                                                <strong>Emergency:</strong> 112, 108
                                            </li>
                                            <li class="mb-2">
                                                <i class="fas fa-cloud-sun text-primary me-2"></i>
                                                <strong>Climate:</strong> Tropical Monsoon
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Gallery Modal -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Photo Gallery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Slick Slider for Gallery Modal -->
                    <div class="slick-slider gallery-modal-slider">
                        @for($i = 1; $i <= 9; $i++)
                            <div>
                                <img src="https://images.unsplash.com/photo-{{ 
                                    ['1552733407-5d5c46c3bb3b', '1520250497591-112f2f40a3f4',
                                     '1519681393784-d120267933ba', '1516483638261-f4dbaf036963',
                                     '1539635278303-d4002c07eae3', '1544551763-46a013bb70d5',
                                     '1506905925346-21bda4d32df4', '1533105079780-92b9be482077',
                                     '1519925610903-0cad6a038a4c'][$i-1] 
                                }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                                     class="img-fluid rounded" 
                                     alt="Gallery Image {{ $i }}">
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Initialize sliders on single page
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Owl Carousel for Attractions
        if ($.fn.owlCarousel) {
            $('.attractions-carousel').owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                dots: false,
                responsive: {
                    0: { items: 1 },
                    600: { items: 2 },
                    1000: { items: 3 }
                }
            });
        }
        
        // Initialize Swiper for Nearby Areas
        if (typeof Swiper !== 'undefined') {
            new Swiper('.areas-swiper', {
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
        
        // Initialize Slick Slider for Gallery Modal
        if ($.fn.slick) {
            $('.gallery-modal-slider').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                adaptiveHeight: true,
                arrows: true,
                prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>'
            });
        }
        
        // Gallery Item Hover Effect
        $('.gallery-item').hover(
            function() {
                $(this).find('.gallery-overlay').removeClass('opacity-0').addClass('opacity-100');
            },
            function() {
                $(this).find('.gallery-overlay').removeClass('opacity-100').addClass('opacity-0');
            }
        );
        
        // Smooth scroll for table of contents links
        $('a[href^="#"]').on('click', function(e) {
            if (this.hash !== "") {
                e.preventDefault();
                const hash = this.hash;
                $('html, body').animate({
                    scrollTop: $(hash).offset().top - 100
                }, 800);
            }
        });
        
        // Active state for table of contents links
        $(window).on('scroll', function() {
            const sections = $('section[id]');
            const scrollPosition = $(window).scrollTop() + 150;
            
            sections.each(function() {
                const sectionTop = $(this).offset().top;
                const sectionBottom = sectionTop + $(this).outerHeight();
                const sectionId = $(this).attr('id');
                
                if (scrollPosition >= sectionTop && scrollPosition <= sectionBottom) {
                    $('.list-group-item').removeClass('active');
                    $('a[href="#' + sectionId + '"]').addClass('active');
                }
            });
        });
    });
    
    // Hotel filter functionality
    document.querySelectorAll('.btn-outline-primary').forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            document.querySelectorAll('.btn-outline-primary').forEach(btn => {
                btn.classList.remove('active');
            });
            // Add active class to clicked button
            this.classList.add('active');
            
            // In real implementation, filter hotels based on selection
            // This is just UI demonstration
        });
    });
    
    // Load More Hotels
    document.querySelectorAll('.btn-outline-primary').forEach(btn => {
        if (btn.textContent.includes('Load More Hotels')) {
            btn.addEventListener('click', function() {
                const button = this;
                button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
                button.disabled = true;
                
                // Simulate API call
                setTimeout(() => {
                    // Add more hotel cards
                    const hotelsContainer = document.querySelector('.row').parentNode;
                    // In real implementation, this would add more hotel data
                    
                    button.innerHTML = '<i class="fas fa-plus me-2"></i>Load More Hotels';
                    button.disabled = false;
                    alert('More hotels loaded! (This is a demo)');
                }, 1000);
            });
        }
    });
</script>
@endsection

<style>
    /* Destination Hero */
    .destination-hero .hero-image {
        position: relative;
    }
    
    .destination-hero .breadcrumb {
        background: transparent;
    }
    
    .destination-hero .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255,255,255,0.7);
    }
    
    /* Sticky Sidebar */
    .sticky-top {
        position: -webkit-sticky;
        position: sticky;
        z-index: 100;
    }
    
    /* Table of Contents */
    .list-group-item {
        padding: 12px 20px;
        border-left: 3px solid transparent;
        transition: all 0.3s ease;
    }
    
    .list-group-item:hover,
    .list-group-item.active {
        background-color: rgba(52, 152, 219, 0.1);
        border-left-color: #3498db;
        padding-left: 25px;
    }
    
    /* Cards */
    .attraction-card, .area-card {
        transition: transform 0.3s ease;
        height: 100%;
    }
    
    .attraction-card:hover, .area-card:hover {
        transform: translateY(-5px);
    }
    
    .hotel-listing-card {
        transition: box-shadow 0.3s ease;
    }
    
    .hotel-listing-card:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    
    /* Gallery */
    .gallery-item {
        cursor: pointer;
    }
    
    .gallery-overlay {
        transition: opacity 0.3s ease;
    }
    
    .gallery-item:hover .gallery-overlay {
        opacity: 1 !important;
    }
    
    /* Accordion */
    .accordion-button:not(.collapsed) {
        background-color: rgba(52, 152, 219, 0.1);
        color: #2c3e50;
    }
    
    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(52, 152, 219, 0.25);
    }
    
    /* Swiper Customization */
    .areas-swiper {
        padding: 30px 0 50px !important;
    }
    
    .swiper-slide {
        height: auto;
    }
    
    /* Responsive */
    @media (max-width: 992px) {
        .sticky-top {
            position: static;
        }
    }
    
    @media (max-width: 768px) {
        .destination-hero .hero-image {
            height: 400px;
        }
        
        .hotel-listing-card .row {
            flex-direction: column;
        }
        
        .hotel-listing-card .col-md-5 {
            width: 100%;
            height: 200px;
        }
    }
</style>