<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function order_show()
    {
        $order = DB::table('order')
                ->join('customer', 'order.customer_id', '=', 'customer.id')
                ->select('order.*', 'customer.name')
                ->orderBy('id', 'desc')
                ->paginate(20);
        return view('admin/order/order_show')
                ->with  (['title'=>'Danh sách đơn hàng',
                        'order'=>$order,
                        ]);
    }

    public function order_detail_show($order_id)
    {
        $order = DB::table('order')
                ->join('customer', 'order.customer_id', '=', 'customer.id')
                ->select('order.*', 'customer.name')
                ->where('order.id', $order_id)
                ->first();
        $order_detail = DB::table('order_detail')
                ->where('order_id', $order_id)
                ->get();
        $shipping = DB::table('order')
                ->join('shipping', 'order.shipping_id', '=', 'shipping.id')
                ->join('payment', 'order.payment_id', '=', 'payment.id')
                ->select('order.*', 'shipping.*', 'payment.method')
                ->where('order.id', $order_id)
                ->first();
        return view('admin/order/order_detail_show')
                ->with  (['title'=>'Chi tiết đơn hàng',
                        'order'=>$order,
                        'order_detail'=>$order_detail,
                        'shipping'=>$shipping,
                        ]);
    }
}
