<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GarageCategory extends Model
{
    use HasFactory;

    protected $fillable = ['garage_id', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function garage()
    {
        return $this->belongsTo(Garage::class, 'garage_id', 'id');
    }
}
