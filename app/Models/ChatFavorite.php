<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatFavorite extends Model
{
    use HasFactory;
    protected $fillable = [ ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
    public function customerchat()
    {
        return $this->belongsTo(User::class, 'customer_chat', 'id');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

}
