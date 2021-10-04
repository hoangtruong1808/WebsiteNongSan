<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
            echo ('ok');
        }
        else 
        {
            echo ('not ok');
        }
    }
}
