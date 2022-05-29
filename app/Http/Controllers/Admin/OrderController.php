<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Excel;
use App\Exports\HoaDonExport;
use Session;
Use Alert;

class OrderController extends Controller
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
                                'account'=>$this->current_account,
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
                                'account'=>$this->current_account,
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
        public function update_status_order($order_id, Request $request)
        {
                DB::table('order')
                    ->where('id', $order_id)
                    ->update(
                    [
                        'status'=>$request->status,
                    ]);
            Alert::success('Thành công', 'Cập nhật trạng thái thành công');
            return redirect()->route('order_show');
        }
        public function export_excel($order_id)
        {
                Session::flash('order_id',$order_id);
                return Excel::download(new HoaDonExport, 'HoaDonBanHang.xlsx');
        }
    public function filter(Request $request){
        $query = "";
        foreach ($request->all() as $key=>$value){
            if (isset($value)){
                if ($key == 'min_price'){
                    $query.= "order.total >= $value and ";
                }
                else if ($key == 'max_price'){
                    $query.= "order.total <= $value and ";
                }
                else if ($key == 'customer_name'){
                    $query.= "customer.name LIKE '%$value%' and  ";
                }
                else if ($key == 'start_date'){
                    $query.= "order.created_at >= '$value' and ";
                }
                else if ($key == 'end_date'){
                    $query.= "order.created_at <= '$value' and ";
                }
                else {
                    $query.= "order.$key LIKE '%$value%' and ";
                }
            }
        }
        $query = chop($query,"and ");
        if (empty($query)){
            return redirect()->route('order_show');
        }
        $order = DB::table('order')
            ->join('customer', 'order.customer_id', '=', 'customer.id')
            ->select('order.*', 'customer.name')
            ->orderBy('id', 'desc')
            ->whereRaw($query)
            ->get();
        return view('admin/order/order_show')
            ->with  (['title'=>'Danh sách đơn hàng',
                'order'=>$order,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
                ]);
    }
    public function compareDate($date1, $date2){
        $time1 = date_parse_from_format('Y-m-d H:i:s', $date1);
        $time_stamp1 = mktime($time1['hour'],$time1['minute'],$time1['second'],$time1['month'],$time1['day'],$time1['year']);

        $time2 = date_parse_from_format('Y-m-d H:i:s', $date2);
        $time_stamp2 = mktime($time2['hour'],$time2['minute'],$time2['second'],$time2['month'],$time2['day'],$time2['year']);

        $comparision = $time_stamp1 - $time_stamp2;
        if ($comparision>=0){
            return true;
        }
        else{
            return false;
        }
    }
}
