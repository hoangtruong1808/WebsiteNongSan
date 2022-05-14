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

Route::post('/tim-kiem-san-pham/{menu_id}', [App\Http\Controllers\Page\ProductController::class, 'search_product']) -> name('search_product');

Route::get('/san-pham', [App\Http\Controllers\Page\ProductController::class, 'show_all_product']) -> name('show_all_product');

Route::get('/san-pham-api', [App\Http\Controllers\Page\ProductController::class, 'get_data_product']) -> name('get_data_product');

Route::get('/san-pham/{product_id}', [App\Http\Controllers\Page\ProductController::class, 'show_product_detail']) -> name('show_product_detail');

Route::post('/binh-luan', [App\Http\Controllers\Page\ProductController::class, 'comment_product']) -> name('comment_product');

Route::get('/show-cart', [App\Http\Controllers\Page\CartController::class, 'show_cart']) -> name('show_cart');

Route::post('/store-cart', [App\Http\Controllers\Page\CartController::class, 'store_cart']) -> name('store_cart');

Route::get('/delete-cart/{row_id}', [App\Http\Controllers\Page\CartController::class, 'delete_cart']) -> name('delete_cart');

Route::post('/update-cart/{row_id}', [App\Http\Controllers\Page\CartController::class, 'update_cart']) -> name('update_cart');

Route::post('/check_voucher', [App\Http\Controllers\Page\CartController::class, 'check_voucher']) -> name('check_voucher');

Route::get('/dang-nhap', [App\Http\Controllers\Page\CheckoutController::class, 'login']) -> name('login');

Route::get('/dang-xuat', [App\Http\Controllers\Page\CheckoutController::class, 'logout']) -> name('logout');

Route::post('/store-signout', [App\Http\Controllers\Page\CheckoutController::class, 'store_signout']) -> name('store_signout');

Route::post('/store-login', [App\Http\Controllers\Page\CheckoutController::class, 'store_login']) -> name('store_login');

Route::get('/thanh-toan', [App\Http\Controllers\Page\CheckoutController::class, 'checkout']) -> name('checkout');

Route::post('/store-checkout', [App\Http\Controllers\Page\CheckoutController::class, 'store_checkout']) -> name('store_checkout');

Route::get('/xac-nhan-thanh-toan', [App\Http\Controllers\Page\CheckoutController::class, 'confirm_checkout']) -> name('confirm_checkout');

Route::post('/update-cart/{row_id}', [App\Http\Controllers\Page\CartController::class, 'update_cart']) -> name('update_cart');

Route::get('/tai-khoan', [App\Http\Controllers\Page\AccountController::class, 'show_account']) -> name('account');

Route::post('/tai-khoan', [App\Http\Controllers\Page\AccountController::class, 'update_account']) -> name('update_account');

Route::post('/chat-bot', [App\Http\Controllers\Page\AccountController::class, 'chatbot']) -> name('chatbot');

Route::get('/lich-su-dat-hang', [App\Http\Controllers\Page\AccountController::class, 'order_history']) -> name('order_history');

Route::get('/san-pham-dang-tin', [App\Http\Controllers\Page\AccountController::class, 'account_post']) -> name('account_post');

Route::get('/san-pham-can-ban', [App\Http\Controllers\Page\PostController::class, 'product_sale']) -> name('product_sale');

Route::get('/san-pham-can-mua', [App\Http\Controllers\Page\PostController::class, 'product_buy']) -> name('product_buy');

Route::get('/ma-khuyen-mai', [App\Http\Controllers\Page\AccountController::class, 'show_voucher']) -> name('show_voucher');

Route::get('/huy-don-hang/{order_id}',[App\Http\Controllers\Page\AccountController::class, 'delete_order'])->name('delete_order');

Route::get('/vong-quay-may-man',[App\Http\Controllers\Page\AccountController::class, 'rotate'])->name('rotate');

Route::post('/vong-quay-may-man',[App\Http\Controllers\Page\AccountController::class, 'store_rotate'])->name('store_rotate');


