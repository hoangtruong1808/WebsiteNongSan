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
    }
    public function index()
    {
        return view('/admin/home/index')
            ->with(['title'=>'Trang chủ',
                'unread'=>$this->unread,
                'account'=>$this->current_account,
                'unread_count'=>$this->unread_count,]);
    }
    public function showAccount(){

        return view('/admin/home/myaccount')
            ->with(['title'=>'Tài khoản của tôi',
                'unread'=>$this->unread,
                'account'=>$this->current_account,
                'unread_count'=>$this->unread_count,
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
