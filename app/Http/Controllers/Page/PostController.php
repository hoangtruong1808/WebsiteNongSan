<?php

namespace App\Http\Controllers\page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;

class PostController extends Controller
{
    public function __construct()
    {
        session_start();
    }
    public function product_sale()
    {
        $product_sale = DB::table('post')
            ->where('method', 'Cần bán')
            ->where('status', 'Đã duyệt')
            ->orderBy('id', 'DESC')
            ->get();
        return view('page/post/product_sale')->with([
            'title'=>'Cần bán',
            'product_sale'=>$product_sale,
        ]);
    }
    public function product_buy()
    {
        $product_buy = DB::table('post')
            ->where('method', 'Cần mua')
            ->where('status', 'Đã duyệt')
            ->orderBy('id', 'DESC')
            ->get();
        return view('page/post/product_buy')->with([
            'title'=>'Cần mua',
            'product_buy'=>$product_buy,
    ]);
    }
    public function post_product()
    {
        return view('page/post/post_product')->with([
            'title'=>'Đăng tin cần bán - cần mua',
        ]);
    }
    public function post_product_process(Request $request)
    {
        DB::table('post')->insert([
            'name'=>$request->name,
            'product'=>$request->product,
            'method'=>$request->method,
            'group'=>$request->group,
            'price'=>$request->price,
            'averageyield'=>$request->averageyield,
            'note'=>$request->note,
            'customer_id'=>$_SESSION['id'],
            'status'=>'Đang chờ xử lý',
        ]);
        Session::flash('message','Đăng tin thành công! Vui lòng chờ quản trị viên duyệt bài đăng!');
        return redirect()->route('post_product');
    }
}
