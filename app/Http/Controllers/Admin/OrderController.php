<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Excel;
use App\Exports\HoaDonExport;
use Session;

class OrderController extends Controller
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
                                'unread'=>$this->unread,
                                'unread_count'=>$this->unread_count,
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
                                'unread'=>$this->unread,
                                'unread_count'=>$this->unread_count,
                                ]);
        }
        public function order_shipping_status($order_id)
        {
                DB::table('order')
                ->where('id', $order_id)
                ->update(
                [
                'status'=>'Đang giao hàng',
                ]
                );
                return redirect()->route('order_show');
        }
        public function order_checked_status($order_id)
        {
                DB::table('order')
                ->where('id', $order_id)
                ->update(
                [
                'status'=>'Đã nhận hàng',
                ]
                );
                return redirect()->route('order_show');
        }
        public function export_excel($order_id)
        {
                Session::flash('order_id',$order_id);
                return Excel::download(new HoaDonExport, 'HoaDonBanHang.xlsx');
        }
}
