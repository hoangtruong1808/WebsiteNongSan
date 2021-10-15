<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']) -> name('Home');

Route::get('/danh-muc-san-pham/{menu_id}', [App\Http\Controllers\Page\ProductController::class, 'show_menu_product']) -> name('show_menu_product');

Route::get('/san-pham', [App\Http\Controllers\Page\ProductController::class, 'show_all_product']) -> name('show_all_product');

Route::get('/san-pham/{product_id}', [App\Http\Controllers\Page\ProductController::class, 'show_product_detail']) -> name('show_product_detail');

Route::get('/show-cart', [App\Http\Controllers\Page\CartController::class, 'show_cart']) -> name('show_cart');

Route::post('/store-cart', [App\Http\Controllers\Page\CartController::class, 'store_cart']) -> name('store_cart');

Route::get('/delete-cart/{row_id}', [App\Http\Controllers\Page\CartController::class, 'delete_cart']) -> name('delete_cart');

Route::post('/update-cart/{row_id}', [App\Http\Controllers\Page\CartController::class, 'update_cart']) -> name('update_cart');

Route::get('/dang-nhap', [App\Http\Controllers\Page\CheckoutController::class, 'login']) -> name('login');

Route::post('/store-signout', [App\Http\Controllers\Page\CheckoutController::class, 'store_signout']) -> name('store_signout');

Route::post('/store-login', [App\Http\Controllers\Page\CheckoutController::class, 'store_login']) -> name('store_login');

Route::get('/thanh-toan', [App\Http\Controllers\Page\CheckoutController::class, 'checkout']) -> name('checkout');

Route::post('/store-checkout', [App\Http\Controllers\Page\CheckoutController::class, 'store_checkout']) -> name('store_checkout');