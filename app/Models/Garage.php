<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function UserWishlist()
    {
        return $this->belongsTo(UserWishlist::class, 'vendor_id', 'id');
    }

    public function garageCategory()
    {
        return $this->hasMany(GarageCategory::class, 'garage_id', 'id');
    }

    public function garageTiming()
    {
        return $this->hasMany(GarageTiming::class, 'garage_id', 'id');
    }
    public function garageBids()
    {
        return $this->hasMany(VendorBid::class, 'garage_id', 'id');
    }
    public function garagereview()
    {
        return $this->hasMany(UserReview::class, 'garage_id', 'id');
    }


}
