{{-- Quick Filter Sidebar Component --}}
<div class="card border-0 shadow-sm mb-3">
    <div class="card-header bg-light">
        <h6 class="mb-0"><i class="fas fa-filter me-2"></i>Quick Filters</h6>
    </div>
    <div class="card-body">
        <!-- Price Filter -->
        <div class="mb-4">
            <h6 class="mb-3">Price Range</h6>
            <input type="range" class="form-range" min="0" max="50000" step="1000">
            <div class="d-flex justify-content-between">
                <small>₹0</small>
                <small>₹50,000</small>
            </div>
        </div>

        <!-- Rating Filter -->
        <div class="mb-4">
            <h6 class="mb-3">Rating</h6>
            @for($i = 5; $i >= 1; $i--)
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox">
                    <label class="form-check-label">
                        @for($j = 0; $j < $i; $j++)
                            <i class="fas fa-star text-warning"></i>
                        @endfor
                        & above
                    </label>
                </div>
            @endfor
        </div>

        <!-- Apply Filters Button -->
        <button class="btn btn-primary w-100">
            <i class="fas fa-check me-2"></i>Apply Filters
        </button>
    </div>
</div>