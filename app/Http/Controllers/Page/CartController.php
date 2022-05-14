<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Cart;
use Illuminate\Http\Request;
use Session;
use Response;
use DB;

class CartController extends Controller
{
    public function __construct()
    {
        session_start();
    }
    public function store_cart(Request $request)
    {
        if ($request->quantity <= 0){
            return Response::json(array(
                'success' => false,
                'error' => 'Số lượng sản phẩm bắt buộc lớn hơn 0'
            ));
        }
        $data=[
            'id'=>$request->id,
            'name'=>$request->name,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
            'thumb'=>$request->thumb,
        ];
        Cart::add($data['id'], $data['name'], $data['quantity'], $data['price'], $data['id'], ['thumb'=>$data['thumb']]);
        //Cart::destroy();
        return Response::json(array(
            'success' => true,
        ));
    }
    public function show_cart()
    {
        return view('page/cart/cart')
        ->with(['title'=>'Giỏ hàng']);
    }
    public function delete_cart($rowId)
    {
        Cart::update($rowId, 0);
        return redirect()->route('show_cart');
    }
    public function update_cart($rowId, Request $request)
    {
        $messages = [
            'quantity.required' => 'Vui lòng nhập số lượng',
            'quantity.numeric' => 'Vui lòng nhập số lượng',
            'quantity.min' => 'Vui lòng nhập số lượng lớn hơn 0',
        ];
        //các loại định dạng bắt buộc khi nhập
        $request->validate([
            'quantity' => 'required|numeric|min:0.1',
        ], $messages);
        Cart::update($rowId, $request->quantity);
        return redirect()->route('show_cart');
    }
    public function check_voucher(Request $request){
        if (Cart::count() == 0) {
            return Response::json(array(
                'success' => false,
                'error' => 'Mời chọn sản phẩm',
            ));
            exit();
        }
        if (!empty($request->voucher_code)){
            $user_id = $_SESSION["id"];
            $customer_type = DB::table('customer')
                ->where('id', $user_id)
                ->first()
                ->customer_type;
            $account_voucher = DB::table('voucher')
                ->get();
////            ->where('customer_id', $user_id)
//                ->where('is_deleted', 0)
//                ->where('active', 1)
//                ->whereNotIn('ID', function($query) {
//                    $query->select('voucher_id')
//                        ->from('use_voucher')
//                        ->where('customer_id', $_SESSION['id']);
//                })
//                ->where('quantity', '>', 0)
//                ->where('customer_type', $customer_type)
//                ->where('is_deleted', 0)
//                ->where('active', 1)
//                ->whereNotIn('ID', function($query) {
//                    $query->select('voucher_id')
//                        ->from('use_voucher')
//                        ->where('customer_id', $_SESSION['id']);
//                })
//                ->where('quantity', '>', 0)
//                ->orWhere('customer_type', 0)
//                ->where('is_deleted', 0)
//                ->where('active', 1)
//                ->whereNotIn('ID', function($query) {
//                    $query->select('voucher_id')
//                        ->from('use_voucher')
//                        ->where('customer_id', $_SESSION['id']);
//                })
//                ->where('quantity', '>', 0)
//                ->orWhere('customer_id', $_SESSION['id']);
            $check_voucher = 0;
            foreach($account_voucher as $key=>$value){
                if ($value->code == $request->voucher_code){
                    $check_voucher = 1;
                }
            }
            if ($check_voucher == 0 ){
                return Response::json(array(
                    'success' => false,
                    'error' => 'Voucher không hợp lệ',
                ));
            }
            else {
                $voucher = DB::table('voucher')->where('code', $request->voucher_code)->first();
                $_SESSION['voucher_id'] = $voucher->ID;

                if($voucher->unit=="%")
                {
                    Cart::setGlobalDiscount($voucher->value);
                }
                else if ($voucher->unit=="VNĐ"){
                    $discountRate = $voucher->value/Cart::initial(0,'','')*100;
                    Cart::setGlobalDiscount($discountRate);
                }
                return Response::json(array(
                    'success' => true,
                ));
            }
        }
        else{
            return Response::json(array(
                'success' => true,
            ));
        }
    }
}
