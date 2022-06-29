<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Cart;
use Illuminate\Http\Request;
use Session;
use Response;
use DB;
use Alert;

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
            $check_voucher = 0;
            $account_voucher = DB::table('voucher')
                ->whereRaw("is_deleted = 0 and active = 1 and quantity > 0 and (voucher_type = 1 or (voucher_type = 2 and customer_id=".$_SESSION['id']."))")
                ->orderBy('ID', 'desc')
                ->get();
            $use_voucher = DB::table('use_voucher')
                ->where('customer_id', $_SESSION['id'])
                ->get();

            foreach($account_voucher as $voucher_key=>$voucher_value){
                foreach($use_voucher as $use_key=>$use_value){
                    if($use_value->voucher_id == $voucher_value->ID){
                        $account_voucher[$voucher_key]->active= 1000;
                    }
                }
            }

            foreach($account_voucher as $key=>$value){
                if ($value->code == $request->voucher_code && $value->active==1){
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
                $_SESSION['is_checkout'] = 1;
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
