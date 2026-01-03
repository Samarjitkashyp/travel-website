@extends('layouts.app')

@section('title', 'Hotel Details - Travel Explorer')

@section('content')
    <!-- Hotel Hero Section -->
    <section class="hotel-hero-section" style="
        padding-top: 120px;
        padding-bottom: 60px;
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                    url('{{ asset('images/hotels/hotels-2.jpg') }}') center/cover no-repeat;
        min-height: 60vh;
        display: flex;
        align-items: center;
    ">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="text-white">
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent p-0 mb-3">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></li>
                                <li class="breadcrumb-item"><a href="#hotels" class="text-white text-decoration-none">Hotels</a></li>
                                <li class="breadcrumb-item active text-white" aria-current="page">Hotel Details</li>
                            </ol>
                        </nav>
                        
                        <!-- Hotel Title and Rating -->
                        <h1 class="display-5 fw-bold mb-3">Taj Hotel, Guwahati</h1>
                        <div class="d-flex align-items-center mb-4">
                            <div class="text-warning me-3">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            <span class="text-white me-3">4.8/5 (420 reviews)</span>
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i>Verified
                            </span>
                        </div>
                        
                        <!-- Location -->
                        <div class="d-flex align-items-center mb-4">
                            <i class="fas fa-map-marker-alt fa-lg me-3"></i>
                            <div>
                                <h5 class="mb-1">Near Kamakhya Temple, Guwahati, Assam</h5>
                                <p class="mb-0 text-light">5 km from city center • View on map</p>
                            </div>
                        </div>
                        
                        <!-- Quick Info -->
                        <div class="row g-4">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <i class="fas fa-wifi fa-2x mb-2"></i>
                                    <h6 class="mb-1">Free WiFi</h6>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <i class="fas fa-swimming-pool fa-2x mb-2"></i>
                                    <h6 class="mb-1">Swimming Pool</h6>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <i class="fas fa-utensils fa-2x mb-2"></i>
                                    <h6 class="mb-1">Restaurant</h6>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <i class="fas fa-spa fa-2x mb-2"></i>
                                    <h6 class="mb-1">Spa & Wellness</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Price Box -->
                    <div class="card border-0 shadow-lg animate__animated animate__fadeInUp">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h3 class="text-primary">₹5,200</h3>
                                <p class="text-muted mb-1">per night (inclusive of taxes)</p>
                                <p class="text-success mb-0">
                                    <i class="fas fa-check-circle me-1"></i>Free cancellation available
                                </p>
                            </div>
                            
                            <!-- Booking Form -->
                            <form id="hotelBookingForm">
                                <div class="mb-3">
                                    <label for="checkin" class="form-label">Check-in Date</label>
                                    <input type="date" class="form-control" id="checkin" required>
                                </div>
                                <div class="mb-3">
                                    <label for="checkout" class="form-label">Check-out Date</label>
                                    <input type="date" class="form-control" id="checkout" required>
                                </div>
                                <div class="mb-3">
                                    <label for="guests" class="form-label">Guests</label>
                                    <select class="form-select" id="guests" required>
                                        <option value="1">1 Guest</option>
                                        <option value="2" selected>2 Guests</option>
                                        <option value="3">3 Guests</option>
                                        <option value="4">4 Guests</option>
                                        <option value="5">5+ Guests</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="rooms" class="form-label">Rooms</label>
                                    <select class="form-select" id="rooms" required>
                                        <option value="1" selected>1 Room</option>
                                        <option value="2">2 Rooms</option>
                                        <option value="3">3 Rooms</option>
                                        <option value="4">4 Rooms</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-calendar-check me-2"></i>Book Now
                                </button>
                                <p class="text-center text-muted small mt-2 mb-0">
                                    <i class="fas fa-lock me-1"></i>Secure booking • Best price guaranteed
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hotel Gallery -->
    <section class="section-padding">
        <div class="container">
            <div class="section-title">
                <h2>Hotel Gallery</h2>
                <p>Explore our luxurious facilities and rooms</p>
            </div>
            
            <!-- Image Gallery Grid -->
            <div class="row g-3">
                <div class="col-lg-8">
                    <div class="hotel-main-image">
                        <img src="{{ asset('images/hotels/hotels-2.jpg') }}" 
                             class="img-fluid rounded shadow-lg w-100" 
                             alt="Taj Hotel Main View"
                             style="height: 400px; object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <img src="{{ asset('images/hotels/hotels-2.jpg') }}" 
                                 class="img-fluid rounded shadow-sm w-100" 
                                 alt="Hotel Room"
                                 style="height: 190px; object-fit: cover;">
                        </div>
                        <div class="col-12">
                            <img src="{{ asset('images/hotels/hotels-2.jpg') }}" 
                                 class="img-fluid rounded shadow-sm w-100" 
                                 alt="Hotel Pool"
                                 style="height: 190px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hotel Details -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="row">
                <!-- Description -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h3 class="fw-bold mb-4">About Taj Hotel, Guwahati</h3>
                            <p class="mb-4">
                                Experience luxury and comfort at Taj Hotel, located near the famous Kamakhya Temple in Guwahati. 
                                Our 5-star hotel offers world-class amenities, spacious rooms with modern facilities, and 
                                exceptional service to make your stay memorable.
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="fw-bold mb-3">Hotel Features</h5>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            24-hour front desk and concierge
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Free high-speed WiFi throughout
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Outdoor swimming pool
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Fitness center and spa
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Multiple dining options
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="fw-bold mb-3">Room Amenities</h5>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Air conditioning and heating
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Minibar and tea/coffee maker
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Flat-screen TV with cable channels
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Safe deposit box
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Private bathroom with toiletries
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Reviews -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h3 class="fw-bold mb-4">Guest Reviews</h3>
                            <div class="row">
                                <div class="col-md-4 text-center mb-4">
                                    <div class="display-4 fw-bold text-primary">4.8</div>
                                    <div class="text-warning mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                    </div>
                                    <p class="text-muted">Based on 420 reviews</p>
                                </div>
                                <div class="col-md-8">
                                    <!-- Review 1 -->
                                    <div class="mb-4 pb-3 border-bottom">
                                        <div class="d-flex justify-content-between mb-2">
                                            <h6 class="fw-bold mb-0">Rajesh Kumar</h6>
                                            <small class="text-muted">2 days ago</small>
                                        </div>
                                        <div class="text-warning mb-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                        </div>
                                        <p class="mb-0">
                                            "Excellent service and luxurious rooms. The staff was very helpful and 
                                            the location is perfect for visiting Kamakhya Temple."
                                        </p>
                                    </div>
                                    <!-- Review 2 -->
                                    <div class="mb-4 pb-3 border-bottom">
                                        <div class="d-flex justify-content-between mb-2">
                                            <h6 class="fw-bold mb-0">Priya Sharma</h6>
                                            <small class="text-muted">1 week ago</small>
                                        </div>
                                        <div class="text-warning mb-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                        </div>
                                        <p class="mb-0">
                                            "Beautiful hotel with amazing amenities. The pool area is fantastic and 
                                            the food at the restaurant was delicious. Highly recommended!"
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Location Map -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">
                                <i class="fas fa-map-marked-alt text-primary me-2"></i>
                                Location
                            </h5>
                            <div class="hotel-map-placeholder bg-light rounded mb-3" 
                                 style="height: 200px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-map fa-3x text-muted"></i>
                            </div>
                            <p class="mb-2">
                                <i class="fas fa-location-arrow text-danger me-2"></i>
                                Near Kamakhya Temple, Guwahati, Assam
                            </p>
                            <p class="mb-3">
                                <i class="fas fa-road text-info me-2"></i>
                                5 km from city center • 15 km from airport
                            </p>
                            <button class="btn btn-outline-primary w-100">
                                <i class="fas fa-directions me-2"></i>Get Directions
                            </button>
                        </div>
                    </div>
                    
                    <!-- Nearby Attractions -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">
                                <i class="fas fa-landmark text-primary me-2"></i>
                                Nearby Attractions
                            </h5>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="fas fa-temple text-warning fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Kamakhya Temple</h6>
                                            <p class="text-muted small mb-0">1.5 km • 5 min drive</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="fas fa-water text-info fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Brahmaputra River</h6>
                                            <p class="text-muted small mb-0">3 km • 10 min drive</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-3">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="fas fa-shopping-bag text-success fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Fancy Bazaar</h6>
                                            <p class="text-muted small mb-0">4 km • 15 min drive</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <i class="fas fa-paw text-danger fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Guwahati Zoo</h6>
                                            <p class="text-muted small mb-0">6 km • 20 min drive</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Contact Info -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">
                                <i class="fas fa-phone-alt text-primary me-2"></i>
                                Contact Information
                            </h5>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <i class="fas fa-phone text-success me-2"></i>
                                    <strong>Phone:</strong> +91 98765 43210
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-envelope text-primary me-2"></i>
                                    <strong>Email:</strong> info@tajhotelguwahati.com
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-globe text-info me-2"></i>
                                    <strong>Website:</strong> www.tajhotelguwahati.com
                                </li>
                                <li>
                                    <i class="fas fa-clock text-warning me-2"></i>
                                    <strong>Check-in:</strong> 2:00 PM • <strong>Check-out:</strong> 12:00 PM
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Similar Hotels -->
    <section class="section-padding">
        <div class="container">
            <div class="section-title">
                <h2>Similar Hotels</h2>
                <p>You might also like these hotels</p>
            </div>
            
            <div class="row">
                <!-- Similar Hotel 1 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card hotel-card border-0 shadow-sm">
                        <img src="{{ asset('images/hotels/hotels-2.jpg') }}" 
                             class="card-img-top hotel-image" 
                             alt="Goa Marriott Resort">
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
                            <div class="mb-3">
                                <span class="badge bg-light text-dark me-1 mb-1">Beach View</span>
                                <span class="badge bg-light text-dark me-1 mb-1">All Inclusive</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 text-primary mb-0">₹7,800/night</span>
                                <a href="{{ url('/hotel/goa-marriott') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-bookmark me-1"></i>Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Similar Hotel 2 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card hotel-card border-0 shadow-sm">
                        <img src="{{ asset('images/hotels/hotels-2.jpg') }}" 
                             class="card-img-top hotel-image" 
                             alt="Tea Country Resort">
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
                            <div class="mb-3">
                                <span class="badge bg-light text-dark me-1 mb-1">Mountain View</span>
                                <span class="badge bg-light text-dark me-1 mb-1">Tea Plantation</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 text-primary mb-0">₹4,500/night</span>
                                <a href="{{ url('/hotel/tea-country-munnar') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-bookmark me-1"></i>Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Similar Hotel 3 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card hotel-card border-0 shadow-sm">
                        <img src="{{ asset('images/hotels/hotels-2.jpg') }}" 
                             class="card-img-top hotel-image" 
                             alt="Rambagh Palace">
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
                            <div class="mb-3">
                                <span class="badge bg-light text-dark me-1 mb-1">Royal Suites</span>
                                <span class="badge bg-light text-dark me-1 mb-1">Fine Dining</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 text-primary mb-0">₹12,500/night</span>
                                <a href="{{ url('/hotel/rambagh-palace') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-bookmark me-1"></i>Book Now
                                </a>
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
        // HOTEL BOOKING FORM VALIDATION
        // ============================================
        document.getElementById('hotelBookingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const checkin = document.getElementById('checkin').value;
            const checkout = document.getElementById('checkout').value;
            const guests = document.getElementById('guests').value;
            const rooms = document.getElementById('rooms').value;
            
            // Validate dates
            if (!checkin || !checkout) {
                showNotification('Please select both check-in and check-out dates', 'warning');
                return;
            }
            
            const checkinDate = new Date(checkin);
            const checkoutDate = new Date(checkout);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            // Check if check-in is today or in future
            if (checkinDate < today) {
                showNotification('Check-in date cannot be in the past', 'warning');
                return;
            }
            
            // Check if check-out is after check-in
            if (checkoutDate <= checkinDate) {
                showNotification('Check-out date must be after check-in date', 'warning');
                return;
            }
            
            // Show loading
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
            submitBtn.disabled = true;
            
            // Calculate number of nights
            const timeDiff = checkoutDate.getTime() - checkinDate.getTime();
            const nights = Math.ceil(timeDiff / (1000 * 3600 * 24));
            
            // Calculate total price
            const pricePerNight = 5200;
            const totalPrice = pricePerNight * nights * rooms;
            
            // Simulate booking process
            setTimeout(() => {
                // Show success message with booking details
                const bookingDetails = `
                    <div class="booking-success-details">
                        <h5 class="mb-3">Booking Summary</h5>
                        <div class="row mb-2">
                            <div class="col-6">Hotel:</div>
                            <div class="col-6 text-end fw-bold">Taj Hotel, Guwahati</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">Check-in:</div>
                            <div class="col-6 text-end">${new Date(checkin).toLocaleDateString()}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">Check-out:</div>
                            <div class="col-6 text-end">${new Date(checkout).toLocaleDateString()}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">Nights:</div>
                            <div class="col-6 text-end">${nights} nights</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">Guests:</div>
                            <div class="col-6 text-end">${guests} guests</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">Rooms:</div>
                            <div class="col-6 text-end">${rooms} rooms</div>
                        </div>
                        <div class="row mb-3 pt-2 border-top">
                            <div class="col-6">Total Amount:</div>
                            <div class="col-6 text-end fw-bold text-primary">₹${totalPrice.toLocaleString()}</div>
                        </div>
                    </div>
                `;
                
                // Show booking confirmation
                showNotificationWithDetails(
                    'Booking successful! Redirecting to payment...', 
                    'success',
                    bookingDetails
                );
                
                // Reset form
                this.reset();
                
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                
                // Redirect to payment page after 3 seconds
                setTimeout(() => {
                    window.location.href = '/payment?booking_id=' + Date.now();
                }, 3000);
                
            }, 2000);
        });
        
        // ============================================
        // DATE VALIDATION
        // ============================================
        // Set minimum date for check-in (today)
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('checkin').min = today;
        
        // Update check-out min date when check-in changes
        document.getElementById('checkin').addEventListener('change', function() {
            const checkinDate = this.value;
            document.getElementById('checkout').min = checkinDate;
            
            // If check-out date is before new check-in date, reset it
            const checkoutDate = document.getElementById('checkout').value;
            if (checkoutDate && checkoutDate < checkinDate) {
                document.getElementById('checkout').value = '';
            }
        });
        
        // ============================================
        // NOTIFICATION FUNCTIONS
        // ============================================
        function showNotification(message, type = 'info') {
            // Remove existing notification
            const existingNotification = document.querySelector('.booking-notification');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            // Determine icon
            let icon = 'info-circle';
            if (type === 'warning') icon = 'exclamation-triangle';
            if (type === 'success') icon = 'check-circle';
            
            // Create notification
            const notification = document.createElement('div');
            notification.className = `booking-notification alert alert-${type} alert-dismissible fade show`;
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
        
        function showNotificationWithDetails(message, type = 'info', detailsHTML) {
            // Remove existing notification
            const existingNotification = document.querySelector('.booking-notification');
            if (existingNotification) {
                existingNotification.remove();
            }
            
            // Create notification with details
            const notification = document.createElement('div');
            notification.className = `booking-notification alert alert-${type} alert-dismissible fade show`;
            notification.style.cssText = `
                position: fixed;
                top: 100px;
                right: 20px;
                z-index: 9999;
                max-width: 500px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                border-radius: 10px;
                border: none;
            `;
            
            notification.innerHTML = `
                <div class="d-flex align-items-start">
                    <div class="me-3">
                        <i class="fas fa-check-circle fa-2x mt-1 text-success"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="alert-heading mb-2">Booking Successful</h6>
                        <p class="mb-3">${message}</p>
                        ${detailsHTML}
                        <div class="mt-3">
                            <button type="button" class="btn btn-sm btn-outline-primary me-2">
                                <i class="fas fa-print me-1"></i>Print Receipt
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-share me-1"></i>Share Booking
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn-close ms-3" data-bs-dismiss="alert"></button>
                </div>
            `;
            
            // Add to page
            document.body.appendChild(notification);
            
            // Auto remove after 8 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 8000);
            
            // Add click handlers for buttons
            notification.querySelector('.btn-outline-primary').addEventListener('click', function() {
                window.print();
            });
            
            notification.querySelector('.btn-outline-secondary').addEventListener('click', function() {
                const bookingText = `I just booked Taj Hotel, Guwahati through Travel Explorer!`;
                if (navigator.share) {
                    navigator.share({
                        title: 'Hotel Booking',
                        text: bookingText,
                        url: window.location.href
                    });
                } else {
                    navigator.clipboard.writeText(bookingText + ' ' + window.location.href);
                    showNotification('Booking details copied to clipboard!', 'info');
                }
            });
        }
        
        // ============================================
        // GET DIRECTIONS BUTTON
        // ============================================
        document.querySelector('.btn-outline-primary.w-100').addEventListener('click', function() {
            const hotelAddress = encodeURIComponent('Near Kamakhya Temple, Guwahati, Assam');
            const mapsUrl = `https://www.google.com/maps/dir/?api=1&destination=${hotelAddress}`;
            window.open(mapsUrl, '_blank');
        });
    });
