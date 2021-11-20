<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Cart;
use Session;
use DB;

class CheckoutController extends Controller
{
    public function __construct()
    {
        session_start();
    }

    public function login()
    {
        return view('/page/checkout/login')
        ->with(['title'=>'Đăng nhập']);
    }
    public function store_login(Request $request)
    {
        $account = DB::table('customer')->select('id', 'password')
                    ->where('email', $request->email)
                    ->first();
        if (Hash::check($request->password, $account->password))
        {
            $_SESSION['id']= $account->id;
            return redirect()->route('checkout');
        }
        else { 
            Session::flash('error','Sai mật khẩu');
            return redirect()->route('login');
        }
    }
    public function signin()
    {
        return view('/page/checkout/login')
        ->with(['title'=>'Đăng nhập']);
    }
    public function store_signout(Request $request)
    {
        if ($request->password == $request->repassword)
        {
            $password = bcrypt($request->password);
            $customer_id = DB::table('customer')->insertGetId([
                'name'=>$request->name,
                'address'=>$request->address,
                'email'=>$request->email,
                'password'=>$password,
                'phone'=>$request->phone,
            ]);
            $_SESSION["id"] = $customer_id;
            return redirect()->route('checkout');
        }
        else return redirect()->route('login');

    }
    public function checkout()
    {
        if(isset($_SESSION['id']))
        {
            $customer = DB::table('customer')->where('id', $_SESSION['id'])->first();
            return view('page/checkout/checkout')
            ->with([
                'title'=>'Thanh toán giỏ hàng',
                'customer'=>$customer,
            ]);
        }
        else 
        {
            return redirect()->route('login');
        }

    }
    public function store_checkout(Request $request)
    {
        $shipping_id = DB::table('shipping')->insertGetId([
            'name'=>$request->name,
            'address'=>$request->address,
            'email'=>$request->email,
            'note'=>$request->note,
            'phone'=>$request->phone,
            'created_at'=> date('Y-m-d H:i:s'),
        ]);
        $payment_id = DB::table('payment')->insertGetId([
            'method'=>$request->payment_method,
            'status'=>'Đang xử lý',
        ]);
        $order_id = DB::table('order')->insertGetId([
            'customer_id'=>$_SESSION['id'],
            'shipping_id'=>$shipping_id,
            'status'=>'Đang xử lý',
            'total'=>Cart::total(0,"",""),
            'created_at'=> date('Y-m-d H:i:s'),
            'payment_id'=> $payment_id,
        ]);
        foreach(Cart::content() as $key)
        {
            DB::table('order_detail')->insert([
                'product_id'=>$key->id,
                'order_id'=>$order_id,
                'price'=>$key->price,
                'name'=>$key->name,
                'quantity'=> $key->qty,

            ]);
        }
        Cart::destroy();
        return redirect()->route('Home');
    }
}
