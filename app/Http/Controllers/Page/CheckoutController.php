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
use Response;
use Validator;
use Illuminate\Validation\Rule;
use Alert;

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
        $messages = [
            'email.required' => 'Địa chỉ email bắt buộc nhập',
            'email.email' => 'Địa chỉ email không đúng định dạng',
            'password.required' => 'Mật khẩu bắt buộc nhập',
        ];
        //các loại định dạng bắt buộc khi nhập
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], $messages);

        if ($validator->passes()) {
            $account = DB::table('customer')->select('id', 'password', 'name')
                ->where('email', $request->get('email'))
                ->first();
            if ($account){
                if (Hash::check($request->get('password'), $account->password))
                {
                    $_SESSION['id']= $account->id;
                    $_SESSION['customer_name']= $account->name;
                    return Response::json(array(
                        'success' => true,
                    ));
                }
                else {
                    return Response::json(array(
                        'success' => false,
                        'error'=>['Nhập sai mật khẩu'],
                    ));
                }
            }
            else{
                return Response::json(array(
                    'success' => false,
                    'error'=>['Email không tồn tại'],
                ));
            }

        }

        else{
            return Response::json(array(
                'success' => false,
                'error'=>$validator->errors()->all(),
            ));
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
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'email.required' => 'Email bắt buộc nhập',
            'email.email' => 'Email nhập đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu bắt buộc nhập',
            'repassword.required' => 'Mật khẩu nhập lại bắt buộc nhập',
        ];
        //các loại định dạng bắt buộc khi nhập
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:customer,email',
            'password' => 'required',
            'phone'=>'required|numeric|unique:customer,phone',
        ], $messages);

        if ($validator->passes()) {
            if ($request->password == $request->repassword) {
                $password = bcrypt($request->password);
                $customer_id = DB::table('customer')->insertGetId([
                    'name' => $request->name,
                    'address' => $request->address,
                    'email' => $request->email,
                    'password' => $password,
                    'phone' => $request->phone,
                    'avatar' => 'default-avatar.png',
                    'rotate_quantity'=>1,
                ]);
                $_SESSION['id']= $customer_id;
                $_SESSION['customer_name']= $request->name;
                return Response::json(array(
                    'success' => true,
                ));
            } else {
                return Response::json(array(
                    'success' => false,
                    'error'=> ['Mật khẩu nhập lại không khớp'],
                ));
            }
        }
        else{
            return Response::json(array(
                'success' => false,
                'error'=>$validator->errors()->all(),
            ));
        }

    }

    public function checkout()
    {
        if (Cart::count()==0 ){
            return redirect()->route('show_all_product');
        }
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
        if (Cart::count()==0 ){
            return redirect()->route('show_all_product');
        }
        //các loại định dạng bắt buộc khi nhập
        $messages = [
            'name.required' => 'Họ tên bắt buộc nhập',
            'address.required' => 'Địa chỉ bắt buộc nhập',
            'phone.required' => 'Số điện thoại bắt buộc nhập',
            'phone.numeric' => 'Số điện thoại  nhập đúng định dạng',
            'email.required' => 'Email bắt buộc nhập',
            'email.email' => 'Email nhập đúng định dạng',
            'payment_method.required' => 'Phương thức thanh toán bắt buộc nhập',
        ];
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'phone'=>'required',
            'phone'=>'numeric',
            'payment_method'=>'required',
        ], $messages);
        $discount_value = null;
        if ($validator->passes()) {
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
                $customer_id = 0;
            };
            if (isset($_SESSION['voucher_id'])) {
                $discount_value = DB::table('voucher')
                    ->where('ID', $_SESSION['voucher_id'])
                    ->first()
                    ->value;
            }
            $order_id = DB::table('order')->insertGetId([
                'customer_id' => $customer_id,
                'shipping_id' => $shipping_id,
                'status' => 'Đang xử lý',
                'total' => Cart::subtotal(0, "", "") + 30000,
                'created_at' => date('Y-m-d H:i:s'),
                'payment_id' => $payment_id,
                'discount' =>  $discount_value,
            ]);
            foreach (Cart::content() as $key) {
                DB::table('order_detail')->insert([
                    'product_id' => $key->id,
                    'order_id' => $order_id,
                    'price' => $key->price,
                    'name' => $key->name,
                    'quantity' => $key->qty,

                ]);

                $inventory_quantity =  DB::table('warehouse')
                    ->where('product_id', $key->id)
                    ->first()
                    ->inventory_quantity;
                $wait_delivery_quantity = DB::table('warehouse')
                    ->where('product_id', $key->id)
                    ->first()
                    ->wait_delivery_quantity;
                DB::table('warehouse')
                    ->where('product_id', $key->id)
                    ->update([
                        'wait_delivery_quantity' => $wait_delivery_quantity + $key->qty,
                        'inventory_quantity' => $inventory_quantity - $key->qty,
                    ]);
            }
            if (isset($_SESSION['voucher_id'])) {
                DB::table('use_voucher')->insert([
                    'customer_id' => $customer_id,
                    'order_id' => $order_id,
                    'voucher_id' => $_SESSION['voucher_id'],
                ]);
                DB::table('voucher')
                    ->where('ID', $_SESSION['voucher_id'])
                    ->update([
                        'quantity' => DB::table('voucher')->where('ID', $_SESSION['voucher_id'])->first()->quantity - 1,
                    ]);
            }
            $_SESSION['checkout']['name'] = $request->name;
            $_SESSION['checkout']['address'] = $request->address;
            $_SESSION['checkout']['email'] = $request->email;
            $_SESSION['checkout']['note'] = $request->note;
            $_SESSION['checkout']['phone'] = $request->phone;
            $_SESSION['checkout']['payment'] = $request->payment_method;

            return redirect()->route('confirm_checkout');
        }
        else{
            $error = $validator->errors()->all();
            Alert::error('Thất bại', $error);
            return redirect()->route('checkout');
        }
    }
    public function confirm_checkout()
    {
        if (Cart::count() == 0) {
            return redirect()->route('Home');
        }

        $to_name = "Cửa hàng Nông sản Việt";
        $to_email = $_SESSION['checkout']['email'];//send to this email

        $data = array("name"=>"Đơn hàng từ Nông sản Việt", "body"=>"noi dung body", 'check-out'); //body of mail.blade.php

        $data = $_SESSION['checkout'];

        Mail::send('page/checkout/mail',$data,function($message) use ($to_name,$to_email){
            $message->to('hoangtruong.test@outlook.com.vn')->subject('Thông tin đơn hàng');//send this mail with subject
            $message->from('hoangtruong.test@outlook.com.vn','Cửa hàng nông sản Việt');//send from this mail

        });
        unset($_SESSION['checkout']);
        Cart::destroy();
        unset($_SESSION['voucher_id']);
        return view('page/checkout/confirm')
        ->with(
                [
                    'title'=>'Hoàn tất thanh toán',
                ]
        );
    }
}
