<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Vendor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $guard = 'vendor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'landline_no',
        'action',
        'facebook_social_id',
        'google_social_id',
        'image',
        'address',
        'country',
        'city',
        'post_box',
        'longitude',
        'latitude',
        'term_condition',
        'online_status',
        'balance',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $with =[
        'roles',
    ];
    public function garage()
    {
        return $this->HasOne(Garage::class, 'vendor_id', 'id');
    }


    /**
     * The roles that belong to the Vendor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function company()
    {
        return $this->belongsToMany(User::class, 'insurance_vendor', 'vendor_id', 'company_id');

    }


}
