<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;

class AccountController extends Controller
{
    public function __construct()
    {
        session_start();
    }
    public function show_account()
    {
        $user_id = $_SESSION["id"];
        $account = DB::table('customer')
                ->where('id', $user_id)
                ->first();
        return view('page/account/show_account')
        ->with([
                'title'=>'Tài khoản',
                'account'=>$account,
            ]);
    }
    public function update_account(Request $request)
    {
        $messages = [
            'name.required' => 'Họ tên bắt buộc nhập',
            'address.required' => 'Địa chỉ bắt buộc nhập',
            'phone.required' => 'Số điện thoại bắt buộc nhập',
            'phone.numeric' => 'Số điện thoại  nhập đúng định dạng',
            'email.required' => 'Email bắt buộc nhập',
            'password.required' => 'Mật khẩu bắt buộc nhập',
        ];
        //các loại định dạng bắt buộc khi nhập
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone'=>'required',
            'phone'=>'numeric',
        ], $messages);
        $user_id = $_SESSION["id"];
        $password = bcrypt($request->password);
        $customer_id = DB::table('customer')
        ->where('id', $user_id)
        ->update([
            'name'=>$request->name,
            'address'=>$request->address,
            'email'=>$request->email,
            'password'=>$password,
            'phone'=>$request->phone,
        ]);
        $account = DB::table('customer')
        ->where('id', $user_id)
        ->first();
        Session::flash('message','Thay đổi thông tin thành công!');
        return view('page/account/show_account')
        ->with([
                'title'=>'Tài khoản',
                'account'=>$account,
            ]);
    }
    public function order_history()
    {
        $user_id = $_SESSION["id"];
        $order_history = DB::table('order')
            ->where('customer_id', $user_id)
            ->get();
        $order_history = DB::table('order')
            ->join('shipping', 'shipping.id', '=', 'order.shipping_id')
            ->join('payment', 'payment.id', '=', 'order.payment_id')
            ->select('shipping.*', 'payment.method', 'order.*')
            ->where('order.customer_id', $user_id)
            ->get();
        return view('page/account/order_history')
        ->with([
                'title'=>'Lịch sử đặt hàng',
                'order_history' => $order_history,
            ]);
    }
    public function delete_order($order_id)
    {
        DB::table('order_detail')->where('order_id', $order_id)->delete();
        DB::table('order')->where('id', $order_id)->delete();
        Session::flash('message','Hủy đơn hàng thành công!');
        return redirect()->route('order_history');
    }
    public function account_post()
    {
        $user_id = $_SESSION["id"];
        $account_post = DB::table('post')
            ->where('customer_id', $user_id)
            ->get();
        return view('page/account/account_post')
        ->with([
                'title'=>'Tin sản phẩm đăng',
                'account_post' => $account_post,
            ]);
    }
    public function delete_post($post_id)
    {
        DB::table('post')->where('id', $post_id)->delete();
        Session::flash('message','Xóa bài đăng thành công!');
        return redirect()->route('account_post');
    }
    public function chatbot(Request $request)
    {
        $msg = $request->msg;
        $chatbot = DB::table('chatbot')->get();
        foreach ($chatbot as $value)
        {
            $pos = strpos($msg, $value->user);
            if ($pos !== false) {
                Session::flash('message',  $value->chatbot);
            }
        }
        DB::table('message')->insert([
            'customer_id'=>$_SESSION["id"],
            'content'=>$msg,
            'time'=>date('Y-m-d H:i:s'),
        ]);
        return redirect()->route('Home');
    }
}
