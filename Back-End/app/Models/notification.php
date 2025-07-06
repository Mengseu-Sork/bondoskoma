<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    use HasFactory;
    // app/Models/Notification.php

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    protected $fillable = ['contact_id'];
}
