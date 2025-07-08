<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobAnnouncement extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'posted_date', 'location', 'type',
        'department', 'responsibilities', 'qualifications',
    ];

    public function applies()
    {
        return $this->hasMany(Apply::class);
    }
    
    protected $casts = [
        'responsibilities' => 'array',
        'qualifications' => 'array',
        'posted_date' => 'date',
    ];
    public function getCreatedAtAttribute($value)
    {
        $date = date('d-m-Y', strtotime($value));
        $day = date('l', strtotime($value));
        return $day . ', ' . $date;
    }

    public function getUpdatedAtAttribute($value)
    {
        $date = date('F d, Y', strtotime($value));
        $day = date('l', strtotime($value));
        return $day . ', ' . $date;
    }
    public function getPostedDateAttribute($value)
    {
        return date('d-M-y', strtotime($value));
    }
}
