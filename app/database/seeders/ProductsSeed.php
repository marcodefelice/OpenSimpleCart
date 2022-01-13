<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $x = 0;
      while($x <= 10) {
         $product = new Product;
         $product->sku = rand(5,1000);
         $product->name = \Str::random(9);
         $product->description = \Str::random(8). " ". \Str::random(12);
         $product->setAttribute("price",mt_rand(4,50));
         $product->save();
         $x++;
      }
    }
}
