<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use DB;
use Session;
use Validator;
use Illuminate\Validation\Rule;
use Alert;


class HomeController extends Controller
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
        $this->controller = 'home';
    }
    public function index()
    {
        $data['product_count'] = DB::table('product')->where('is_deleted', 0)->count();
        $data['new_order_count'] = DB::table('order')->where('status', 'Đang xử lý')->count();
        $data['shipping_order_count'] = DB::table('order')->where('status', 'Đang giao hàng')->count();
        $data['confirm_order_count'] = DB::table('order')->where('status', 'Đã nhận hàng')->count();
        $data['cancel_order_count'] = DB::table('order')->where('status', 'Đơn hàng bị hủy')->count();
        $data['customer_count'] =  DB::table('customer')->where('is_deleted', 0)->count();
        $data['staff_count'] =  DB::table('staff')->where('is_deleted', 0)->count();

        $best_seller = DB::table('order_detail')
                ->selectRaw('order_detail.*, sum(order_detail.quantity) as sum, product.unit, product.name as product_name' )
                ->join('order', 'order.id', '=', 'order_detail.order_id')
                ->join('product', 'product.id', '=', 'order_detail.product_id')
                ->groupBy('order_detail.product_id')
                ->where('order.status', 'Đã nhận hàng')
                ->orderByRaw('sum(quantity)*order_detail.price DESC')
                ->limit('4')
                ->get();
        $data['best_seller'] = $best_seller;

        $turnover_date = DB::table('order')
            ->selectRaw('*, sum(order.total) as sum, MONTH(order.created_at) as month, YEAR(order.created_at) as year')
            ->groupBy('month')
            ->where('order.status', 'Đã nhận hàng')
            ->orderByRaw('sum(order.total) DESC')
            ->limit('4')
            ->get();

        $data_date_chart =[];
        foreach ($turnover_date as $key=>$value){
            $data_date_chart['name'][] = 'Tháng '. $value->month . '/'.  $value->year;
            $data_date_chart['money'][] = $value->sum;
        }

        DB::table('voucher')
            ->whereRaw("date_end<CURRENT_TIMESTAMP  OR quantity=0")
            ->where('voucher_type', 1)
            ->update([
                'active'=>2,
            ]);
        DB::table('voucher')
            ->whereRaw("date_start>CURRENT_TIMESTAMP")
            ->where('voucher_type', 1)
            ->update([
                'active'=>3,
            ]);
        DB::table('voucher')
            ->whereRaw("date_start<CURRENT_TIMESTAMP  AND date_end>CURRENT_TIMESTAMP  AND quantity>0")
            ->where('voucher_type', 1)
            ->update([
                'active'=>1,
            ]);

        return view('/admin/home/index')
            ->with(['title'=>'Trang chủ',
                'unread'=>$this->unread,
                'account'=>$this->current_account,
                'unread_count'=>$this->unread_count,
                'data'=>$data,
                'data_date'=>$data_date_chart,
                'controller'=>$this->controller,
            ]);
    }
    public function showAccount(){

        return view('/admin/home/myaccount')
            ->with(['title'=>'Tài khoản của tôi',
                'unread'=>$this->unread,
                'account'=>$this->current_account,
                'unread_count'=>$this->unread_count,
                'controller'=>$this->controller,
            ]);
    }

    public function execAccount(Request $request){

        $staff_id = $_SESSION['admin_id'];
        try {

            $messages = [
                'name.required' => 'Họ tên bắt buộc nhập',
                'address.required' => 'Địa chỉ bắt buộc nhập',
                'phone.required' => 'Số điện thoại bắt buộc nhập',
                'phone.numeric' => 'Số điện thoại  nhập đúng định dạng',
                'email.required' => 'Email bắt buộc nhập',
            ];
            //các loại định dạng bắt buộc khi nhập
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'address' => 'required',
                'email' => 'required',
                'phone'=>'required',
                'phone'=>'numeric',
            ], $messages);

            if ($validator->passes()) {
                if (empty($request->file('avatar')))
                {
                    $data_array = DB::table('staff')
                        ->select('avatar')
                        ->where('id',$staff_id)
                        ->first();
                    $avatar = $data_array->avatar;
                }
                else
                {
                    $avatar = $request->file('avatar')->getClientOriginalName();
                    $request->file('avatar')->storeAs('public/avatar', $avatar);
                }
                DB::table('staff')->where('id', $staff_id)->update([
                    'name'=>$request->name,
                    'phone'=>$request->phone,
                    'address'=>$request->address,
                    'email'=>$request->email ,
                    'avatar'=>$avatar,
                ]);
                Alert::success('Thành công', 'Cập nhật tài khoản thành công');
                return redirect()->route('admin_myaccount');
            } else {
                $error = $validator->errors()->all();
                Alert::error('Thất bại', $error);
                return redirect()->route('admin_myaccount');
            }
        }
        catch(Exception $e) {
            Alert::error('Thất bại', $e->getMessage());
            return redirect()->route('admin_myaccount');
        }
    }
    public function changePassword() {
        return view('/admin/home/change_password')
            ->with(['title'=>'Đổi mật khẩu',
                'unread'=>$this->unread,
                'account'=>$this->current_account,
                'unread_count'=>$this->unread_count,
                'controller'=>$this->controller,
            ]);
    }
    public function execChangePassword(Request $request) {
        $messages = [
            'old_password.required' => 'Mời nhập mật khẩu hiện tại',
            'new_password.required' => 'Mời nhập mật khẩu mới',
            're_password.required' => 'Mời nhập mật khẩu nhập lại',
        ];
        //các loại định dạng bắt buộc khi nhập
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            're_password' => 'required',
        ], $messages);

        if ($validator->passes()) {
            if (Hash::check($request->old_password, $this->current_account->password)) {
                if ($request->new_password == $request->re_password) {
                    DB::table('staff')->where('id', $_SESSION['admin_id'])->update([
                        'password' => bcrypt($request->new_password),
                    ]);
                    Alert::success('Thành công', 'Đổi mật khẩu thành công');
                    return redirect()->route('admin_home');
                } else {
                    Alert::error('Thất bại', 'Mật khẩu nhập lại không trùng mật khẩu mới');
                    return redirect()->route('admin_change_password');
                }
            } else {
                Alert::error('Thất bại', 'Mật khẩu cũ không đúng');
                return redirect()->route('admin_change_password');
            }
        }
        else {
            Alert::error('Thất bại', $validator->errors()->all());
            return redirect()->route('admin_change_password');
        }
    }
}
