<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
{
    public $unread;
    public $unread_count;
    public function __construct()
    {
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
                ->paginate(20);
        return view('admin/customer/show')
            ->with(['title'=>'Danh sách khách hàng',
                    'customer'=>$customer,
                    'unread'=>$this->unread,
                    'unread_count'=>$this->unread_count,
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
            ->get();
        return view('admin/customer/detail')
            ->with(['title'=>'Chi tiết khách hàng',
                    'customer'=>$customer,
                    'order_history' => $order_history,
                    'unread'=>$this->unread,
                    'unread_count'=>$this->unread_count,
                ]);
    }
}
