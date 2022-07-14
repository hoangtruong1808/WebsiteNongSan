<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;

class HomeController extends Controller
{
    public function __construct()
    {
        session_start();
    }
    public function index()
    {
        $product = DB::table('product')
            ->where('product.active',1)
            ->limit(8)
            ->orderBy('product.id', 'desc')
            ->where('product.is_deleted', 0)
            ->get();

        $best_seller = DB::table('order_detail')
            ->selectRaw('product.*, sum(order_detail.quantity) as sum')
            ->groupBy('order_detail.product_id')
            ->orderByRaw('sum(quantity) DESC')
            ->join('product', 'product.id', '=', 'order_detail.product_id')
            ->join('order', 'order.id', '=', 'order_detail.order_id')
            ->where('order.status', 'Đã nhận hàng')
            ->limit('4')
            ->get();

        if (isset($_SESSION['id'])) {
            foreach($product as $key=>$item)
            {
                $favorite = [];
                $favorite = DB::table('favorite')
                    ->where('customer_id', $_SESSION['id'])
                    ->where('product_id', $item->id)
                    ->get();
                if (count($favorite) >= 1){
                    $product[$key]->is_favorite = 1;
                }
                else{
                    $product[$key]->is_favorite = 0;
                }
            }

            foreach($best_seller as $key=>$item)
            {
                $favorite = [];
                $favorite = DB::table('favorite')
                    ->where('customer_id', $_SESSION['id'])
                    ->where('product_id', $item->id)
                    ->get();
                if (count($favorite) >= 1){
                    $best_seller[$key]->is_favorite = 1;
                }
                else{
                    $best_seller[$key]->is_favorite = 0;
                }
                $discount = DB::table('discount')
                    ->where('product_id', $item->id)
                    ->where('is_deleted', 0)
                    ->where('active', 1)
                    ->first();
                if (isset($discount)){
                    $best_seller[$key]->discount = $discount->value;
                }
            }
        }
        foreach($product as $key=>$item)
        {
            $discount = DB::table('discount')
                ->where('product_id', $item->id)
                ->where('is_deleted', 0)
                ->where('active', 1)
                ->first();
            if (isset($discount)){
                $product[$key]->discount = $discount->value;
            }
        }
        foreach($best_seller as $key=>$item)
        {
            $discount = DB::table('discount')
                ->where('product_id', $item->id)
                ->where('is_deleted', 0)
                ->where('active', 1)
                ->first();
            if (isset($discount)){
                $best_seller[$key]->discount = $discount->value;
            }
        }
        DB::table('voucher')
            ->whereRaw("date_end<CURRENT_TIMESTAMP  OR quantity=0")
            ->where('voucher_type', 1)
            ->update([
                'active'=>2,
            ]);
        DB::table('voucher')
            ->whereRaw("date_start>CURRENT_TIMESTAMP")
            ->where('voucher_type', 1)
            ->update([
                'active'=>3,
            ]);
        DB::table('voucher')
            ->whereRaw("date_start<CURRENT_TIMESTAMP  AND date_end>CURRENT_TIMESTAMP  AND quantity>0")
            ->where('voucher_type', 1)
            ->update([
                'active'=>1,
            ]);
        DB::table('warehouse_product')
            ->whereRaw("expiry_date<CURRENT_TIMESTAMP")
            ->update([
                'quantity'=>0,
            ]);
        DB::table('warehouse_product')
            ->whereRaw("quantity=0")
            ->update([
                'status'=>0,
            ]);
        return view('page/home/home')
        ->with(['title'=>'Trang chủ',
                'product'=>$product,
                'best_seller'=>$best_seller]);
    }
    public function test_chatbot()
    {
        return view('page/home/test_chatbot');
    }


}
