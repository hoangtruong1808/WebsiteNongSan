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

Route::prefix('/admin')->group(function(){

    Route::get('', function(){
        return view('/admin/main')->with(['title'=>'Giao diện admin']);
    });

    Route::prefix('/menu')->group(function(){

        Route::get('/create',[App\Http\Controllers\Admin\MenuController::class, 'create'])->name('menu_create');

        Route::post('/store',[App\Http\Controllers\Admin\MenuController::class, 'store'])->name('menu_store');

        Route::get('/show',[App\Http\Controllers\Admin\MenuController::class, 'show'])->name('menu_show');

        Route::get('/edit/{menu_id}',[App\Http\Controllers\Admin\MenuController::class, 'edit'])->name('menu_edit');

        Route::post('/update/{menu_id}',[App\Http\Controllers\Admin\MenuController::class, 'update'])->name('menu_update');

        Route::get('/destroy/{menu_id}',[App\Http\Controllers\Admin\MenuController::class, 'destroy'])->name('menu_destroy');
    
    });

    Route::prefix('/product')->group(function(){

        Route::get('/create',[App\Http\Controllers\Admin\ProductController::class, 'create'])->name('product_create');

        Route::post('/store',[App\Http\Controllers\Admin\ProductController::class, 'store'])->name('product_store');

        Route::get('/show',[App\Http\Controllers\Admin\ProductController::class, 'show'])->name('product_show');

        Route::get('/edit/{product_id}',[App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('product_edit');

        Route::post('/update/{product_id}',[App\Http\Controllers\Admin\ProductController::class, 'update'])->name('product_update');

        Route::get('/destroy/{product_id}',[App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('product_destroy');
    
    });

    Route::prefix('/order')->group(function(){

        Route::get('',[App\Http\Controllers\Admin\OrderController::class, 'order_show'])->name('order_show');
    
        Route::get('/order-detail/{order_id}',[App\Http\Controllers\Admin\OrderController::class, 'order_detail_show'])->name('order_detail_show');

        Route::get('/shchecked/{order_id}',[App\Http\Controllers\Admin\OrderController::class, 'order_shipping_status'])->name('order_shipping_status');

        Route::get('/checked/{order_id}',[App\Http\Controllers\Admin\OrderController::class, 'order_checked_status'])->name('order_checked_status');

        Route::get('/export-excel/{order_id}',[App\Http\Controllers\Admin\OrderController::class, 'export_excel'])->name('export_excel');
    });

    Route::prefix('/khachhang')->group(function(){
    
        Route::get('/danh-sach',[App\Http\Controllers\Admin\CustomerController::class, 'customer_show'])->name('customer_show');

        Route::get('/chi-tiet/{customer_id}',[App\Http\Controllers\Admin\CustomerController::class, 'customer_detail'])->name('customer_detail');
    });

    Route::get('/message',[App\Http\Controllers\Admin\MessageController::class, 'message_show'])->name('message_show');

    Route::prefix('/post')->group(function(){
    
        Route::get('/danh-sach',[App\Http\Controllers\Admin\PostController::class, 'post_show'])->name('post_show');

        Route::get('/duyet/{post_id}',[App\Http\Controllers\Admin\PostController::class, 'post_approve'])->name('post_approve');

        Route::get('/khong-duyet/{post_id}',[App\Http\Controllers\Admin\PostController::class, 'post_cancel'])->name('post_cancel');
    });
});
