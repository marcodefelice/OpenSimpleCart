<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCart extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = "products_cart";

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'sku',
        'name',
        'user_ip',
        'cart_id',
        'quantity',
        'price'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
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
     * @param  string  $value user ip
     * @return void
     */
    public function setUserIpAttribute($value)
    {
        $this->attributes['user_ip'] = hash("sha256",$value);
    }

    /**
     * Get the product associated.
     */
    public function product()
    {
        return $this->hasOne(Product::class,"id","product_id");
    }

}
