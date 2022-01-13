<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param boolean $all show all cart if true default: false
     *
     * @return \Illuminate\Http\Response
     */
    public function index($all = false)
    {
      
      if(!$all) {
        $cart = Cart::with("products.product")->where(
          "user_ip",
          hash("sha256",UtilityController::get_client_ip())
          )->get();
      } else {
        $cart = Cart::with("products.product")->get();
      }

      return response()->json($cart);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cart = new Cart();

        $cart->hash = Str::random(15);
        $cart->setAttribute("user_ip",UtilityController::get_client_ip());
        $cart->save();

        $response = response()->json($cart);
        UtilityController::info_logging("Cart",array(
          'text' => $response,
          'action'  => "Cart created",
        ));

        return $response;


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $cart = Cart::find($id);

      $cart->products = $cart->products;

      return response()->json($cart);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        $response = response()->json($cart);
        UtilityController::info_logging("Cart",array(
          'text' => $response,
          'action'  => "Cart deleted",
        ));

        return $response;
    }
}
