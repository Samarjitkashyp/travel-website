<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'duration',
        'location',
        'original_price',
        'discounted_price',
        'discount_percentage',
        'image',
        'description',
        'inclusions',
        'status'
    ];

    protected $casts = [
        'original_price' => 'integer',
        'discounted_price' => 'integer',
        'discount_percentage' => 'integer',
        'inclusions' => 'array',
    ];

    public function getInclusionsListAttribute()
    {
        return is_array($this->inclusions) ? $this->inclusions : [];
    }
}