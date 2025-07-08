<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    use HasFactory;
 
    protected $table = 'applies';
    protected $fillable = [
        'job_announcements_id',
        'name',
        'email',
        'phone',
        'cv_file',
        'cv_path',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function jobAnnouncement()
    {
        return $this->belongsTo(JobAnnouncement::class, 'job_announcements_id');
    }
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
}
