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

});
