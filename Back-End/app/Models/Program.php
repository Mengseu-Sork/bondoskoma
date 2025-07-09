<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Program extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    // Automatically append this attribute when returning JSON
    protected $appends = ['image_url'];

    /**
     * Accessor to get the full image URL
     */
    public function getImageUrlAttribute()
    {
        // Return full image URL or null if not set
        return $this->image ? Storage::url($this->image) : null;
    }
}
