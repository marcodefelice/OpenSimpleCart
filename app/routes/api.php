<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CartsController;
use App\Http\Controllers\API\ProductsController;
use App\Http\Controllers\API\ProductCartController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// API for Product and Cart
Route::group(['middleware' => ['customapi']], function () {
  Route::resource('productscart', ProductCartController::class);
  Route::resource('carts', CartsController::Class);
  Route::get('products', [ProductsController::Class, "index"]);
});
