<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public function show_all_product()
    {
        $menu_name = DB::table('menu')->select('name', 'id')->get();
        $product = DB::table('product')->paginate(12);
        return view('page/product/menu_product')
        ->with([
            'title' => 'Danh sách sản phẩm',
            'menu'=>$menu_name,
            'product'=>$product,
            'menu_id'=>'0',
        ]);
    }
    public function show_menu_product($menu_id)
    {
        $menu_name = DB::table('menu')->select('name', 'id')->get();
        $product = DB::table('product')
                ->where('menu_id', $menu_id)
                ->paginate(12);
        return view('page/product/menu_product')
        ->with([
            'title' => 'Danh sách sản phẩm',
            'menu'=>$menu_name,
            'product'=>$product,
            'menu_id'=>$menu_id,
        ]);
    }
    public function show_product_detail($product_id)
    {
        $product = DB::table('product')
                ->where('id', $product_id)
                ->first();
        $related_product = DB::table('product')
                        ->where('menu_id', $product->menu_id)
                        ->limit(4)
                        ->get();
        return view('page/product/product_detail')
        ->with([
            'title' => 'Chi tiết sản phẩm',
            'product'=>$product,
            'related_product'=>$related_product,
        ]);
    }
}
