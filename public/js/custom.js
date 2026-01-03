// Custom JavaScript for Travel Website

$(document).ready(function() {
    console.log('Travel Website JS loaded');
    
    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
    
    // Initialize popovers
    $('[data-bs-toggle="popover"]').popover();
    
    // Search functionality
    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        const searchTerm = $('#searchInput').val();
        if (searchTerm.trim() !== '') {
            window.location.href = `/search?q=${encodeURIComponent(searchTerm)}`;
        }
    });
    
    // Smooth scroll for anchor links
    $('a[href^="#"]').on('click', function(event) {
        if (this.hash !== "") {
            event.preventDefault();
            const hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top - 70
            }, 800);
        }
    });
    
    // Add active class to current page in navigation
    const currentUrl = window.location.pathname;
    $('.navbar-nav .nav-link').each(function() {
        const linkUrl = $(this).attr('href');
        if (currentUrl === linkUrl || 
            (currentUrl.includes(linkUrl) && linkUrl !== '/')) {
            $(this).addClass('active');
        }
    });
});

// Function to handle lazy loading images
function lazyLoadImages() {
    const images = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.add('loaded');
                observer.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
}

// Initialize when page loads
window.addEventListener('load', lazyLoadImages);