<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/shoping', function () {
//     return view('shoping_cart');
// });
Route::group(['middleware' => ['hasAuth']], function () {

    Route::get('/shoping', [ProductController::class, 'index'])->name('product-list');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
});

Route::post('/auth', [AuthController::class, 'login'])->name('auth-login');

Route::get('/login', function () {
    return view('login');
})->name('login');
