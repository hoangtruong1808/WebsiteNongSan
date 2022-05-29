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


class LoginController extends Controller
{
    public function __construct()
    {
        session_start();
    }
    public function index()
    {
        if (isset($_SESSION['admin_id'])){
            return redirect()->route('admin_home');
        }else {
            return view('/admin/login')
                ->with(['title' => 'Đăng nhập']);
        }
    }
    public function execLogin(Request $request)
    {
        $messages = [
            'email.required' => 'Địa chỉ email bắt buộc nhập',
            'email.email' => 'Địa chỉ email không đúng định dạng',
            'password.required' => 'Mật khẩu bắt buộc nhập',
        ];
        //các loại định dạng bắt buộc khi nhập
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], $messages);

        if ($validator->passes()) {
            $account = DB::table('staff')->select('id', 'password')
                ->where('email', $request->get('email'))
                ->where('is_deleted',0)
                ->first();
            if ($account){
                if (Hash::check($request->get('password'), $account->password))
                {
                    $_SESSION['admin_id']= $account->id;
                    return redirect()->route('admin_home');
                }
                else {
                    Alert::error('Thất bại', 'Nhập sai mật khẩu');
                    return redirect()->route('admin_login');
                }
            }
            else{
                Alert::error('Email không tồn tại');
                return redirect()->route('admin_login');
            }

        }

        else{
            Alert::error('Thất bại', $validator->errors()->all());
            return redirect()->route('admin_login');
        }


    }
    public function logout(){
        session_destroy();
        return redirect()->route('admin_login');
    }
}
