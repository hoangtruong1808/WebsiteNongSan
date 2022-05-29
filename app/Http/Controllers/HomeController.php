<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

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


        }
        return view('page/home/home')
        ->with(['title'=>'Trang chủ',
                'product'=>$product]);
    }
}
