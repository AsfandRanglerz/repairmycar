<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug', 'image', 'priority','position',
    ];

    public function subcategory(){
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }

    public function categoryGarage()
    {
        return $this->hasMany(GarageCategory::class, 'category_id', 'id');
    }
}
