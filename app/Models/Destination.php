<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'state',
        'category',
        'price',
        'rating',
        'image',
        'description',
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
    ];
}