<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Destination extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'location',
        'state',
        'category',
        'price',
        'rating',
        'image',
        'description',
        'overview',
        'attractions',
        'nearby_areas',
        'travel_tips',
        'hotels_count',
        'best_time',
        'ideal_duration',
        'type',
        'status',
        // NEW FIELDS
        'hero_image',
        'hero_title',
        'hero_subtitle',
        'key_highlights',
        'best_for_tags',
        'attractions_details',
        'popular_places',
        'hotels_data',
        'nearby_areas_detailed',
        'more_nearby_destinations',
        'gallery_images',
        'travel_tips_faq',
        'quick_facts'
    ];

    protected $casts = [
        'price' => 'integer',
        'rating' => 'float',
        'hotels_count' => 'integer',
        'attractions' => 'array',
        'nearby_areas' => 'array',
        'travel_tips' => 'array',
        // NEW JSON CASTS
        'key_highlights' => 'array',
        'best_for_tags' => 'array',
        'attractions_details' => 'array',
        'popular_places' => 'array',
        'hotels_data' => 'array',
        'nearby_areas_detailed' => 'array',
        'more_nearby_destinations' => 'array',
        'gallery_images' => 'array',
        'travel_tips_faq' => 'array',
        'quick_facts' => 'array',
    ];
}