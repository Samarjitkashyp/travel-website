<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'rating',
        'price',
        'type',
        'image',
        'description',
        'amenities',
        'features',
        'near_location',
        'recommended_percentage',
        'tax_inclusive',
        'status'
    ];

    protected $casts = [
        'price' => 'integer',
        'rating' => 'float',
        'recommended_percentage' => 'integer',
        'amenities' => 'array',
        'features' => 'array',
        'tax_inclusive' => 'boolean',
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