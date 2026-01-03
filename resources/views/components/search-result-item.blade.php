{{-- Individual Search Result Item Component --}}
<div class="col-12 mb-4">
    <div class="card result-card border-0 shadow-sm h-100">
        <div class="row g-0">
            <!-- Result Image -->
            <div class="col-md-4">
                <img src="{{ $result['image'] ?? 'https://images.unsplash.com/photo-1552733407-5d5c46c3bb3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' }}" 
                     class="img-fluid rounded-start h-100" 
                     style="object-fit: cover; min-height: 250px;"
                     alt="{{ $result['title'] ?? 'Travel Destination' }}">
            </div>
            
            <!-- Result Details -->
            <div class="col-md-8">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title mb-1">{{ $result['title'] ?? 'Destination' }}</h5>
                            <p class="text-muted small mb-2">
                                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                {{ $result['location'] ?? 'Location not specified' }}
                            </p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-warning text-dark mb-2">
                                {{ $result['rating'] ?? '4.0' }} <i class="fas fa-star"></i>
                            </span>
                            <h4 class="text-primary mb-0">₹{{ $result['price'] ?? '0' }}</h4>
                            <small class="text-muted">
                                @if(isset($result['type']) && $result['type'] == 'hotel')
                                    per night
                                @elseif(isset($result['type']) && $result['type'] == 'package')
                                    per package
                                @else
                                    starting from
                                @endif
                            </small>
                        </div>
                    </div>
                    
                    <p class="card-text mt-3">{{ $result['description'] ?? 'No description available.' }}</p>
                    
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="amenities">
                            @if(isset($result['amenities']) && is_array($result['amenities']))
                                @foreach($result['amenities'] as $amenity)
                                    <span class="badge bg-light text-dark me-1 mb-1">
                                        <i class="fas fa-{{ $amenity['icon'] ?? 'check' }} me-1"></i>
                                        {{ $amenity['name'] ?? 'Amenity' }}
                                    </span>
                                @endforeach
                            @else
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-check me-1"></i>Basic Amenities
                                </span>
                            @endif
                        </div>
                        <a href="{{ $result['url'] ?? '#' }}" class="btn btn-primary">
                            <i class="fas fa-eye me-1"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>