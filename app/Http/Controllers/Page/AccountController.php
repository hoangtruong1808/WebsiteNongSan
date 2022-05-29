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
        $user_id = $_SESSION["id"];
        $customer_type = DB::table('customer')
                    ->where('id', $user_id)
                    ->first()
                    ->customer_type;
        $account_voucher = DB::table('voucher')
            ->whereRaw("is_deleted = 0 and active = 1 and quantity > 0 and (customer_type = 0 OR customer_id =1 OR customer_type = 2)")
            ->orderBy('ID', 'desc')
            ->paginate(10);
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
            'customer_type'=>NULL,
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
}
