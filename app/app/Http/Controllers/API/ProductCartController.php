<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\ProductCart;
use App\Models\Cart;


class ProductCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductCart::all();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $action = "Product added to cart";

      $this->validate($request, [
          "product_id" => "int | required",
          "quantity" => "int",
      ]);

      $cartId = $request->get("cart_id");
      $productId = $request->get("product_id");
      $quantity = $request->get("quantity");

      //check if cart exist
      $cart = Cart::find($cartId);
      //if cart is not created, first create
      if(empty($cartId) || empty($cart)) {
        $cart = new CartsController();
        $cartResult = $cart->create();
        $cartId = $cartResult->getData()->id;
      }

      //check if record already exist
      $product = ProductCart::where("cart_id",$cartId)->where("product_id",$productId)->get();

        if(!empty($product->count())) {

          $poructObj = $product->toArray();
          $quantity = $poructObj[0]["quantity"] + $quantity;
          //init product collection
          $product = ProductCart::find($poructObj[0]["id"]);
          $action = "Product updated to cart";

        } else {
          // If not exist create new one record
          $product = new ProductCart;
          $product->product_id = $productId;
          $product->cart_id = $cartId;
          $product->setAttribute("user_ip",UtilityController::get_client_ip());

        }

      $product->quantity = $quantity;
      $product->save();

      $response = response()->json($product);
      UtilityController::info_logging("Product",array(
        'text' => $response,
        'action'  => $action,
      ));

      return $response;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
      $product = ProductCart::findOrFail($id);
      $product->delete();

      $response = response()->json($product);
      UtilityController::info_logging("Product",array(
        'text' => $response,
        'action'  => "Product removed to cart",
      ));

      return $response;
    }
}
