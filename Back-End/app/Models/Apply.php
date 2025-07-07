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
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function jobAnnouncement()
    {
        return $this->belongsTo(JobAnnouncement::class);
    }
}
