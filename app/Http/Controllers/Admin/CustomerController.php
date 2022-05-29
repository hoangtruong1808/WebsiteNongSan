<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
Use Alert;

class CustomerController extends Controller
{
    public $unread;
    public $unread_count;
    public $current_account;
    public function __construct()
    {
        session_start();
        if (!isset($_SESSION['admin_id'])){
            header("Location: /admin/login");
            exit();
        }
        $this->current_account = DB::table('staff')
            ->where('id', $_SESSION['admin_id'])
            ->first();
        $this->unread = $message = DB::table('message')
                        ->join('customer', 'message.customer_id', '=', 'customer.id')
                        ->select('message.*', 'customer.name')
                        ->orderBy('message.id', 'DESC')
                        ->where('message.status', 0)
                        ->get();
        $this->unread_count = $message = DB::table('message')
                        ->where('message.status', 0)
                        ->count();
    }
    public function customer_show()
    {
        $customer = DB::table('customer')
                ->where('customer.ID','<>', 0)
//                ->where('customer.is_deleted', 0)
                ->paginate(20);
        foreach ($customer as $key=>$value){
            $process_order_count = DB::table('order')
                ->where('order.customer_id',$value->id)
                ->where('order.status','Đang xử lý')
                ->count();
            $customer[$key]->process_order_count = $process_order_count;

            $shipping_order_count = DB::table('order')
                ->where('order.customer_id',$value->id)
                ->where('order.status','Đang giao hàng')
                ->count();
            $customer[$key]->shipping_order_count = $shipping_order_count;

            $complete_order_count = DB::table('order')
                ->where('order.customer_id',$value->id)
                ->where('order.status','Đã nhận hàng')
                ->count();
            $customer[$key]->complete_order_count = $complete_order_count;

            $cancel_order_count = DB::table('order')
                ->where('order.customer_id',$value->id)
                ->where('order.status','Đơn hàng bị hủy')
                ->count();
            $customer[$key]->cancel_order_count = $cancel_order_count;

            $order_count = DB::table('order')
                ->where('order.customer_id',$value->id)
                ->count();
            $customer[$key]->order_count = $order_count;
        }
        return view('admin/customer/show')
            ->with(['title'=>'Danh sách khách hàng',
                    'customer'=>$customer,
                    'unread'=>$this->unread,
                    'unread_count'=>$this->unread_count,
                    'account'=>$this->current_account,
                ]);
    }
    public function customer_detail($customer_id)
    {
        $customer = DB::table('customer')
            ->where('id', $customer_id)
            ->first();
        $order_history = DB::table('order')
            ->join('shipping', 'shipping.id', '=', 'order.shipping_id')
            ->join('payment', 'payment.id', '=', 'order.payment_id')
            ->select('shipping.*', 'payment.method', 'order.*')
            ->where('order.customer_id', $customer_id)
            ->orderBy('order.id', 'DESC')
            ->paginate(10);
        return view('admin/customer/detail')
            ->with(['title'=>'Chi tiết khách hàng',
                    'customer'=>$customer,
                    'order_history' => $order_history,
                    'unread'=>$this->unread,
                    'unread_count'=>$this->unread_count,
                    'account'=>$this->current_account,
                ]);
    }
    public function lock_customer($customer_id){
        $customer = DB::table('customer')
                ->where('id', $customer_id)
                ->update([
                    'is_deleted'=>1
                ]);
        Alert::success('Thành công', 'Khóa tài khoản thành công thành công');
        return redirect()->route('customer_show');
    }
    public function unlock_customer($customer_id){
        $customer = DB::table('customer')
            ->where('id', $customer_id)
            ->update([
                'is_deleted'=>0
            ]);
        Alert::success('Thành công', 'Mở khóa tài khoản thành công thành công');
        return redirect()->route('customer_show');
    }
    public function filter(Request $request){
        $query = "";
        foreach ($request->all() as $key=>$value){
            if (isset($value)){
                if ($key == 'ID'){
                    $query.= "$key = $value and";
                }
                else {
                    $query.= "$key LIKE '%$value%' and ";
                }
            }
        }
        $query = chop($query,"and ");
        if (empty($query)){
            return redirect()->route('customer_show');
        }
        $customer = DB::table('customer')
            ->where('customer.ID','<>', 0)
            ->whereRaw($query)
            ->paginate(20);
        foreach ($customer as $key=>$value){
            $process_order_count = DB::table('order')
                ->where('order.customer_id',$value->id)
                ->where('order.status','Đang xử lý')
                ->count();
            $customer[$key]->process_order_count = $process_order_count;

            $shipping_order_count = DB::table('order')
                ->where('order.customer_id',$value->id)
                ->where('order.status','Đang giao hàng')
                ->count();
            $customer[$key]->shipping_order_count = $shipping_order_count;

            $complete_order_count = DB::table('order')
                ->where('order.customer_id',$value->id)
                ->where('order.status','Đã nhận hàng')
                ->count();
            $customer[$key]->complete_order_count = $complete_order_count;

            $cancel_order_count = DB::table('order')
                ->where('order.customer_id',$value->id)
                ->where('order.status','Đơn hàng bị hủy')
                ->count();
            $customer[$key]->cancel_order_count = $cancel_order_count;

            $order_count = DB::table('order')
                ->where('order.customer_id',$value->id)
                ->count();
            $customer[$key]->order_count = $order_count;
        }
        return view('admin/customer/show')
            ->with(['title'=>'Danh sách khách hàng',
                'customer'=>$customer,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
            ]);
    }
}
