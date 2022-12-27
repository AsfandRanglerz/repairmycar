<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'car_model'
    ];
    public function company()
    {
        return $this->belongsto(Company::class,'company_id');
    }

}
