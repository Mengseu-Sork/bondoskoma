<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donet extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'is_monthly',
        'payment_method',
        'first_name',
        'last_name',
        'email',
        'status',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_DELETED = 'deleted';
    protected $casts = [
        'is_monthly' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isConfirmed()
    {
        return $this->status === self::STATUS_CONFIRMED;
    }

    public function isDeleted()
    {
        return $this->status === self::STATUS_DELETED;
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
