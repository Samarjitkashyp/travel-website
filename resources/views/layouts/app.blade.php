<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Travel Explorer')</title>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    
    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    
    <!-- Swiper Slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
    @yield('styles')
</head>
<body>
    <!-- Header Section -->
    @include('includes.header')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer Section -->
    @include('includes.footer')
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    
    <!-- Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    
    <!-- Slick Slider -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    
    <!-- Swiper Slider -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('js/custom.js') }}"></script>
    
    @yield('scripts')
    
    <!-- Slider Initialization Script -->
    <script>
        // Initialize all sliders when needed
        document.addEventListener('DOMContentLoaded', function() {
            // Prevent multiple initializations
            window.slidersInitialized = false;
            
            // Function to initialize sliders
            window.initializeSliders = function() {
                if (!window.slidersInitialized) {
                    // Owl Carousel initialization
                    if ($.fn.owlCarousel) {
                        $('.owl-carousel').each(function() {
                            if (!$(this).hasClass('owl-loaded')) {
                                $(this).owlCarousel({
                                    loop: true,
                                    margin: 10,
                                    nav: true,
                                    responsive: {
                                        0: { items: 1 },
                                        600: { items: 2 },
                                        1000: { items: 3 }
                                    }
                                });
                            }
                        });
                    }
                    
                    // Slick Slider initialization
                    if ($.fn.slick) {
                        $('.slick-slider').each(function() {
                            if (!$(this).hasClass('slick-initialized')) {
                                $(this).slick({
                                    dots: true,
                                    infinite: true,
                                    speed: 300,
                                    slidesToShow: 1,
                                    adaptiveHeight: true
                                });
                            }
                        });
                    }
                    
                    // Swiper initialization
                    if (typeof Swiper !== 'undefined') {
                        document.querySelectorAll('.swiper').forEach(function(element) {
                            if (!element.swiper) {
                                new Swiper(element, {
                                    direction: 'horizontal',
                                    loop: true,
                                    pagination: {
                                        el: '.swiper-pagination',
                                    },
                                    navigation: {
                                        nextEl: '.swiper-button-next',
                                        prevEl: '.swiper-button-prev',
                                    },
                                });
                            }
                        });
                    }
                    
                    window.slidersInitialized = true;
                }
            };
            
            // Initialize on page load
            window.initializeSliders();
        });
    </script>
</body>
</html>