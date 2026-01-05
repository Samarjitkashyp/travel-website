@extends('layouts.admin')

@section('title', 'Manage Destinations - Travel Explorer')
@section('page-title', 'Destinations Management')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">All Destinations</h5>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Add Destination
            </a>
            <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#bulkActionModal">
                <i class="fas fa-tasks me-1"></i> Bulk Actions
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <!-- Search and Filter -->
        <div class="p-3 border-bottom bg-light">
            <form method="GET" class="row g-2">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control form-control-sm" 
                           placeholder="Search destinations..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="state" class="form-select form-select-sm">
                        <option value="">All States</option>
                        @foreach(['Assam', 'Goa', 'Kerala', 'Rajasthan', 'Himachal Pradesh', 'Uttarakhand'] as $state)
                            <option value="{{ $state }}" {{ request('state') == $state ? 'selected' : '' }}>
                                {{ $state }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="category" class="form-select form-select-sm">
                        <option value="">All Categories</option>
                        @foreach(['Hill Station', 'Beach', 'Heritage', 'Wildlife', 'Adventure', 'Religious'] as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-search me-1"></i> Search
                        </button>
                        <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-redo me-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Destinations Table -->
        <div class="admin-table">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50">
                            <input type="checkbox" id="selectAll" class="form-check-input">
                        </th>
                        <th width="80">Image</th>
                        <th>Destination</th>
                        <th>Location</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($destinations as $destination)
                    <tr>
                        <td>
                            <input type="checkbox" name="selected_items[]" value="{{ $destination->id }}" 
                                   class="form-check-input select-item">
                        </td>
                        <td>
                            @if($destination->image)
                                <img src="{{ asset('storage/' . $destination->image) }}" 
                                     alt="{{ $destination->name }}" 
                                     class="rounded" 
                                     style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px;">
                                    <i class="fas fa-map-marker-alt text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div>
                                <strong>{{ $destination->name }}</strong>
                                <div class="small text-muted">
                                    <i class="fas fa-tag me-1"></i>{{ $destination->category }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="small">
                                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                {{ $destination->location }}
                                <div class="text-muted">{{ $destination->state }}</div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-bold text-primary">₹{{ number_format($destination->price) }}</span>
                            <div class="small text-warning">
                                <i class="fas fa-star"></i> {{ $destination->rating ?? 'N/A' }}
                            </div>
                        </td>
                        <td>
                            @if($destination->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @elseif($destination->status == 'inactive')
                                <span class="badge bg-secondary">Inactive</span>
                            @else
                                <span class="badge bg-warning">Draft</span>
                            @endif
                        </td>
                        <td>
                            <div class="small">{{ $destination->created_at->format('d M Y') }}</div>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.destinations.show', $destination) }}" 
                                   class="btn btn-outline-info" data-bs-toggle="tooltip" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.destinations.edit', $destination) }}" 
                                   class="btn btn-outline-primary" data-bs-toggle="tooltip" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.destinations.destroy', $destination) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" 
                                            onclick="return confirm('Are you sure you want to delete this destination?')"
                                            data-bs-toggle="tooltip" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                            <h5>No destinations found</h5>
                            <p class="text-muted">Add your first destination to get started.</p>
                            <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add Destination
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($destinations->hasPages())
        <div class="card-footer bg-white">
            {{ $destinations->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Bulk Action Modal -->
<div class="modal fade" id="bulkActionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="bulkActionForm" method="POST" action="{{ route('admin.destinations.bulk') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Bulk Actions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select Action</label>
                        <select name="action" class="form-select" required>
                            <option value="">Choose action...</option>
                            <option value="delete">Delete Selected</option>
                            <option value="activate">Activate Selected</option>
                            <option value="deactivate">Deactivate Selected</option>
                        </select>
                    </div>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        This action will affect all selected destinations.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Apply Action</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Select All Checkbox
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.select-item');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Bulk Action Form
    document.getElementById('bulkActionForm').addEventListener('submit', function(e) {
        const selectedItems = document.querySelectorAll('.select-item:checked');
        if (selectedItems.length === 0) {
            e.preventDefault();
            alert('Please select at least one destination.');
            return false;
        }
        
        const action = this.querySelector('select[name="action"]').value;
        if (!action) {
            e.preventDefault();
            alert('Please select an action.');
            return false;
        }
        
        // Add selected items to form
        selectedItems.forEach(item => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'selected_items[]';
            input.value = item.value;
            this.appendChild(input);
        });
        
        return true;
    });

    // Table row selection
    document.querySelectorAll('tbody tr').forEach(row => {
        row.addEventListener('click', function(e) {
            if (e.target.type !== 'checkbox' && !e.target.closest('.btn-group')) {
                const checkbox = this.querySelector('.select-item');
                if (checkbox) {
                    checkbox.checked = !checkbox.checked;
                }
            }
        });
    });
</script>
@endsection