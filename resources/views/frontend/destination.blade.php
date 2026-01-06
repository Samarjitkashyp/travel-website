@extends('layouts.app')

@section('title', $destination->hero_title ?? $destination->name . ' - Travel Explorer')

@section('content')
    <!-- Destination Hero Section -->
    <section class="destination-hero">
        <div class="hero-image" style="
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), 
                        url('{{ $destination->hero_image ? asset('storage/' . $destination->hero_image) : 'https://images.unsplash.com/photo-1552733407-5d5c46c3bb3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80' }}');
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
                                <li class="breadcrumb-item active text-white" aria-current="page">{{ $destination->name }}</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInUp">
                            {{ $destination->hero_title ?? $destination->name }}
                        </h1>
                        @if($destination->hero_subtitle)
                        <p class="lead mb-3 animate__animated animate__fadeInUp">{{ $destination->hero_subtitle }}</p>
                        @endif
                        <div class="d-flex flex-wrap gap-3 animate__animated animate__fadeInUp animate__delay-1s">
                            <span class="badge bg-primary fs-6 p-2">
                                <i class="fas fa-map-marker-alt me-2"></i>{{ $destination->location }}, {{ $destination->state }}
                            </span>
                            <span class="badge bg-success fs-6 p-2">
                                <i class="fas fa-star me-2"></i>{{ $destination->rating ?? '4.5' }}/5 Rating
                            </span>
                            <span class="badge bg-info fs-6 p-2">
                                <i class="fas fa-rupee-sign me-2"></i>₹{{ number_format($destination->price) }}
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
                                        <p class="mb-0 fw-bold">{{ $destination->best_time ?? 'Oct - Mar' }}</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <small class="text-light">Ideal Duration</small>
                                        <p class="mb-0 fw-bold">{{ $destination->ideal_duration ?? '3-5 Days' }}</p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-light">Avg. Cost</small>
                                        <p class="mb-0 fw-bold">₹{{ number_format($destination->price) }}</p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-light">Type</small>
                                        <p class="mb-0 fw-bold">{{ $destination->type ?? 'City, Cultural' }}</p>
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
                                @if(!empty($destination->attractions_details))
                                <a href="#attractions" class="list-group-item list-group-item-action border-0">
                                    <i class="fas fa-camera me-2 text-primary"></i>Top Attractions
                                </a>
                                @endif
                                @if(!empty($destination->hotels_data))
                                <a href="#hotels" class="list-group-item list-group-item-action border-0">
                                    <i class="fas fa-hotel me-2 text-primary"></i>Nearby Hotels
                                </a>
                                @endif
                                @if(!empty($destination->nearby_areas_detailed))
                                <a href="#areas" class="list-group-item list-group-item-action border-0">
                                    <i class="fas fa-map-marked-alt me-2 text-primary"></i>Nearby Areas
                                </a>
                                @endif
                                @if(!empty($destination->gallery_images))
                                <a href="#gallery" class="list-group-item list-group-item-action border-0">
                                    <i class="fas fa-images me-2 text-primary"></i>Photo Gallery
                                </a>
                                @endif
                                @if(!empty($destination->travel_tips_faq) || !empty($destination->quick_facts))
                                <a href="#travel-tips" class="list-group-item list-group-item-action border-0">
                                    <i class="fas fa-lightbulb me-2 text-primary"></i>Travel Tips
                                </a>
                                @endif
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
                            
                            <!-- Dynamic Key Highlights -->
                            @if(!empty($destination->key_highlights))
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h5 class="text-primary mb-3">
                                        <i class="fas fa-check-circle me-2"></i>Key Highlights
                                    </h5>
                                    <ul class="list-unstyled">
                                        @foreach($destination->key_highlights as $highlight)
                                        <li class="mb-2">
                                            <i class="fas fa-chevron-right text-primary me-2"></i>
                                            {{ $highlight }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                
                                <!-- Dynamic Best For Tags -->
                                @if(!empty($destination->best_for_tags))
                                <div class="col-md-6">
                                    <h5 class="text-primary mb-3">
                                        <i class="fas fa-map-signs me-2"></i>Best For
                                    </h5>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($destination->best_for_tags as $tag)
                                        <span class="badge bg-light text-dark p-2">
                                            @switch($tag)
                                                @case('Pilgrimage')
                                                    <i class="fas fa-pray me-1"></i>
                                                    @break
                                                @case('Photography')
                                                    <i class="fas fa-camera me-1"></i>
                                                    @break
                                                @case('Food Tours')
                                                    <i class="fas fa-utensils me-1"></i>
                                                    @break
                                                @case('Shopping')
                                                    <i class="fas fa-shopping-bag me-1"></i>
                                                    @break
                                                @case('Nature Walks')
                                                    <i class="fas fa-leaf me-1"></i>
                                                    @break
                                                @case('River Activities')
                                                    <i class="fas fa-water me-1"></i>
                                                    @break
                                                @default
                                                    <i class="fas fa-check me-1"></i>
                                            @endswitch
                                            {{ $tag }}
                                        </span>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </section>

                <!-- Top Attractions Section -->
                @if(!empty($destination->attractions_details))
                <section id="attractions" class="mb-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="mb-4">
                                <i class="fas fa-camera text-primary me-2"></i>Top Attractions
                            </h2>
                            <p class="text-muted mb-4">Explore the must-visit places in and around {{ $destination->name }}</p>

                            <!-- Dynamic Attractions Carousel -->
                            <div class="owl-carousel attractions-carousel">
                                @foreach($destination->attractions_details as $attraction)
                                <div class="item">
                                    <div class="card attraction-card border-0 h-100">
                                        <img src="{{ $attraction['image'] }}" 
                                             class="card-img-top" 
                                             alt="{{ $attraction['name'] }}"
                                             onerror="this.src='https://images.unsplash.com/photo-1552733407-5d5c46c3bb3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $attraction['name'] }}</h5>
                                            <p class="card-text text-muted small">
                                                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                                {{ $attraction['location'] }}
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge bg-primary">
                                                    <i class="fas fa-star me-1"></i>{{ $attraction['rating'] }}
                                                </span>
                                                <a href="#" class="btn btn-sm btn-outline-primary">
                                                    {{ $attraction['button_text'] ?? 'View Details' }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Dynamic Other Popular Places -->
                            @if(!empty($destination->popular_places))
                            <div class="mt-5">
                                <h5 class="mb-3">Other Popular Places</h5>
                                <div class="row">
                                    @foreach($destination->popular_places as $place)
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-start p-3 border rounded">
                                            <div class="flex-shrink-0">
                                                <i class="{{ $place['icon'] ?? 'fas fa-map-pin' }} text-primary fa-2x me-3"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ $place['name'] }}</h6>
                                                <p class="text-muted small mb-0">
                                                    {{ $place['description'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </section>
                @endif

                <!-- Nearby Hotels Section -->
                @if(!empty($destination->hotels_data))
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
                            <p class="text-muted mb-4">Find the perfect accommodation for your stay in {{ $destination->name }}</p>

                            <!-- Dynamic Hotels List -->
                            <div class="row">
                                @foreach($destination->hotels_data as $hotel)
                                <div class="col-lg-6 mb-4">
                                    <div class="card hotel-listing-card border-0 shadow-sm h-100">
                                        <div class="row g-0 h-100">
                                            <div class="col-md-5">
                                                <img src="{{ $hotel['image'] }}" 
                                                     class="img-fluid rounded-start h-100" 
                                                     style="object-fit: cover;"
                                                     alt="{{ $hotel['name'] }}"
                                                     onerror="this.src='https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'">
                                            </div>
                                            <div class="col-md-7">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                                        <h5 class="card-title mb-0">{{ $hotel['name'] }}</h5>
                                                        <span class="badge bg-warning text-dark">
                                                            {{ $hotel['rating'] }}<i class="fas fa-star ms-1"></i>
                                                        </span>
                                                    </div>
                                                    <p class="text-muted small mb-2">
                                                        <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                                        {{ $hotel['location'] }}
                                                    </p>
                                                    <div class="mb-3">
                                                        @foreach($hotel['features'] as $feature)
                                                        <span class="badge bg-light text-dark me-1 mb-1">
                                                            {{ $feature }}
                                                        </span>
                                                        @endforeach
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <span class="h5 text-primary mb-0">₹{{ number_format($hotel['price']) }}</span>
                                                            <small class="text-muted d-block">per night</small>
                                                        </div>
                                                        <div class="text-end">
                                                            @if($hotel['recommendation'] > 0)
                                                            <small class="text-success d-block">
                                                                <i class="fas fa-check-circle me-1"></i>
                                                                {{ $hotel['recommendation'] }}% Recommended
                                                            </small>
                                                            @endif
                                                            <button class="btn btn-primary btn-sm mt-1">
                                                                <i class="fas fa-eye me-1"></i> {{ $hotel['button_text'] ?? 'View Details' }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
                @endif

                <!-- Nearby Areas Section -->
                @if(!empty($destination->nearby_areas_detailed))
                <section id="areas" class="mb-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="mb-4">
                                <i class="fas fa-map-marked-alt text-primary me-2"></i>Nearby Areas & Places to Explore
                            </h2>
                            <p class="text-muted mb-4">Discover interesting places around {{ $destination->name }}</p>

                            <!-- Dynamic Nearby Areas Swiper -->
                            <div class="swiper areas-swiper mb-5">
                                <div class="swiper-wrapper">
                                    @foreach($destination->nearby_areas_detailed as $area)
                                    <div class="swiper-slide">
                                        <div class="card area-card border-0 h-100">
                                            <img src="{{ $area['image'] }}" 
                                                 class="card-img-top" 
                                                 alt="{{ $area['name'] }}"
                                                 onerror="this.src='https://images.unsplash.com/photo-1552733407-5d5c46c3bb3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $area['name'] }}</h5>
                                                <p class="text-muted small">
                                                    <i class="fas fa-road me-1"></i>
                                                    {{ $area['distance'] }}
                                                </p>
                                                <p class="card-text">{{ $area['description'] }}</p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    @if($area['drive_time'])
                                                    <span class="badge bg-primary">
                                                        <i class="fas fa-clock me-1"></i>
                                                        {{ $area['drive_time'] }}
                                                    </span>
                                                    @endif
                                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                                        {{ $area['button_text'] ?? 'Explore' }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>

                            <!-- Dynamic More Nearby Destinations -->
                            @if(!empty($destination->more_nearby_destinations))
                            <h5 class="mb-3">More Nearby Destinations</h5>
                            <div class="row">
                                @foreach($destination->more_nearby_destinations as $dest)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex align-items-center p-3 border rounded">
                                        <div class="flex-shrink-0">
                                            <i class="{{ $dest['icon'] ?? 'fas fa-location-dot' }} text-primary fa-2x me-3"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $dest['name'] }}</h6>
                                            <p class="text-muted small mb-0">
                                                {{ $dest['distance'] }} • {{ $dest['category'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </section>
                @endif

                <!-- Photo Gallery Section -->
                @if(!empty($destination->gallery_images))
                <section id="gallery" class="mb-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="mb-4">
                                <i class="fas fa-images text-primary me-2"></i>Photo Gallery
                            </h2>
                            <p class="text-muted mb-4">Visual journey through {{ $destination->name }}</p>

                            <!-- Dynamic Gallery Grid -->
                            <div class="row g-3">
                                @foreach($destination->gallery_images as $index => $image)
                                <div class="col-md-4 col-sm-6">
                                    <div class="gallery-item position-relative overflow-hidden rounded">
                                        <img src="{{ $image['url'] }}" 
                                             class="img-fluid w-100" 
                                             style="height: 200px; object-fit: cover;"
                                             alt="{{ $image['alt'] ?? 'Gallery Image' }}"
                                             onerror="this.src='https://images.unsplash.com/photo-1552733407-5d5c46c3bb3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'">
                                        <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 opacity-0 transition-all">
                                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#galleryModal" data-index="{{ $index }}">
                                                <i class="fas fa-expand"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Gallery Modal -->
                <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $destination->name }} Photo Gallery</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="slick-slider gallery-modal-slider">
                                    @foreach($destination->gallery_images as $image)
                                    <div>
                                        <img src="{{ $image['url'] }}" 
                                             class="img-fluid rounded" 
                                             alt="{{ $image['alt'] ?? 'Gallery Image' }}"
                                             onerror="this.src='https://images.unsplash.com/photo-1552733407-5d5c46c3bb3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Travel Tips Section -->
                @if(!empty($destination->travel_tips_faq) || !empty($destination->quick_facts))
                <section id="travel-tips">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h2 class="mb-4">
                                <i class="fas fa-lightbulb text-primary me-2"></i>Travel Tips & Information
                            </h2>

                            <!-- Dynamic Travel Tips Accordion -->
                            @if(!empty($destination->travel_tips_faq))
                            <div class="accordion" id="travelTipsAccordion">
                                @foreach($destination->travel_tips_faq as $index => $tip)
                                <div class="accordion-item mb-3 border rounded">
                                    <h3 class="accordion-header">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" 
                                                type="button" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#tip{{ $index }}">
                                            <i class="{{ $tip['icon'] ?? 'fas fa-info-circle' }} text-primary me-3"></i>
                                            {{ $tip['title'] }}
                                        </button>
                                    </h3>
                                    <div id="tip{{ $index }}" 
                                         class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" 
                                         data-bs-parent="#travelTipsAccordion">
                                        <div class="accordion-body">
                                            <p>{{ $tip['content'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endif

                            <!-- Dynamic Quick Facts -->
                            @if(!empty($destination->quick_facts))
                            <div class="mt-5">
                                <h5 class="mb-3">
                                    <i class="fas fa-clipboard-list text-primary me-2"></i>Quick Facts
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            @if(isset($destination->quick_facts['language']))
                                            <li class="mb-2">
                                                <i class="fas fa-language text-primary me-2"></i>
                                                <strong>Language:</strong> {{ $destination->quick_facts['language'] }}
                                            </li>
                                            @endif
                                            @if(isset($destination->quick_facts['currency']))
                                            <li class="mb-2">
                                                <i class="fas fa-money-bill-wave text-primary me-2"></i>
                                                <strong>Currency:</strong> {{ $destination->quick_facts['currency'] }}
                                            </li>
                                            @endif
                                            @if(isset($destination->quick_facts['voltage']))
                                            <li class="mb-2">
                                                <i class="fas fa-plug text-primary me-2"></i>
                                                <strong>Voltage:</strong> {{ $destination->quick_facts['voltage'] }}
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            @if(isset($destination->quick_facts['time_zone']))
                                            <li class="mb-2">
                                                <i class="fas fa-clock text-primary me-2"></i>
                                                <strong>Time Zone:</strong> {{ $destination->quick_facts['time_zone'] }}
                                            </li>
                                            @endif
                                            @if(isset($destination->quick_facts['emergency']))
                                            <li class="mb-2">
                                                <i class="fas fa-phone text-primary me-2"></i>
                                                <strong>Emergency:</strong> {{ $destination->quick_facts['emergency'] }}
                                            </li>
                                            @endif
                                            @if(isset($destination->quick_facts['climate']))
                                            <li class="mb-2">
                                                <i class="fas fa-cloud-sun text-primary me-2"></i>
                                                <strong>Climate:</strong> {{ $destination->quick_facts['climate'] }}
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </section>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Initialize sliders on single page
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Owl Carousel for Attractions
        if ($.fn.owlCarousel && $('.attractions-carousel').length > 0) {
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
        if (typeof Swiper !== 'undefined' && $('.areas-swiper').length > 0) {
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
        if ($.fn.slick && $('.gallery-modal-slider').length > 0) {
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
        
        // Gallery modal click handler
        $('[data-bs-target="#galleryModal"]').on('click', function() {
            const index = $(this).data('index');
            if (index !== undefined && $('.gallery-modal-slider').hasClass('slick-initialized')) {
                $('.gallery-modal-slider').slick('slickGoTo', index);
            }
        });
    });
    
    // Hotel filter functionality
    document.querySelectorAll('.btn-outline-primary').forEach(button => {
        if (button.closest('#hotels')) {
            button.addEventListener('click', function() {
                // Remove active class from all buttons in hotels section
                document.querySelectorAll('#hotels .btn-outline-primary').forEach(btn => {
                    btn.classList.remove('active');
                });
                // Add active class to clicked button
                this.classList.add('active');
                
                // In real implementation, filter hotels based on selection
                // This is just UI demonstration
            });
        }
    });
</script>

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
@endsection