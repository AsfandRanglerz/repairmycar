<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorBid extends Model
{
    use HasFactory;

    protected $fillable = [
        'garage_id', 'user_bid_id', 'price', 'status','new'
    ];
    public function vendordetail()
    {
        return $this->belongsTo(Garage::class, 'garage_id', 'id');
    }
    public function userBid()
    {
        return $this->belongsTo(UserBid::class, 'user_bid_id', 'id');
    }
    public function order()
    {
        return $this->hasOne(Order::class, 'vendor_bid_id', 'id');
    }
    public function part()
    {
        return $this->hasMany(Part::class, 'vendor_bid_id', 'id');
    }

    public function insurancebid()
    {
        return $this->hasOne(InsuranceRequest::class, 'vendor_bid_id', 'id');
    }
}
