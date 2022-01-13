<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'sku',
        'name',
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
    * Set price to standard conversion price
    *
    * @param float $value price
    * @return void
    */
    public function setPriceAttribute($value) {

      $this->attributes['price'] = str_replace(",",".",$value);
    }

    /**
    * Convert price to IT price
    *
    * @param string|int $value price
    * @return string
    */
    public function getPriceAttribute($value) {
       $peice = number_format(round((float)$value,2),2) . " €";
       $price = str_replace(".",",",$peice);
       return array("label" => $price, "price" => $value);
    }
}
