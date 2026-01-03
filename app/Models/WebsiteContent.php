<?php
// app/Models/WebsiteContent.php - Update karen
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WebsiteContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'section',
        'content',
        'type',
        'image',
        'display_order'
    ];

    const TYPE_TEXT = 'text';
    const TYPE_HTML = 'html';
    const TYPE_IMAGE = 'image';
    const TYPE_JSON = 'json';

    // Accessor for content preview
    public function getContentPreviewAttribute()
    {
        if ($this->type === self::TYPE_IMAGE) {
            return '📷 Image';
        }
        
        if ($this->type === self::TYPE_JSON) {
            return '📋 JSON Data';
        }
        
        return Str::limit($this->content, 50);
    }

    public function getContentAttribute($value)
    {
        if ($this->type === self::TYPE_JSON) {
            return json_decode($value, true);
        }
        return $value;
    }

    public function setContentAttribute($value)
    {
        if ($this->type === self::TYPE_JSON) {
            $this->attributes['content'] = json_encode($value);
        } else {
            $this->attributes['content'] = $value;
        }
    }
}