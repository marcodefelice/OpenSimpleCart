<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'hash',
        'user_ip',
        'id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'published_at'
    ];

    /**
     * For GDPR convert in has ipd address.
     *
     * @param  string  $value
     * @return string
     */
    public function setUserIpAttribute($value)
    {
        $this->attributes['user_ip'] = hash("sha256",$value);
    }

    /**
     * Get the products for the cart.
     * @return object
     */
    public function products()
    {
        return $this->hasMany(ProductCart::class);
    }

}
