<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Home extends Model
{
    protected $fillable = [
        'paragraph1',
        'paragraph2',
        'image',
    ];
     protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }
}
