<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'location',
        'rating',
        'price',
        'type',
        'image',
        'description',
        'amenities',
        'features',
        'room_amenities',
        'nearby_attractions',
        'near_location',
        'recommended_percentage',
        'tax_inclusive',
        'free_cancellation',
        'check_in_time',
        'check_out_time',
        'status'
    ];

    protected $casts = [
        'price' => 'integer',
        'rating' => 'float',
        'recommended_percentage' => 'integer',
        'tax_inclusive' => 'boolean',
        'free_cancellation' => 'boolean',
        'amenities' => 'array', // ✅ ADD THIS
        'features' => 'array', // ✅ ADD THIS
        'room_amenities' => 'array', // ✅ ADD THIS
        'nearby_attractions' => 'array', // ✅ ADD THIS
    ];

    public function getAmenitiesListAttribute()
    {
        return is_array($this->amenities) ? $this->amenities : [];
    }

    public function getFeaturesListAttribute()
    {
        return is_array($this->features) ? $this->features : [];
    }
}