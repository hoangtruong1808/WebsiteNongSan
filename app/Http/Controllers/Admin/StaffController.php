<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
Use Alert;
use Validator;

class StaffController extends Controller
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
            ->orderBy('message.id', 'ASC')
            ->where('message.status', 0)
            ->get();
        $this->unread_count = $message = DB::table('message')
            ->where('message.status', 0)
            ->count();
    }
    public function index()
    {

    }

    public function create()
    {
        return view('admin/staff/create')
            ->with(['title'=>'Tạo nhân viên mới',
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $messages = [
                'name.required' => 'Họ tên bắt buộc nhập',
                'address.required' => 'Địa chỉ bắt buộc nhập',
                'phone.required' => 'Số điện thoại bắt buộc nhập',
                'phone.numeric' => 'Số điện thoại  nhập đúng định dạng',
                'email.required' => 'Email bắt buộc nhập',
                'password.required' => 'Mật khẩu bắt buộc nhập',
                'password.min' => 'Mật khẩu tối thiểu 3 kí tự',
                'password.max' => 'Mật khẩu tối đa 20 kí tự',
                'role.required' => 'Vai trò bắt buộc chọn',
            ];
            //các loại định dạng bắt buộc khi nhập
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'address' => 'required',
                'email' => 'required',
                'phone'=>'required',
                'phone'=>'numeric',
                'password'=>'required|min:3|max:20',
                'role'=>'required',
            ], $messages);

            if ($validator->passes()) {
                if (empty($request->file('avatar')))
                {
                    $avatar = 'default-avatar.png';
                }
                else
                {
                    $avatar = $request->file('avatar')->getClientOriginalName();
                    $request->file('avatar')->storeAs('public/avatar', $avatar);
                }
                DB::table('staff')->insert([
                    'name'=>$request->name,
                    'phone'=>$request->phone,
                    'address'=>$request->address,
                    'email'=>$request->email ,
                    'password'=>bcrypt($request->password) ,
                    'avatar'=>$avatar,
                ]);
                Alert::success('Thành công', 'Tạo nhân viên thành công');
                return redirect()->route('staff_show');
            } else {
                $error = $validator->errors()->all();
                Alert::error('Thất bại', $error);
                return redirect()->route('staff_create');
            }
        }
        catch(Exception $e) {
            Alert::error('Thất bại', $e->getMessage());
            return redirect()->route('admin_myaccount');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $staff = DB::table('staff')
            ->orderBy("is_deleted", "ASC")
            ->get();
        return view('admin/staff/show')
            ->with(['title'=>'Danh sách nhân viên',
                'staff'=>$staff,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($staff_id)
    {
        $staff = DB::table('staff')
            ->where('id', $staff_id)
            ->first();

        return view('admin/staff/edit')
            ->with(['title'=>'Cập nhật thông tin nhân viên',
                'staff'=>$staff,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $staff_id)
    {
        try {

            $messages = [
                'name.required' => 'Họ tên bắt buộc nhập',
                'address.required' => 'Địa chỉ bắt buộc nhập',
                'phone.required' => 'Số điện thoại bắt buộc nhập',
                'phone.numeric' => 'Số điện thoại  nhập đúng định dạng',
                'email.required' => 'Email bắt buộc nhập',
                'role.required' => 'Vai trò bắt buộc chọn',
            ];
            //các loại định dạng bắt buộc khi nhập
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'address' => 'required',
                'email' => 'required',
                'phone'=>'required',
                'phone'=>'numeric',
                'role'=>'required',
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
                    'role'=>$request->role,
                ]);
                Alert::success('Thành công', 'Cập nhật tài khoản thành công');
                return redirect()->route('staff_edit', ['staff_id'=>$staff_id]);
            } else {
                $error = $validator->errors()->all();
                Alert::error('Thất bại', $error);
                return redirect()->route('staff_edit', ['staff_id'=>$staff_id]);
            }
        }
        catch(Exception $e) {
            Alert::error('Thất bại', $e->getMessage());
            return redirect()->route('staff_edit', ['staff_id'=>$staff_id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::table('voucher')->where('ID', $request->voucher_id)->update([
            'is_deleted'=>1,
        ]);
    }
    public function compareDate($date1, $date2){
        $time1 = date_parse_from_format('Y-m-d H:i:s', $date1);
        $time_stamp1 = mktime($time1['hour'],$time1['minute'],$time1['second'],$time1['month'],$time1['day'],$time1['year']);

        $time2 = date_parse_from_format('Y-m-d H:i:s', $date2);
        $time_stamp2 = mktime($time2['hour'],$time2['minute'],$time2['second'],$time2['month'],$time2['day'],$time2['year']);

        $comparision = $time_stamp1 - $time_stamp2;
        return $comparision;
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
            return redirect()->route('staff_show');
        }
        $staff = DB::table('staff')
            ->whereRaw($query)
            ->paginate(20);

        return view('admin/staff/show')
            ->with(['title'=>'Danh sách nhân viên',
                'staff'=>$staff,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
            ]);
    }
    public function lock_staff($staff_id){
        $staff= DB::table('staff')
            ->where('id', $staff_id)
            ->update([
                'is_deleted'=>1
            ]);
        Alert::success('Thành công', 'Dừng hoạt động tài khoản nhân viên thành công');
        return redirect()->route('staff_show');
    }
    public function unlock_staff($staff_id){
        $staff= DB::table('staff')
            ->where('id', $staff_id)
            ->update([
                'is_deleted'=>0
            ]);
        Alert::success('Thành công', 'Khôi phục tài khoản nhân viên thành công');
        return redirect()->route('staff_show');
    }
}
