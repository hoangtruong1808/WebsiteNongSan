<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Cart;
use Session;
use DB;
use Mail;

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
            return redirect()->route('Home');
        }
        else { 
            Session::flash('error','Sai mật khẩu');
            return redirect()->route('login');
        }
    }
    public function logout()
    {
        session_destroy();
        Cart::destroy();
        return redirect()->route('Home');
    }
    public function signin()
    {
        return view('/page/checkout/login')
        ->with(['title'=>'Đăng nhập']);
    }
    public function store_signout(Request $request)
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
        else return redirect()->route('Home');

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
        else return view('page/checkout/checkout')
        ->with([
            'title'=>'Thanh toán giỏ hàng',
        ]);
    }
    public function store_checkout(Request $request)
    {
        $messages = [
            'name.required' => 'Họ tên bắt buộc nhập',
            'address.required' => 'Địa chỉ bắt buộc nhập',
            'phone.required' => 'Số điện thoại bắt buộc nhập',
            'phone.numeric' => 'Số điện thoại  nhập đúng định dạng',
            'email.required' => 'Email bắt buộc nhập',
            'payment_method.required' => 'Phương thức thanh toán bắt buộc nhập',
        ];
        //các loại định dạng bắt buộc khi nhập
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone'=>'required',
            'phone'=>'numeric',
            'payment_method'=>'required',
        ], $messages);
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
        if(isset($_SESSION['id']))
        {
            $customer_id = $_SESSION['id'];
        }
        else {
            $customer_id = 9999;
        }
        $order_id = DB::table('order')->insertGetId([
            'customer_id'=>$customer_id,
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
        Session::flash('message', 'Cảm ơn quý khách! Qúy khách đã đặt hàng thành công!');
        Cart::destroy();
        return redirect()->route('confirm_checkout');
    }
    public function confirm_checkout()
    {
        $to_name = "Hoàng Thư";
        $to_email = "hoangtruong1808@gmail.com";//send to this email

        $data = array("name"=>"Đơn hàng từ Vegefoods", "body"=>"noi dung body"); //body of mail.blade.php

        Mail::send('page/checkout/mail',$data,function($message) use ($to_name,$to_email){
        $message->to($to_email)->subject('test mail nhé');//send this mail with subject
        $message->from($to_email,$to_name);//send from this mail
        });
        return view('page/checkout/confirm')
        ->with(
                [
                    'title'=>'Hoàn tất thanh toán',
                ]
                );
    }
}
