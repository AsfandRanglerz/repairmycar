<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GarageTiming extends Model
{
    use HasFactory;

    protected $fillable = [
        'garage_id', 'day', 'from', 'to', 'closed',
    ];
}
