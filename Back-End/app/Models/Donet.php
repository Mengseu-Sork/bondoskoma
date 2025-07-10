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
        'email'
    ];
    protected $casts = [
        'amount' => 'decimal:2',
        'is_monthly' => 'boolean',
    ];
    protected $table = 'donets';
}
