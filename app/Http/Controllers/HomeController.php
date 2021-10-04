<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class HomeController extends Controller
{
    public function index()
    {
        $product = DB::table('product')->where('active',1)->limit(8)->orderBy('id', 'desc')->get();
        return view('page/home/home')
        ->with(['title'=>'Trang chủ',
                'product'=>$product]);
    }
}
