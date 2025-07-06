<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['image_file', 'description'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'image_file'
    ];

    // Include custom attributes in API response
    protected $appends = ['image_url', 'created_at_formatted']; 

    // Accessor for full image URL
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_file);
    }

    // Accessor for formatted created_at
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at ? $this->created_at->format('d-M-y') : null;
    }
}