</script>
@endsection

@section('styles')
<style>
    /* ============================================
       HOTEL HERO SECTION
    ============================================ */
    .hotel-hero-section {
        position: relative;
    }
    
    .hotel-hero-section h1 {
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }
    
    .hotel-hero-section .breadcrumb-item a:hover {
        text-decoration: underline !important;
    }
    
    /* ============================================
       BOOKING FORM STYLES
    ============================================ */
    .hotel-hero-section .card {
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
    }
    
    .hotel-hero-section .form-control,
    .hotel-hero-section .form-select {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        padding: 12px 15px;
    }
    
    .hotel-hero-section .form-control:focus,
    .hotel-hero-section .form-select:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
    }
    
    /* ============================================
       HOTEL IMAGE GALLERY
    ============================================ */
    .hotel-main-image {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    /* ============================================
       CARD STYLES
    ============================================ */
    .card {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }
    
    /* ============================================
       SIMILAR HOTELS
    ============================================ */
    .hotel-card {
        height: 100%;
    }
    
    .hotel-image {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }
    
    /* ============================================
       NOTIFICATION STYLES
    ============================================ */
    .booking-notification {
        animation: slideInRight 0.3s ease forwards;
    }
    
    .booking-success-details {
        background: rgba(255, 255, 255, 0.9);
        padding: 15px;
        border-radius: 10px;
        margin-top: 10px;
    }
    
    /* ============================================
       ANIMATIONS
    ============================================ */
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
    
    /* ============================================
       RESPONSIVE DESIGN
    ============================================ */
    @media (max-width: 768px) {
        .hotel-hero-section {
            padding-top: 100px;
            padding-bottom: 40px;
            min-height: auto;
        }
        
        .hotel-hero-section .display-5 {
            font-size: 2rem;
        }
        
        .hotel-main-image {
            margin-bottom: 20px;
        }
    }
    
    @media (max-width: 576px) {
        .hotel-hero-section .row.g-4 .col-md-3 {
            margin-bottom: 15px;
        }
    }
</style>
@endsection