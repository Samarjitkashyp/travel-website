<header>
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
                            <i class="fas fa-map-marked-alt me-1"></i>Destinations
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

                <!-- Auth Buttons - Check if user is logged in -->
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
                        <!-- User is not logged in - Show login/register buttons -->
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm me-2">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-user-plus me-1"></i>Register
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</header>

<style>
    .navbar {
        padding: 15px 0;
        transition: all 0.3s ease;
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
    }
    
    .nav-link:hover, .nav-link.active {
        background-color: rgba(52, 152, 219, 0.1);
        color: #3498db !important;
    }
</style>

<script>
    // Add scroll effect to navbar
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.style.padding = '10px 0';
            navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
        } else {
            navbar.style.padding = '15px 0';
            navbar.style.boxShadow = '0 2px 5px rgba(0,0,0,0.05)';
        }
    });
</script>