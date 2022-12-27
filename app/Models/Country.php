<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prologue\Alerts\Facades\Alert;

class Country extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'code';

	/**
	 * The "type" of the primary key ID.
	 *
	 * @var string
	 */
	protected $keyType = 'string';

    public $incrementing = false;
    protected $appends = ['icode'];
    protected $visible = [
    	'code',
		'name',
		'asciiname',
		'icode',
		'iso3',
		'currency_code',
		'phone',
		'languages',
		'currency',
		'time_zone',
		'date_format',
		'datetime_format',
		'background_image',
	];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    // public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'asciiname',
        'capital',
        'continent_code',
        'tld',
        'currency_code',
        'phone',
        'languages',
		'time_zone',
		'date_format',
		'datetime_format',
		'background_image',
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    // protected $hidden = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'created_at'];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

	public function users()
	{
		return $this->hasMany(User::class, 'country_code')->orderBy('created_at', 'DESC');
	}

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public function getIcodeAttribute()
    {
        return strtolower($this->attributes['code']);
    }

    public function getIdAttribute($value)
    {
        return $this->attributes['code'];
    }


}
