<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'duration',
        'location',
        'destinations',
        'original_price',
        'discounted_price',
        'discount_percentage',
        'image',
        'description',
        'highlights',
        'inclusions',
        'exclusions',
        'itinerary',
        'status',
        'featured'
    ];

    protected $casts = [
        'original_price' => 'integer',
        'discounted_price' => 'integer',
        'discount_percentage' => 'integer',
        'featured' => 'boolean',
        'destinations' => 'array', // ✅ ADD THIS
        'inclusions' => 'array', // ✅ ADD THIS
        'exclusions' => 'array', // ✅ ADD THIS
        'itinerary' => 'array', // ✅ ADD THIS
    ];

    public function getInclusionsListAttribute()
    {
        return is_array($this->inclusions) ? $this->inclusions : [];
    }
}