<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Response;

class ProductController extends Controller
{
    public function __construct()
    {
        session_start();
    }
    public function show_all_product()
    {
        $menu_id = 0;
        if (isset($_GET['menu_id']))
        {
            $menu_id = $_GET['menu_id'];
        }
        $menu_name = DB::table('menu')
                ->select('name', 'id')
                ->where('active',1)
                ->where('is_deleted',0)
                ->get();
        $product_count = DB::table('product')
                    ->count();
        $page_number = floor($product_count/12) +1;
        return view('page/product/menu_product')
        ->with([
            'title' => 'Danh sách sản phẩm',
            'menu'=>$menu_name,
            'page_number'=>$page_number,
            'menu_id'=>$menu_id,
        ]);
    }
    public function show_menu_product($menu_id)
    {
        $menu_name = DB::table('menu')->select('name', 'id')->get();
        $product = DB::table('product')
            ->where('menu_id', $menu_id)
            ->orderBy('id', 'desc')
            ->paginate(8);
        return view('page/product/menu_product')
            ->with([
                'title' => 'Danh sách sản phẩm',
                'menu'=>$menu_name,
                'product'=>$product,
                'menu_id'=>$menu_id,
            ]);
    }
    public function get_data_product()
    {
        $product =[];
        $menu_id = 0;
        if (isset($_GET['menu_id']) && $_GET['menu_id']!=0 ){
            $menu_id = $_GET['menu_id'];
            $products = DB::table('product')
                ->orderBy('id', 'desc')
                ->where('menu_id', $menu_id)
                ->where('is_deleted', 0)
                ->paginate(12);
        }
        else if (isset($_GET['query']) && $_GET['query']!="" ){
            $key_search_string = $_GET['query'];
            $key_search = explode(',', $key_search_string);
            $query ="";
            foreach ($key_search as $key=>$value ){
                $query.= "name LIKE '%$value%' OR ";
            }
            $query = chop($query,"OR ");
//            var_dump($query);
            $products = DB::table('product')
                ->orderBy('id', 'desc')
                ->whereRaw($query)
                ->where('is_deleted', 0)
                ->paginate(12);
        }
        else{
            $products = DB::table('product')
                ->orderBy('id', 'desc')
                ->where('is_deleted', 0)
                ->paginate(12);
        }
        if (isset($_SESSION['id'])) {
            foreach($products as $key=>$item)
            {
                $favorite = [];
                $favorite = DB::table('favorite')
                    ->where('customer_id', $_SESSION['id'])
                    ->where('product_id', $item->id)
                    ->get();
                if (count($favorite) >= 1){
                    $products[$key]->is_favorite = 1;
                }
                else{
                    $products[$key]->is_favorite = 0;
                }
            }
        }
        $product_count = $products->count();
        $page_number = floor($product_count/12) +1;

        foreach ($products as $key=>$value)
        {
            $product[$key]['id'] = $value->id;
            $product[$key]['name'] = $value->name;
            $product[$key]['price'] = number_format($value->price);
            $product[$key]['unit'] = $value->unit;
            $product[$key]['thumb'] = $value->thumb;
            if (isset($_SESSION['id'])) {
                $product[$key]['is_favorite'] = $value->is_favorite;
            }
        }
        $data['product'] = $product;
        $data['page_number'] = $page_number;
        $data['menu_id'] = $menu_id;
        return Response::json($data);

    }
    public function search_product($menu_id, Request $request)
    {
        $key = $request->key;

        $menu_name = DB::table('menu')->select('name', 'id')->get();
        if ($menu_id == 0)
        {
            $product = DB::table('product')
                ->where('name', 'like', $key.'%')
                ->paginate(8);
        }
        else{
            $product = DB::table('product')
                ->where('menu_id', $menu_id)
                ->where('name', 'like', $key.'%')
                ->paginate(8);
        }

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
                ->where('product.id', $product_id)
                ->join('warehouse', 'product.id', '=', 'warehouse.product_id')
                ->first();

        $related_product = DB::table('product')
                        ->where('active',1)
                        ->where('menu_id', $product->menu_id)
                        ->limit(4)
                        ->where('is_deleted', 0)
                        ->get();
        if (isset($_SESSION['id'])) {
            $favorite = DB::table('favorite')
                ->where('customer_id', $_SESSION['id'])
                ->where('product_id', $product_id)
                ->get();
            if (count($favorite) >= 1){
                $product->is_favorite = 1;
            }
            else{
                $product->is_favorite = 0;
            }
            foreach($related_product as $key=>$item)
            {
                $favorite = [];
                $favorite = DB::table('favorite')
                    ->where('customer_id', $_SESSION['id'])
                    ->where('product_id', $item->id)
                    ->get();
                if (count($favorite) >= 1){
                    $related_product[$key]->is_favorite = 1;
                }
                else{
                    $related_product[$key]->is_favorite = 0;
                }
            }


        }
        $comment = DB::table('comment')
                ->where('comment.product_id', $product_id)
                ->where('comment.is_deleted', 0)
                ->join('customer', 'comment.customer_id', '=', 'customer.id')
                ->limit(4)
                ->orderBy('comment.id', 'ASC')
                ->get();
        return view('page/product/product_detail')
        ->with([
            'title' => 'Chi tiết sản phẩm',
            'product'=>$product,
            'related_product'=>$related_product,
            'comment'=>$comment
        ]);
    }
    public function comment_product(Request $request){
        if ($request->comment==NULL){
            return Response::json(array(
                'success' => false,
                'error' => 'Vui lòng nhập bình luận',
            ));
        }
        $insert = DB::table('comment')->insert([
            'content'=>$request->comment,
            'product_id'=>$request->product_id,
            'customer_id'=>$request->customer_id,
            'date'=>date("d/m/Y"),
        ]);
        $customer = DB::table('customer')
                    ->where('id', $request->customer_id)
                    ->first();
        $data['name'] = $customer->name;
        $data['date'] = date("d/m/Y");
        if ($insert == true){
            return Response::json(array(
                'success' => true,
                'data'=>$data,
            ));
        }
        else {
            return Response::json(array(
                'success' => false,
                'error' => 'Xảy ra lỗi khi bình luận',
            ));
        }
    }
    public function favorite_product(Request $request){
        if ($request->favorite_type == 'add-favorite')
        {
            $insert = DB::table('favorite')->insert([
                'product_id'=>$request->product_id,
                'customer_id'=>$_SESSION['id'],
            ]);
            if ($insert == true){
                return Response::json(array(
                    'success' => true,
                ));
            }
            else {
                return Response::json(array(
                    'success' => false,
                    'error' => 'Xảy ra lỗi khi yêu thích',
                ));
            }
        }
        else {
            $delete = DB::table('favorite')
                ->where('product_id', $request->product_id)
                ->where('customer_id', $_SESSION['id'])
                ->delete();
            if ($delete == true){
                return Response::json(array(
                    'success' => true,
                ));
            }
            else {
                return Response::json(array(
                    'success' => false,
                    'error' => 'Xảy ra lỗi khi bỏ yêu thích',
                ));
            }
        }
    }
}
