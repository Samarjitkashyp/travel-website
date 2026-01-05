<header>
    <!-- ========== TOP BAR START ========== -->
    <div class="top-bar bg-dark text-white py-2 d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Side: Social Media Icons -->
                <div class="col-md-6">
                    <div class="social-icons">
                        <span class="me-3">
                            <i class="fas fa-map-marker-alt me-1"></i>
                            <small>123 Travel Street, Goa, India</small>
                        </span>
                        <span class="me-3">
                            <i class="fas fa-phone me-1"></i>
                            <small>+91 9876543210</small>
                        </span>
                        
                        <!-- Social Media Links -->
                        <a href="#" class="text-white me-2" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-white me-2" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-white me-2" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-white" title="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Right Side: Auth Buttons & Additional Info -->
                <div class="col-md-6 text-end">
                    <div class="top-bar-links">
                        <!-- If user is not logged in, show login/register in top bar headder -->
                        @if(!auth()->check())
                            <a href="{{ route('login') }}" class="text-white me-3">
                                <i class="fas fa-sign-in-alt me-1"></i>
                                <small>User Login</small>
                            </a>
                            <a href="{{ route('admin.dashboard') }}" class="text-white me-3">
                                <i class="fas fa-sign-in-alt me-1"></i>
                                <small>Admin Login</small>
                            </a>
                            <a href="{{ route('register') }}" class="text-white">
                                <i class="fas fa-user-plus me-1"></i>
                                <small>Register</small>
                            </a>
                        @else
                            <!-- If user is logged in, show welcome message -->
                            <span class="me-3">
                                <i class="fas fa-user-circle me-1"></i>
                                <small>Welcome, {{ auth()->user()->name }}</small>
                            </span>
                        @endif
                        
                        <!-- Additional top bar links -->
                        <a href="#" class="text-white ms-3">
                            <i class="fas fa-question-circle me-1"></i>
                            <small>Help</small>
                        </a>
                        <a href="#" class="text-white ms-3">
                            <i class="fas fa-headset me-1"></i>
                            <small>24/7 Support</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== TOP BAR END ========== -->

    <!-- ========== MAIN NAVBAR START ========== -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-globe-asia text-primary"></i>
                <span class="fw-bold">Travel</span><span class="text-primary">Explorer</span>
            </a>

            <!-- Mobile Menu Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#destinations">
                            <i class="fas fa-map-marked-alt me-1"></i> Destinations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('hotels') }}">
                            <i class="fas fa-hotel me-1"></i>Hotels
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#packages">
                            <i class="fas fa-suitcase-rolling me-1"></i>Packages
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">
                            <i class="fas fa-info-circle me-1"></i>About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">
                            <i class="fas fa-phone-alt me-1"></i>Contact
                        </a>
                    </li>
                </ul>

                <!-- Auth Buttons for Main Navbar (for mobile view and as fallback) -->
                <div class="ms-lg-3 mt-3 mt-lg-0">
                    @if(auth()->check())
                        <!-- User is logged in - Show profile dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i>{{ auth()->user()->name ?? 'My Account' }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                </a></li>
                                <li><a class="dropdown-item" href="#">
                                    <i class="fas fa-heart me-2"></i>My Wishlist
                                </a></li>
                                <li><a class="dropdown-item" href="#">
                                    <i class="fas fa-history me-2"></i>Booking History
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <!-- User is not logged in - Show login/register buttons (for mobile view) -->
                        <div class="d-block d-md-none">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm me-2">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-user-plus me-1"></i>Register
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    <!-- ========== MAIN NAVBAR END ========== -->
</header>

<style>
    /* ========== TOP BAR STYLES ========== */
    .top-bar {
        background: var(--dark-bg) !important;
        font-size: 0.85rem;
        z-index: 1031; /* Just below navbar which is 1032 */
        position: relative;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    
    .top-bar a {
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .top-bar a:hover {
        color: var(--secondary-color) !important;
    }
    
    .social-icons a {
        display: inline-block;
        width: 28px;
        height: 28px;
        line-height: 28px;
        text-align: center;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transition: all 0.3s ease;
    }
    
    .social-icons a:hover {
        background: var(--primary-color);
        transform: translateY(-2px);
    }
    
    .top-bar-links small {
        font-weight: 500;
    }
    
    /* ========== MAIN NAVBAR STYLES ========== */
    .navbar {
        padding: 12px 0;
        transition: all 0.3s ease;
        top: 38px; /* Adjust for top bar height */
    }
    
    /* When scrolling, adjust navbar position */
    body.scrolled .navbar {
        top: 0;
    }
    
    .navbar-brand {
        font-size: 1.8rem;
    }
    
    .navbar-brand i {
        font-size: 2rem;
        margin-right: 8px;
    }
    
    .nav-link {
        font-weight: 500;
        padding: 8px 15px !important;
        border-radius: 5px;
        transition: all 0.3s ease;
        margin: 0 5px;
    }
    
    .nav-link:hover, .nav-link.active {
        background-color: rgba(52, 152, 219, 0.1);
        color: var(--primary-color) !important;
    }
    
    /* Dropdown styles */
    .dropdown-menu {
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-radius: 10px;
    }
    
    .dropdown-item {
        padding: 10px 20px;
        transition: all 0.3s ease;
    }
    
    .dropdown-item:hover {
        background-color: rgba(52, 152, 219, 0.1);
        color: var(--primary-color);
    }
    
    /* Mobile responsive adjustments */
    @media (max-width: 767.98px) {
        .navbar {
            top: 0; /* Remove top offset on mobile */
        }
        
        .top-bar {
            display: none !important; /* Hide top bar on mobile */
        }
        
        .nav-link {
            margin: 5px 0;
        }
    }
    
    @media (min-width: 768px) {
        .d-md-block {
            display: block !important;
        }
    }
</style>

<script>
    // Add scroll effect to navbar
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        const body = document.querySelector('body');
        
        if (window.scrollY > 50) {
            navbar.style.padding = '8px 0';
            navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
            body.classList.add('scrolled');
        } else {
            navbar.style.padding = '12px 0';
            navbar.style.boxShadow = '0 2px 5px rgba(0,0,0,0.05)';
            body.classList.remove('scrolled');
        }
    });
    
    // Initialize tooltips for social media icons
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>