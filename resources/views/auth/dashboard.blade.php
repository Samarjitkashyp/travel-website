@extends('layouts.app')

@section('title', 'Dashboard - Travel Explorer')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-success">
                        <h5 class="alert-heading">Welcome back, {{ Auth::user()->name }}!</h5>
                        <p class="mb-0">You are logged in to Travel Explorer.</p>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-4 mb-3">
                            <div class="card text-white bg-info">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-hotel me-2"></i>My Bookings</h5>
                                    <p class="card-text">View and manage your hotel bookings</p>
                                    <a href="#" class="btn btn-light">View Bookings</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <div class="card text-white bg-success">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-plane me-2"></i>My Trips</h5>
                                    <p class="card-text">Check your upcoming travel plans</p>
                                    <a href="#" class="btn btn-light">View Trips</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <div class="card text-white bg-warning">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-user-cog me-2"></i>Profile</h5>
                                    <p class="card-text">Update your personal information</p>
                                    <a href="#" class="btn btn-light">Edit Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h5>Quick Actions</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('hotels') }}" class="btn btn-outline-primary">
                                <i class="fas fa-search me-1"></i> Find Hotels
                            </a>
                            <a href="{{ route('packages') }}" class="btn btn-outline-success">
                                <i class="fas fa-suitcase me-1"></i> Browse Packages
                            </a>
                            <a href="{{ route('home') }}" class="btn btn-outline-info">
                                <i class="fas fa-home me-1"></i> Go to Homepage
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection