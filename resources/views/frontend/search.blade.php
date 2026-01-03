@extends('layouts.app')

@section('title', 'Search Results - Travel Explorer')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="mb-4">Search Results for "{{ $query ?? 'All' }}"</h1>
            
            <!-- Search Results will go here -->
            <div class="alert alert-info">
                <h4><i class="fas fa-info-circle me-2"></i>Search Feature</h4>
                <p class="mb-0">Search functionality is currently in development. For now, please browse our featured destinations below.</p>
            </div>
            
            <!-- You can redirect to homepage destinations section -->
            <div class="text-center mt-5">
                <a href="{{ route('home') }}#destinations" class="btn btn-primary btn-lg">
                    <i class="fas fa-map-marked-alt me-2"></i>Browse Destinations
                </a>
            </div>
        </div>
    </div>
</div>
@endsection