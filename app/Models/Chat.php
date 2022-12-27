<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = [ ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_sender_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_sender_id', 'id');
    }
}
