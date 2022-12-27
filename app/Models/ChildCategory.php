<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug', 'subcategory_id', 'priority',
    ];

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class, 'subcategory_id', 'id');
    }

    public function parentSub()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }
}
