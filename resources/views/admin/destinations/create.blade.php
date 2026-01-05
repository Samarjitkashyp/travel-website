@extends('layouts.admin')

@section('title', 'Add Destination - Travel Explorer')
@section('page-title', 'Add New Destination')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Basic Information -->
                    <h5 class="mb-4">
                        <i class="fas fa-info-circle text-primary me-2"></i>Basic Information
                    </h5>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Destination Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="location" class="form-label">Location *</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                   id="location" name="location" value="{{ old('location') }}" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="state" class="form-label">State *</label>
                            <select class="form-select @error('state') is-invalid @enderror" 
                                    id="state" name="state" required>
                                <option value="">Select State</option>
                                @foreach($states as $state)
                                    <option value="{{ $state }}" {{ old('state') == $state ? 'selected' : '' }}>
                                        {{ $state }}
                                    </option>
                                @endforeach
                            </select>
                            @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="category" class="form-label">Category *</label>
                            <select class="form-select @error('category') is-invalid @enderror" 
                                    id="category" name="category" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type">
                                <option value="">Select Type</option>
                                @foreach($types as $type)
                                    <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Pricing & Rating -->
                    <h5 class="mb-4">
                        <i class="fas fa-rupee-sign text-primary me-2"></i>Pricing & Rating
                    </h5>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="price" class="form-label">Starting Price (₹) *</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price') }}" min="0" required>
                            <small class="text-muted">Enter per person starting price</small>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="rating" class="form-label">Rating (1-5)</label>
                            <input type="number" step="0.1" class="form-control @error('rating') is-invalid @enderror" 
                                   id="rating" name="rating" value="{{ old('rating') }}" min="0" max="5">
                            <small class="text-muted">Enter rating between 0-5</small>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Image Upload -->
                    <h5 class="mb-4">
                        <i class="fas fa-image text-primary me-2"></i>Destination Image
                    </h5>
                    
                    <div class="mb-4">
                        <label for="image" class="form-label">Upload Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        <small class="text-muted">Recommended size: 800x600px, Max: 2MB</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <!-- Image Preview -->
                        <div id="imagePreview" class="mt-3" style="display: none;">
                            <img id="previewImage" src="" alt="Preview" 
                                 class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <h5 class="mb-4">
                        <i class="fas fa-file-alt text-primary me-2"></i>Description
                    </h5>
                    
                    <div class="mb-4">
                        <label for="description" class="form-label">Short Description *</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                        <small class="text-muted">Brief description for cards and listings</small>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="overview" class="form-label">Detailed Overview</label>
                        <textarea class="form-control @error('overview') is-invalid @enderror" 
                                  id="overview" name="overview" rows="5">{{ old('overview') }}</textarea>
                        <small class="text-muted">Detailed information about the destination</small>
                        @error('overview')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Additional Information -->
                    <h5 class="mb-4">
                        <i class="fas fa-cog text-primary me-2"></i>Additional Information
                    </h5>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="hotels_count" class="form-label">Hotels Count</label>
                            <input type="number" class="form-control @error('hotels_count') is-invalid @enderror" 
                                   id="hotels_count" name="hotels_count" value="{{ old('hotels_count') }}" min="0">
                            @error('hotels_count')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="best_time" class="form-label">Best Time to Visit</label>
                            <input type="text" class="form-control @error('best_time') is-invalid @enderror" 
                                   id="best_time" name="best_time" value="{{ old('best_time') }}">
                            <small class="text-muted">e.g., Oct-Mar, Year-round</small>
                            @error('best_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="ideal_duration" class="form-label">Ideal Duration</label>
                            <input type="text" class="form-control @error('ideal_duration') is-invalid @enderror" 
                                   id="ideal_duration" name="ideal_duration" value="{{ old('ideal_duration') }}">
                            <small class="text-muted">e.g., 3-5 days, 1 week</small>
                            @error('ideal_duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Array Fields -->
                    <h5 class="mb-4">
                        <i class="fas fa-list text-primary me-2"></i>Additional Details
                    </h5>
                    
                    <div class="mb-4">
                        <label class="form-label">Top Attractions</label>
                        <div id="attractionsContainer">
                            @if(old('attractions'))
                                @foreach(old('attractions') as $index => $attraction)
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" 
                                               name="attractions[]" value="{{ $attraction }}">
                                        <button type="button" class="btn btn-outline-danger remove-field">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="attractions[]" 
                                           placeholder="Enter attraction name">
                                    <button type="button" class="btn btn-outline-danger remove-field">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="addAttraction">
                            <i class="fas fa-plus me-1"></i>Add Another Attraction
                        </button>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Nearby Areas</label>
                        <div id="areasContainer">
                            @if(old('nearby_areas'))
                                @foreach(old('nearby_areas') as $index => $area)
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" 
                                               name="nearby_areas[]" value="{{ $area }}">
                                        <button type="button" class="btn btn-outline-danger remove-field">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="nearby_areas[]" 
                                           placeholder="Enter nearby area name">
                                    <button type="button" class="btn btn-outline-danger remove-field">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="addArea">
                            <i class="fas fa-plus me-1"></i>Add Another Area
                        </button>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Travel Tips</label>
                        <div id="tipsContainer">
                            @if(old('travel_tips'))
                                @foreach(old('travel_tips') as $index => $tip)
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" 
                                               name="travel_tips[]" value="{{ $tip }}">
                                        <button type="button" class="btn btn-outline-danger remove-field">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="travel_tips[]" 
                                           placeholder="Enter travel tip">
                                    <button type="button" class="btn btn-outline-danger remove-field">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="addTip">
                            <i class="fas fa-plus me-1"></i>Add Another Tip
                        </button>
                    </div>
                    
                    <!-- Status -->
                    <div class="mb-4">
                        <label class="form-label">Status</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" 
                                       id="statusActive" value="active" checked>
                                <label class="form-check-label" for="statusActive">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" 
                                       id="statusInactive" value="inactive">
                                <label class="form-check-label" for="statusInactive">
                                    Inactive
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" 
                                       id="statusDraft" value="draft">
                                <label class="form-check-label" for="statusDraft">
                                    Draft
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Destination
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <!-- Preview Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="fas fa-eye me-2"></i>Preview
                </h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <div id="livePreviewImage" class="bg-light rounded d-flex align-items-center justify-content-center" 
                         style="height: 200px;">
                        <i class="fas fa-image fa-3x text-muted"></i>
                    </div>
                </div>
                <h5 id="livePreviewName" class="text-center">Destination Name</h5>
                <div class="text-center text-muted mb-3">
                    <i class="fas fa-map-marker-alt text-danger me-1"></i>
                    <span id="livePreviewLocation">Location, State</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Price:</span>
                    <span class="fw-bold text-primary">₹<span id="livePreviewPrice">0</span></span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Category:</span>
                    <span id="livePreviewCategory">-</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Type:</span>
                    <span id="livePreviewType">-</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Rating:</span>
                    <span class="text-warning" id="livePreviewRating">
                        <i class="fas fa-star"></i> -
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Help Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="mb-3">
                    <i class="fas fa-question-circle text-primary me-2"></i>Tips
                </h6>
                <ul class="list-unstyled text-muted small">
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Fill all required fields marked with *
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Upload high-quality images for better presentation
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Add multiple attractions for detailed information
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Keep description concise but informative
                    </li>
                    <li>
                        <i class="fas fa-check-circle text-success me-2"></i>
                        Use "Draft" status to save and edit later
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Image Preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewDiv = document.getElementById('imagePreview');
                const previewImg = document.getElementById('previewImage');
                const livePreview = document.getElementById('livePreviewImage');
                
                previewImg.src = e.target.result;
                previewDiv.style.display = 'block';
                
                // Update live preview
                livePreview.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded" style="max-height: 200px;">`;
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Live Preview Updates
    document.getElementById('name').addEventListener('input', function() {
        document.getElementById('livePreviewName').textContent = this.value || 'Destination Name';
    });
    
    document.getElementById('location').addEventListener('input', function() {
        const state = document.getElementById('state').value || 'State';
        document.getElementById('livePreviewLocation').textContent = 
            `${this.value || 'Location'}, ${state}`;
    });
    
    document.getElementById('state').addEventListener('change', function() {
        const location = document.getElementById('location').value || 'Location';
        document.getElementById('livePreviewLocation').textContent = 
            `${location}, ${this.value || 'State'}`;
    });
    
    document.getElementById('price').addEventListener('input', function() {
        document.getElementById('livePreviewPrice').textContent = 
            this.value ? parseInt(this.value).toLocaleString() : '0';
    });
    
    document.getElementById('category').addEventListener('change', function() {
        document.getElementById('livePreviewCategory').textContent = this.value || '-';
    });
    
    document.getElementById('type').addEventListener('change', function() {
        document.getElementById('livePreviewType').textContent = this.value || '-';
    });
    
    document.getElementById('rating').addEventListener('input', function() {
        const rating = this.value;
        const stars = '★'.repeat(Math.floor(rating)) + '☆'.repeat(5 - Math.floor(rating));
        document.getElementById('livePreviewRating').innerHTML = 
            `<i class="fas fa-star"></i> ${rating || '-'}`;
    });
    
    // Dynamic Form Fields
    function addField(containerId, fieldName, placeholder) {
        const container = document.getElementById(containerId);
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="text" class="form-control" name="${fieldName}[]" placeholder="${placeholder}">
            <button type="button" class="btn btn-outline-danger remove-field">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(div);
        
        // Add remove event
        div.querySelector('.remove-field').addEventListener('click', function() {
            div.remove();
        });
    }
    
    // Add event listeners for dynamic fields
    document.getElementById('addAttraction').addEventListener('click', function() {
        addField('attractionsContainer', 'attractions', 'Enter attraction name');
    });
    
    document.getElementById('addArea').addEventListener('click', function() {
        addField('areasContainer', 'nearby_areas', 'Enter nearby area name');
    });
    
    document.getElementById('addTip').addEventListener('click', function() {
        addField('tipsContainer', 'travel_tips', 'Enter travel tip');
    });
    
    // Remove existing fields
    document.querySelectorAll('.remove-field').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.input-group').remove();
        });
    });
    
    // Initialize live preview
    document.addEventListener('DOMContentLoaded', function() {
        // Trigger initial preview updates
        document.getElementById('name').dispatchEvent(new Event('input'));
        document.getElementById('location').dispatchEvent(new Event('input'));
        document.getElementById('state').dispatchEvent(new Event('change'));
        document.getElementById('price').dispatchEvent(new Event('input'));
        document.getElementById('category').dispatchEvent(new Event('change'));
        document.getElementById('type').dispatchEvent(new Event('change'));
        document.getElementById('rating').dispatchEvent(new Event('input'));
    });
</script>
@endsection