<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartListController extends Controller
{
    /**
    * Render web page for cart listi
    *
    */
    public function show_page() {
      $cartList = Cart::with("products.product")->get();

      return  view('carts_list',["carts" => $cartList]);
    }
}
