<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBidImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_bid_id', 'car_image',
    ];
}
