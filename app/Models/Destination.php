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
        'status'
    ];

    protected $casts = [
        'price' => 'integer',
        'rating' => 'float',
        'hotels_count' => 'integer',
        'attractions' => 'array', // ✅ ADD THIS
        'nearby_areas' => 'array', // ✅ ADD THIS
        'travel_tips' => 'array', // ✅ ADD THIS
    ];
}