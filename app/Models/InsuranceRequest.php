<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'customer_id',
        'vendor_bid_id',
        'payment',
    ];



    public function bid()
    {
        return $this->belongsTo(VendorBid::class, 'vendor_bid_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
}
