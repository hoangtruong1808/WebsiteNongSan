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
