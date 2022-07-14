<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Alert;
use Response;

class AccountController extends Controller
{
    public function __construct()
    {
        session_start();
        if(!isset($_SESSION["id"])){
            header("Location: /");
            die;
        }
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
            'email.email' => 'Email nhập đúng định dạng',
            'password.required' => 'Mật khẩu bắt buộc nhập',
        ];
        //các loại định dạng bắt buộc khi nhập
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
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
        Alert::success('Thành công', 'Cập nhật thông tin thành công');
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
            ->join('shipping', 'shipping.id', '=', 'order.shipping_id')
            ->join('payment', 'payment.id', '=', 'order.payment_id')
            ->select('shipping.*', 'payment.method', 'order.*')
            ->where('order.customer_id', $user_id)
            ->orderBy('order.id', 'DESC')
            ->paginate(10);
        return view('page/account/order_history')
        ->with([
                'title'=>'Lịch sử đặt hàng',
                'order_history' => $order_history,
            ]);
    }
    public function order_detail(Request $request){
        $order_detail = DB::table('order_detail')
            ->where('order_id', $request->order_id)
            ->get();
        foreach($order_detail as $key=>$value){
            $data[$key]['product_name'] = $value->name;
            $data[$key]['price'] = $value->price;
            $data[$key]['quantity'] = $value->quantity;
        }
        return Response::json($data);
    }
    public function delete_order($order_id)
    {

        DB::table('order')->where('id', $order_id)->update(['status'=> 'Đơn hàng bị hủy']);
        Alert::success('Thành công', 'Hủy đơn hàn thành công');
        return redirect()->route('order_history');
    }
    public function show_voucher()
    {
        $account_voucher = DB::table('voucher')
            ->whereRaw("is_deleted = 0 and active = 1 and quantity > 0 and (voucher_type = 1 or (voucher_type = 2 and customer_id=".$_SESSION['id']."))")
            ->orderBy('ID', 'desc')
            ->paginate(10);
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

        return view('page/account/show_voucher')
        ->with([
                'title'=>'Danh sách mã khuyến mãi',
                'account_voucher' => $account_voucher,
            ]);
    }
    public function show_favorite()
    {

        $account_favorite = DB::table('favorite')
            ->join('product', 'favorite.product_id', '=', 'product.id')
            ->where('favorite.customer_id', $_SESSION["id"])
            ->where('product.is_deleted', 0)
            ->where('product.active',1)
            ->paginate(10);

        return view('page/account/show_favorite')
            ->with([
                'title'=>'Danh sách sản phẩm yêu thích',
                'account_favorite' => $account_favorite,
            ]);
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
    public function rotate(){
        $rotate_quantity = DB::table('customer')
            ->where('id',$_SESSION["id"])
            ->first()
            ->rotate_quantity;
        return view('page/account/rotate')
            ->with([
                'title'=>'Vòng quay may mắn',
                'rotate_quantity'=>$rotate_quantity,
            ]);;
    }
    public function store_rotate(Request $request){
        $voucher_id = DB::table('voucher')->insertGetId([
            'code'=>$request->code,
            'value'=>$request->val,
            'unit'=>'VNĐ',
            'quantity'=>1,
            'describe'=>'Mã khuyến mãi từ vòng quay may mắn',
            'voucher_type'=>2,
            'created_at'=>date("Y-m-d"),
            'customer_id'=>$_SESSION["id"],
        ]);
        DB::table('rotate')->insert([
            'customer_id'=>$_SESSION["id"],
            'voucher_id'=>$voucher_id,
            'rotate_at'=>date("Y-m-d"),
        ]);
        $rotate_quantity = DB::table('customer')
            ->where('id',$_SESSION["id"])
            ->first()
            ->rotate_quantity;
        if( DB::table('customer')->where('id',$_SESSION["id"])->first()->rotate_quantity > 0) {
            DB::table('customer')
                ->where('id', $_SESSION["id"])
                ->update([
                    'rotate_quantity' => $rotate_quantity - 1,
                ]);
        }
    }
    public function forget_password(){
//        return view('page/account/forget_password');
    }
    public function reset_password_exec(){

    }
    public function check_reset_password_code(){

    }
}
