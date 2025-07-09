<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'role',
        'bio',
        'image',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $appends = [
        'image_url',
    ]; 
    public function getImageUrlAttribute()
    {
        return $this->image ? asset($this->image) : null;
    }
}
