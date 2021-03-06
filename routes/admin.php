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

    Route::get('/',[App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin_home');

    Route::get('/home',[App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin_home');

    Route::get('/login',[App\Http\Controllers\Admin\LoginController::class, 'index'])->name('admin_login');

    Route::get('/logout',[App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin_logout');

    Route::get('/account',[App\Http\Controllers\Admin\HomeController::class, 'showAccount'])->name('admin_myaccount');

    Route::post('/my_account_store',[App\Http\Controllers\Admin\HomeController::class, 'execAccount'])->name('my_account_store');

    Route::get('/admin_change_password',[App\Http\Controllers\Admin\HomeController::class, 'changePassword'])->name('admin_change_password');

    Route::post('/exec_change_password',[App\Http\Controllers\Admin\HomeController::class, 'execChangePassword'])->name('exec_admin_change_password');

    Route::post('/exec-login',[App\Http\Controllers\Admin\LoginController::class, 'execLogin'])->name('exec_login');

    Route::prefix('/menu')->group(function(){

        Route::get('/create',[App\Http\Controllers\Admin\MenuController::class, 'create'])->name('menu_create');

        Route::post('/store',[App\Http\Controllers\Admin\MenuController::class, 'store'])->name('menu_store');

        Route::get('/show',[App\Http\Controllers\Admin\MenuController::class, 'show'])->name('menu_show');

        Route::get('/edit/{menu_id}',[App\Http\Controllers\Admin\MenuController::class, 'edit'])->name('menu_edit');

        Route::post('/update/{menu_id}',[App\Http\Controllers\Admin\MenuController::class, 'update'])->name('menu_update');

        Route::post('/destroy',[App\Http\Controllers\Admin\MenuController::class, 'destroy'])->name('menu_destroy');

        Route::get('/filter',[App\Http\Controllers\Admin\MenuController::class, 'filter'])->name('menu_filter');

    });

    Route::prefix('/product')->group(function(){

        Route::get('/create',[App\Http\Controllers\Admin\ProductController::class, 'create'])->name('product_create');

        Route::post('/store',[App\Http\Controllers\Admin\ProductController::class, 'store'])->name('product_store');

        Route::get('/show',[App\Http\Controllers\Admin\ProductController::class, 'show'])->name('product_show');

        Route::get('/edit/{product_id}',[App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('product_edit');

        Route::post('/update/{product_id}',[App\Http\Controllers\Admin\ProductController::class, 'update'])->name('product_update');

        Route::post('/destroy',[App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('product_destroy');

        Route::get('/export-qrcode/{product_id}',[App\Http\Controllers\Admin\ProductController::class, 'export_qrcode'])->name('product_export_qrcode');

        Route::get('/filter',[App\Http\Controllers\Admin\ProductController::class, 'filter'])->name('product_filter');
    });

    Route::prefix('/order')->group(function(){

        Route::get('',[App\Http\Controllers\Admin\OrderController::class, 'order_show'])->name('order_show');

        Route::get('/order-detail/{order_id}',[App\Http\Controllers\Admin\OrderController::class, 'order_detail_show'])->name('order_detail_show');

        Route::post('/update_status_order/{order_id}',[App\Http\Controllers\Admin\OrderController::class, 'update_status_order'])->name('update_status_order');

        Route::get('/export-excel/{order_id}',[App\Http\Controllers\Admin\OrderController::class, 'export_excel'])->name('export_excel');

        Route::get('/filter',[App\Http\Controllers\Admin\OrderController::class, 'filter'])->name('order_filter');
    });

    Route::prefix('/khachhang')->group(function(){

        Route::get('/danh-sach',[App\Http\Controllers\Admin\CustomerController::class, 'customer_show'])->name('customer_show');

        Route::get('/chi-tiet/{customer_id}',[App\Http\Controllers\Admin\CustomerController::class, 'customer_detail'])->name('customer_detail');

        Route::get('/khoa-tai-khoan/{customer_id}',[App\Http\Controllers\Admin\CustomerController::class, 'lock_customer'])->name('lock_customer');

        Route::get('/mo-khoa-tai-khoan/{customer_id}',[App\Http\Controllers\Admin\CustomerController::class, 'unlock_customer'])->name('unlock_customer');

        Route::get('/filter',[App\Http\Controllers\Admin\CustomerController::class, 'filter'])->name('customer_filter');
    });

    Route::get('/message',[App\Http\Controllers\Admin\MessageController::class, 'message_show'])->name('message_show');

    Route::prefix('/post')->group(function(){

        Route::get('/danh-sach',[App\Http\Controllers\Admin\LoginController::class, 'post_show'])->name('post_show');

        Route::get('/duyet/{post_id}',[App\Http\Controllers\Admin\LoginController::class, 'post_approve'])->name('post_approve');

        Route::get('/khong-duyet/{post_id}',[App\Http\Controllers\Admin\LoginController::class, 'post_cancel'])->name('post_cancel');
    });

    Route::prefix('/voucher')->group(function(){

        Route::get('/create',[App\Http\Controllers\Admin\VoucherController::class, 'create'])->name('voucher_create');

        Route::post('/store',[App\Http\Controllers\Admin\VoucherController::class, 'store'])->name('voucher_store');

        Route::get('/show',[App\Http\Controllers\Admin\VoucherController::class, 'show'])->name('voucher_show');

        Route::get('/edit/{voucher_id}',[App\Http\Controllers\Admin\VoucherController::class, 'edit'])->name('voucher_edit');

        Route::post('/update/{voucher_id}',[App\Http\Controllers\Admin\VoucherController::class, 'update'])->name('voucher_update');

        Route::post('/destroy',[App\Http\Controllers\Admin\VoucherController::class, 'destroy'])->name('voucher_destroy');

        Route::get('/filter',[App\Http\Controllers\Admin\VoucherController::class, 'filter'])->name('voucher_filter');

    });

    Route::prefix('/voucher')->group(function(){

        Route::get('/create',[App\Http\Controllers\Admin\VoucherController::class, 'create'])->name('voucher_create');

        Route::post('/store',[App\Http\Controllers\Admin\VoucherController::class, 'store'])->name('voucher_store');

        Route::get('/show',[App\Http\Controllers\Admin\VoucherController::class, 'show'])->name('voucher_show');

        Route::get('/edit/{voucher_id}',[App\Http\Controllers\Admin\VoucherController::class, 'edit'])->name('voucher_edit');

        Route::post('/update/{voucher_id}',[App\Http\Controllers\Admin\VoucherController::class, 'update'])->name('voucher_update');

        Route::post('/destroy',[App\Http\Controllers\Admin\VoucherController::class, 'destroy'])->name('voucher_destroy');

        Route::get('/filter',[App\Http\Controllers\Admin\VoucherController::class, 'filter'])->name('voucher_filter');

    });

    Route::prefix('/discount')->group(function(){

        Route::get('/create',[App\Http\Controllers\Admin\DiscountController::class, 'create'])->name('discount_create');

        Route::post('/store',[App\Http\Controllers\Admin\DiscountController::class, 'store'])->name('discount_store');

        Route::get('/show',[App\Http\Controllers\Admin\DiscountController::class, 'show'])->name('discount_show');

        Route::get('/edit/{discount_id}',[App\Http\Controllers\Admin\DiscountController::class, 'edit'])->name('discount_edit');

        Route::post('/update/{discount_id}',[App\Http\Controllers\Admin\DiscountController::class, 'update'])->name('discount_update');

        Route::post('/destroy',[App\Http\Controllers\Admin\DiscountController::class, 'destroy'])->name('discount_destroy');

        Route::get('/filter',[App\Http\Controllers\Admin\DiscountController::class, 'filter'])->name('discount_filter');

    });

    Route::prefix('/staff')->group(function(){

        Route::get('/create',[App\Http\Controllers\Admin\StaffController::class, 'create'])->name('staff_create');

        Route::post('/store',[App\Http\Controllers\Admin\StaffController::class, 'store'])->name('staff_store');

        Route::get('/show',[App\Http\Controllers\Admin\StaffController::class, 'show'])->name('staff_show');

        Route::get('/edit/{staff_id}',[App\Http\Controllers\Admin\StaffController::class, 'edit'])->name('staff_edit');

        Route::post('/update/{staff_id}',[App\Http\Controllers\Admin\StaffController::class, 'update'])->name('staff_update');

        Route::post('/destroy',[App\Http\Controllers\Admin\StaffController::class, 'destroy'])->name('staff_destroy');

        Route::get('/filter',[App\Http\Controllers\Admin\StaffController::class, 'filter'])->name('staff_filter');

        Route::get('/khoa-tai-khoan-nhan-vien/{staff_id}',[App\Http\Controllers\Admin\StaffController::class, 'lock_staff'])->name('lock_staff');

        Route::get('/mo-khoa-tai-khoan-nhan-vien/{staff_id}',[App\Http\Controllers\Admin\StaffController::class, 'unlock_staff'])->name('unlock_staff');


    });

    Route::prefix('/warehouse')->group(function(){

        Route::get('/show',[App\Http\Controllers\Admin\WarehouseController::class, 'show'])->name('warehouse_show');

        Route::post('/filter',[App\Http\Controllers\Admin\WarehouseController::class, 'filter'])->name('warehouse_filter');

        Route::post('/update',[App\Http\Controllers\Admin\WarehouseController::class, 'update'])->name('warehouse_update');

        Route::get('/import_goods',[App\Http\Controllers\Admin\WarehouseController::class, 'import_goods'])->name('import_goods');

        Route::post('/import_goods_store',[App\Http\Controllers\Admin\WarehouseController::class, 'import_goods_store'])->name('import_goods_store');

        Route::get('/product_detail/{product_id}',[App\Http\Controllers\Admin\WarehouseController::class, 'product_detail'])->name('warehouse_product_detail');
    });

    Route::prefix('/turnover')->group(function(){

        Route::get('/product',[App\Http\Controllers\Admin\TurnoverController::class, 'based_on_product'])->name('turnover_based_on_product');

        Route::get('/product-chart',[App\Http\Controllers\Admin\TurnoverController::class, 'product_chart'])->name('turnover_product_chart');

        Route::get('/date',[App\Http\Controllers\Admin\TurnoverController::class, 'based_on_date'])->name('turnover_based_on_date');

        Route::get('/date-chart',[App\Http\Controllers\Admin\TurnoverController::class, 'date_chart'])->name('turnover_date_chart');

        Route::get('/customer',[App\Http\Controllers\Admin\TurnoverController::class, 'based_on_customer'])->name('turnover_based_on_customer');

        Route::get('/customer-chart',[App\Http\Controllers\Admin\TurnoverController::class, 'customer_chart'])->name('turnover_customer_chart');

    });

    Route::prefix('/supplier')->group(function(){

        Route::get('/create',[App\Http\Controllers\Admin\SupplierController::class, 'create'])->name('supplier_create');

        Route::post('/store',[App\Http\Controllers\Admin\SupplierController::class, 'store'])->name('supplier_store');

        Route::get('/show',[App\Http\Controllers\Admin\SupplierController::class, 'show'])->name('supplier_show');

        Route::get('/edit/{supplier_id}',[App\Http\Controllers\Admin\SupplierController::class, 'edit'])->name('supplier_edit');

        Route::post('/update/{supplier_id}',[App\Http\Controllers\Admin\SupplierController::class, 'update'])->name('supplier_update');

        Route::post('/destroy',[App\Http\Controllers\Admin\SupplierController::class, 'destroy'])->name('supplier_destroy');


    });
});
