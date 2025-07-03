<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;
    protected $fillable = [
        'paragraph1',
        'paragraph2',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
