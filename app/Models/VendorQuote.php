<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorQuote extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'user_bit_id', 'user_id','vendor_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');

    }
    public function userbid()
    {
        return $this->belongsTo(UserBid::class, 'user_bit_id', 'id');

    }



}
