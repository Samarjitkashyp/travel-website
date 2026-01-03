<footer class="bg-dark text-white pt-5 pb-4">
    <div class="container">
        <div class="row">
            <!-- Company Info -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-brand mb-3">
                    <a href="{{ url('/') }}" class="text-decoration-none">
                        <i class="fas fa-globe-asia fa-2x text-primary"></i>
                        <span class="h3 fw-bold text-white ms-2">Travel</span>
                        <span class="h3 fw-bold text-primary">Explorer</span>
                    </a>
                </div>
                <p class="text-light mb-4">
                    Discover amazing travel destinations, find the best hotels, and plan your perfect trip with our comprehensive travel platform.
                </p>
                <div class="social-icons">
                    <a href="#" class="btn btn-outline-light btn-sm me-2 mb-2">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="btn btn-outline-light btn-sm me-2 mb-2">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="btn btn-outline-light btn-sm me-2 mb-2">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="btn btn-outline-light btn-sm me-2 mb-2">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#" class="btn btn-outline-light btn-sm mb-2">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h5 class="text-primary mb-4">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ url('/') }}" class="text-light text-decoration-none">
                            <i class="fas fa-chevron-right me-2 text-primary"></i>Home
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#destinations" class="text-light text-decoration-none">
                            <i class="fas fa-chevron-right me-2 text-primary"></i>Destinations
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#hotels" class="text-light text-decoration-none">
                            <i class="fas fa-chevron-right me-2 text-primary"></i>Hotels
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#packages" class="text-light text-decoration-none">
                            <i class="fas fa-chevron-right me-2 text-primary"></i>Packages
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#about" class="text-light text-decoration-none">
                            <i class="fas fa-chevron-right me-2 text-primary"></i>About Us
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#contact" class="text-light text-decoration-none">
                            <i class="fas fa-chevron-right me-2 text-primary"></i>Contact
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Popular Destinations -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="text-primary mb-4">Popular Destinations</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="text-light text-decoration-none">
                            <i class="fas fa-map-marker-alt me-2 text-primary"></i>Guwahati, Assam
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-light text-decoration-none">
                            <i class="fas fa-map-marker-alt me-2 text-primary"></i>Goa
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-light text-decoration-none">
                            <i class="fas fa-map-marker-alt me-2 text-primary"></i>Kerala
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-light text-decoration-none">
                            <i class="fas fa-map-marker-alt me-2 text-primary"></i>Rajasthan
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-light text-decoration-none">
                            <i class="fas fa-map-marker-alt me-2 text-primary"></i>Himachal Pradesh
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-light text-decoration-none">
                            <i class="fas fa-map-marker-alt me-2 text-primary"></i>Uttarakhand
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="text-primary mb-4">Contact Info</h5>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                        <span class="text-light">123 Travel Street, Tourism City, India</span>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-phone-alt me-2 text-primary"></i>
                        <span class="text-light">+91 98765 43210</span>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-envelope me-2 text-primary"></i>
                        <span class="text-light">info@travelexplorer.com</span>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-clock me-2 text-primary"></i>
                        <span class="text-light">24/7 Customer Support</span>
                    </li>
                </ul>
                
                <!-- Newsletter Subscription -->
                <div class="mt-4">
                    <h6 class="text-light mb-3">Subscribe to Newsletter</h6>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Your email">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <hr class="bg-light my-4">

        <!-- Copyright -->
        <div class="row">
            <div class="col-md-6">
                <p class="text-light mb-0">
                    &copy; {{ date('Y') }} TravelExplorer. All rights reserved.
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="text-light mb-0">
                    <a href="#" class="text-light text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-light text-decoration-none me-3">Terms of Service</a>
                    <a href="#" class="text-light text-decoration-none">Cookie Policy</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button id="backToTop" class="btn btn-primary rounded-circle position-fixed" style="bottom: 20px; right: 20px; display: none;">
        <i class="fas fa-chevron-up"></i>
    </button>
</footer>

<style>
    footer {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    }
    
    .footer-brand i {
        color: #3498db;
    }
    
    .social-icons .btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .social-icons .btn:hover {
        background-color: #3498db;
        border-color: #3498db;
        transform: translateY(-3px);
    }
    
    footer a:hover {
        color: #3498db !important;
        padding-left: 5px;
        transition: all 0.3s ease;
    }
    
    footer .input-group .form-control {
        border-radius: 5px 0 0 5px;
        border: 1px solid #3498db;
    }
    
    footer .input-group .btn {
        border-radius: 0 5px 5px 0;
    }
    
    #backToTop {
        width: 50px;
        height: 50px;
        z-index: 1000;
        transition: all 0.3s ease;
    }
    
    #backToTop:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
    }
</style>

<script>
    // Back to Top Button
    const backToTopButton = document.getElementById('backToTop');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            backToTopButton.style.display = 'block';
        } else {
            backToTopButton.style.display = 'none';
        }
    });
    
    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>