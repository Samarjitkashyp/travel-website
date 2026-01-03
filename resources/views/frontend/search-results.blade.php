@extends('layouts.app')

@section('title', 'Search Results - Travel Explorer')

@section('content')
    <!-- Search Results Header -->
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="mb-3">
                    <i class="fas fa-search me-2 text-primary"></i>Search Results
                </h1>
                
                <!-- Search Summary -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <p class="mb-2">
                                    <strong>Search For:</strong> 
                                    <span class="text-primary">
                                        {{ $searchParams['location'] ?? ($searchParams['q'] ?? 'All Destinations') }}
                                    </span>
                                </p>
                                @if(!empty($activeFilters))
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($activeFilters as $filter)
                                            <span class="badge bg-primary">
                                                {{ $filter }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4 text-md-end">
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-sliders-h me-2"></i>Modify Search
                                    </button>
                                    <div class="dropdown-menu p-3" style="min-width: 300px;">
                                        <!-- Insert Advanced Search Form Here -->
                                        @include('components.advanced-search')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results Content -->
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-lg-3 mb-4">
                <div class="sticky-top" style="top: 100px;">
                    <!-- Quick Filter Sidebar -->
                    @include('components.search-sidebar')
                </div>
            </div>

            <!-- Results List -->
            <div class="col-lg-9">
                <!-- Results Count and Sorting -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="mb-0">
                        <strong>{{ $totalResults ?? 0 }}</strong> results found
                        <span class="text-muted">
                            <!-- ✅ FIXED: Use count() method properly -->
                            @if(isset($results) && $results instanceof \Countable)
                                (Showing {{ $results->count() }})
                            @else
                                (Showing 0)
                            @endif
                        </span>
                    </p>
                    <select class="form-select w-auto" id="sortResults">
                        <option value="relevance">Sort by: Relevance</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="rating">Rating</option>
                        <option value="distance">Distance</option>
                    </select>
                </div>

                <!-- Results Grid -->
                <div class="row" id="searchResults">
                    <!-- ✅ FIXED: Check if results exist and is iterable -->
                    @if(isset($results) && (is_array($results) || $results instanceof \Countable) && count($results) > 0)
                        @foreach($results as $result)
                            @include('components.search-result-item', ['result' => $result])
                        @endforeach
                    @else
                        <!-- No Results Found -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center py-5">
                                    <i class="fas fa-search fa-4x text-muted mb-4"></i>
                                    <h3 class="mb-3">No Results Found</h3>
                                    <p class="text-muted mb-4">
                                        We couldn't find any results for your search.
                                        Try adjusting your filters or search terms.
                                    </p>
                                    <a href="{{ route('home') }}" class="btn btn-primary">
                                        <i class="fas fa-home me-2"></i>Back to Home
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Pagination - Only show if results exist -->
                @if(isset($results) && (is_array($results) || $results instanceof \Countable) && count($results) > 0)
                    <div class="d-flex justify-content-center mt-5">
                        <nav aria-label="Search results pagination">
                            <ul class="pagination">
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">1</span>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Sort results functionality
    document.getElementById('sortResults').addEventListener('change', function() {
        const sortBy = this.value;
        
        // Show loading
        const resultsContainer = document.getElementById('searchResults');
        resultsContainer.innerHTML = `
            <div class="col-12 text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3">Sorting results...</p>
            </div>
        `;
        
        // Simulate API call
        setTimeout(() => {
            // In real implementation, this would reload with sorted results
            window.location.reload();
        }, 1000);
    });
    
    // Filter badges removal
    document.querySelectorAll('.badge.bg-primary').forEach(badge => {
        badge.addEventListener('click', function() {
            // In real implementation, this would remove the filter
            this.remove();
            // Reload results without this filter
            setTimeout(() => {
                // alert('Filter removed. Page will reload.');
                // window.location.reload();
            }, 500);
        });
    });
</script>
@endsection

<style>
    .search-results-header {
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        color: white;
        padding: 40px 0;
        margin-top: 70px;
    }
    
    .results-count {
        font-size: 1.2rem;
        color: #666;
    }
    
    .result-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }
    
    .result-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    
    .badge.bg-primary {
        cursor: pointer;
        transition: opacity 0.3s ease;
    }
    
    .badge.bg-primary:hover {
        opacity: 0.8;
    }
    
    @media (max-width: 768px) {
        .sticky-top {
            position: static !important;
        }
    }
</style>