<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug', 'category_id', 'priority',
    ];

    public function category()
    {
        return $this->hasMany(Category::class, 'category_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function childCategory(){
        return $this->hasMany(ChildCategory::class, 'subcategory_id', 'id');
    }
}
