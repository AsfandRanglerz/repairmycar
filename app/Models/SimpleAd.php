<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpleAd extends Model
{
    use HasFactory;

    protected $fillable = [ ];
    /**
     * Get the user that owns the SimpleAd
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
        return $this->belongsTo(AddPackage::class, 'packages_id');
    }
}
