<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBid extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'model_id', 'area_id', 'title', 'car_detail', 'document_image', 'accident_detail','offer_status', 'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function services()
    {
        return $this->hasMany(UserBidCategory::class, 'user_bid_id', 'id');
    }
    
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    public function modelYear()
    {
        return $this->belongsTo(ModelYear::class, 'model_year_id', 'id');
    }
    
    public function vendorQuote()
    {
        return $this->belongsTo(VendorQuote::class);
        // note: we can also inlcude Mobile model like: 'App\Mobile'
    }

    public function vendorBid()
    {
        return $this->hasMany(VendorBid::class, 'user_bid_id', 'id');
    }
}

