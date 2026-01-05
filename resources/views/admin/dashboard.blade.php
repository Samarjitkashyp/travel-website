@extends('layouts.admin')

@section('title', 'Admin Dashboard - Travel Explorer')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Welcome to Admin Panel')

@section('content')
<div class="row">
    <!-- Stats Cards -->
    <div class="col-md-3">
        <div class="stat-card bg-primary">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">150</h3>
                    <p class="mb-0">Total Users</p>
                </div>
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stat-card bg-success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">45</h3>
                    <p class="mb-0">Active Packages</p>
                </div>
                <i class="fas fa-suitcase"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stat-card bg-warning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">320</h3>
                    <p class="mb-0">Total Bookings</p>
                </div>
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stat-card bg-info">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">₹2.5L</h3>
                    <p class="mb-0">Revenue</p>
                </div>
                <i class="fas fa-rupee-sign"></i>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Recent Bookings</h5>
            </div>
            <div class="card-body p-0">
                <div class="admin-table">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Package</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#001</td>
                                <td>John Doe</td>
                                <td>Goa Beach Package</td>
                                <td>₹12,500</td>
                                <td><span class="badge bg-success">Confirmed</span></td>
                                <td>2024-01-15</td>
                            </tr>
                            <tr>
                                <td>#002</td>
                                <td>Jane Smith</td>
                                <td>Kashmir Winter Tour</td>
                                <td>₹18,000</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>2024-01-14</td>
                            </tr>
                            <tr>
                                <td>#003</td>
                                <td>Robert Johnson</td>
                                <td>Assam Tea Tour</td>
                                <td>₹9,500</td>
                                <td><span class="badge bg-success">Confirmed</span></td>
                                <td>2024-01-13</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-users me-2"></i>Manage Users
                    </a>
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-success btn-lg">
                        <i class="fas fa-suitcase me-2"></i>Add Package
                    </a>
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-warning btn-lg">
                        <i class="fas fa-calendar-alt me-2"></i>View Bookings
                    </a>
                    <a href="{{ route('admin.hotels.index') }}" class="btn btn-info btn-lg">
                        <i class="fas fa-hotel me-2"></i>Manage Hotels
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">System Status</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">PHP Version</small>
                    <div class="d-flex justify-content-between">
                        <span>8.2+</span>
                        <span class="badge bg-success">OK</span>
                    </div>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Database</small>
                    <div class="d-flex justify-content-between">
                        <span>MySQL 8.0</span>
                        <span class="badge bg-success">Connected</span>
                    </div>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Storage</small>
                    <div class="d-flex justify-content-between">
                        <span>250MB / 1GB</span>
                        <span class="badge bg-warning">25%</span>
                    </div>
                </div>
                <div>
                    <small class="text-muted">Last Backup</small>
                    <div class="d-flex justify-content-between">
                        <span>2024-01-10</span>
                        <span class="badge bg-danger">Required</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Chart.js for Dashboard
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('revenueChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Revenue (in ₹)',
                        data: [12000, 19000, 15000, 25000, 22000, 30000],
                        borderColor: '#3498db',
                        backgroundColor: 'rgba(52, 152, 219, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });
        }
    });
</script>
@endsection
@endsection