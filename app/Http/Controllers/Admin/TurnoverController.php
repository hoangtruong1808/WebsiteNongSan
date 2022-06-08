<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
Use Alert;
use Validator;
use Response;

class TurnoverController extends Controller
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
    public function index()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function based_on_product()
    {
        $turnover_product = DB::table('order_detail')
                ->selectRaw('order_detail.*, sum(order_detail.quantity) as sum, product.*')
                ->join('product', 'product.id', '=', 'order_detail.product_id')
                ->join('order', 'order.id', '=', 'order_detail.order_id')
                ->groupBy('order_detail.product_id')
                ->where('product.is_deleted', 0)
                ->where('order.status', 'Đã nhận hàng')
                ->orderByRaw('sum(quantity) DESC')
                ->get();

        $menu = DB::table('menu')
            ->where('is_deleted', 0)
            ->get();

        return view('admin/turnover/product')
            ->with(['title'=>'Thống kê theo sản phẩm',
                    'turnover_product'=>$turnover_product,
                    'menu'=>$menu,
                    'unread'=>$this->unread,
                    'unread_count'=>$this->unread_count,
                    'account'=>$this->current_account,
                ]);
    }

    public function product_chart()
    {
        $turnover_product = DB::table('order_detail')
            ->selectRaw('order_detail.*, sum(order_detail.quantity) as sum, product.name')
            ->join('product', 'product.id', '=', 'order_detail.product_id')
            ->join('order', 'order.id', '=', 'order_detail.order_id')
            ->groupBy('order_detail.product_id')
            ->where('product.is_deleted', 0)
            ->where('order.status', 'Đã nhận hàng')
            ->orderByRaw('sum(quantity) DESC')
            ->limit('7')
            ->get();

        $data =[];
        foreach ($turnover_product as $key=>$value){
            $data['name'][] = $value->name;
            $data['money'][] = $value->price * ceil($value->sum);
        }

        return view('admin/turnover/product_chart')
            ->with(['title'=>'Biểu đồ thống kê doanh thu theo sản phẩm',
                'data'=>$data,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
            ]);
    }

    public function based_on_customer()
    {
        $turnover_customer = DB::table('order')
            ->selectRaw('*, sum(order.total) as sum, customer.*')
            ->join('customer', 'customer.id', '=', 'order.customer_id')
            ->groupBy('order.customer_id')
            ->where('customer.is_deleted', 0)
            ->where('order.status', 'Đã nhận hàng')
            ->orderByRaw('sum(order.total) DESC')
            ->get();

        return view('admin/turnover/customer')
            ->with(['title'=>'Thống kê theo khách hàng',
                'turnover_customer'=>$turnover_customer,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
            ]);
    }

    public function customer_chart()
    {
        $turnover_customer = DB::table('order')
            ->selectRaw('*, sum(order.total) as sum, customer.name')
            ->join('customer', 'customer.id', '=', 'order.customer_id')
            ->groupBy('order.customer_id')
            ->where('customer.is_deleted', 0)
            ->where('order.status', 'Đã nhận hàng')
            ->orderByRaw('sum(order.total) DESC')
            ->limit('7')
            ->get();

        $data =[];
        foreach ($turnover_customer as $key=>$value){
            $data['name'][] = $value->name;
            $data['money'][] = $value->sum;
        }

        return view('admin/turnover/customer_chart')
            ->with(['title'=>'Biểu đồ thống kê doanh thu theo khách hàng',
                'data'=>$data,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
            ]);
    }

    public function based_on_date()
    {
        $turnover_date = DB::table('order')
            ->selectRaw('*, sum(order.total) as sum, MONTH(order.created_at) as month, YEAR(order.created_at) as year')
            ->groupBy('month')
            ->where('order.status', 'Đã nhận hàng')
            ->orderByRaw('sum(order.total) DESC')
            ->get();
        return view('admin/turnover/date')
            ->with(['title'=>'Thống kê theo sản phẩm',
                'turnover_date'=>$turnover_date,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
            ]);
    }

    public function date_chart()
    {
        $turnover_date = DB::table('order')
            ->selectRaw('*, sum(order.total) as sum, MONTH(order.created_at) as month, YEAR(order.created_at) as year')
            ->groupBy('month')
            ->where('order.status', 'Đã nhận hàng')
            ->orderByRaw('sum(order.total) DESC')
            ->limit('7')
            ->get();

        $data =[];
        foreach ($turnover_date as $key=>$value){
            $data['name'][] = 'Tháng '. $value->month . '/'.  $value->year;
            $data['money'][] = $value->sum;
        }

        return view('admin/turnover/date_chart')
            ->with(['title'=>'Biểu đồ thống kê doanh thu theo tháng',
                'data'=>$data,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
            ]);
    }

}
