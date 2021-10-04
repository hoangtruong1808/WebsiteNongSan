<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Cart;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function __construct()
    {
        session_start();
    }
    public function store_cart(Request $request)
    {
        $data=[
            'id'=>$request->id,
            'name'=>$request->name,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
            'thumb'=>$request->thumb,
        ];
        Cart::add($data['id'], $data['name'], $data['quantity'], $data['price'], $data['id'], ['thumb'=>$data['thumb']]);
        Cart::setGlobalTax(5);
        //Cart::destroy(); 
        return redirect()->route('show_cart');
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
        Cart::update($rowId, $request->quantity);
        return redirect()->route('show_cart');
    }
}
