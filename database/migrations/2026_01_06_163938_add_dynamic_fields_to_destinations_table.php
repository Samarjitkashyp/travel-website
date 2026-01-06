<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            // Hero Section
            $table->string('hero_image')->nullable();
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            
            // Key Highlights & Best For
            $table->json('key_highlights')->nullable();
            $table->json('best_for_tags')->nullable();
            
            // Top Attractions (Detailed)
            $table->json('attractions_details')->nullable();
            
            // Other Popular Places
            $table->json('popular_places')->nullable();
            
            // Hotels (Structured Data)
            $table->json('hotels_data')->nullable();
            
            // Nearby Areas (Detailed)
            $table->json('nearby_areas_detailed')->nullable();
            
            // More Nearby Destinations
            $table->json('more_nearby_destinations')->nullable();
            
            // Photo Gallery
            $table->json('gallery_images')->nullable();
            
            // Travel Tips & FAQ
            $table->json('travel_tips_faq')->nullable();
            
            // Quick Facts
            $table->json('quick_facts')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn([
                'hero_image', 'hero_title', 'hero_subtitle',
                'key_highlights', 'best_for_tags', 'attractions_details',
                'popular_places', 'hotels_data', 'nearby_areas_detailed',
                'more_nearby_destinations', 'gallery_images',
                'travel_tips_faq', 'quick_facts'
            ]);
        });
    }
};