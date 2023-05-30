<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\DiscountApiController;
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

Route::put("/update_qty", [ProductApiController::class, "update_qty"]);
Route::get("/detail", [ProductApiController::class, "detail"]);
Route::get("/coupon_list", [DiscountApiController::class, "list"]);
Route::get("/total_price", [ProductApiController::class, "get_total_price"]);
Route::delete("/delete", [ProductApiController::class, "delete_data"]);
