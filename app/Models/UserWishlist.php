<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWishlist extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function garage()
    {
        return $this->belongsTo(Garage::class);
        // note: we can also inlcude Mobile model like: 'App\Mobile'
    }




}
