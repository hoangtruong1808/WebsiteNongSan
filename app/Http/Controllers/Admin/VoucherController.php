<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
Use Alert;
use Validator;

class VoucherController extends Controller
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
        $this->controller = 'voucher';
    }
    public function index()
    {

    }

    public function create()
    {
        return view('admin/voucher/create')
            ->with(['title'=>'Tạo mã khuyến mãi',
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
                'controller'=>$this->controller,]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request->date_start) && isset($request->date_end)){
            $compareDate = $this->compareDate($request->date_start, $request->date_end);
            $request->request->add(['compareDate' => $compareDate]);
        }
//

        $messages = [
            'code.required' => ' Mã giả giá bắt buộc nhập',
            'value.required' => ' Giá trị giảm giá bắt buộc nhập',
            'value.numeric' => ' Giá trị giảm giá bắt buộc là số tiền',
            'value.max' => ' Giá trị giảm giá phải nhỏ hơn số tiền đơn hàng',
            'value.not_in' => ' Giá trị giá giá phải nhỏ hơn số tiền đơn hàng',
            'unit.required' => ' Đơn vị bắt buộc nhập',
//            'order_min.required' => 'Giá trị nhỏ nhất của đơn hàng bắt buộc nhập',
            'order_min.numeric' => ' Giá trị nhỏ nhất của đơn hàng bắt buộc là số tiền',
            'order_min.max' => ' Giá trị nhỏ nhất của đơn hàng không được vượt quá giá trị lớn nhất',
//            'order_max.required' => 'Giá trị giảm giá bắt buộc nhập',
            'compareDate.max'=> 'Ngày kết thúc phải sau ngày bắt đầu',
            'compareDate.not_in'=> 'Thời gian kết thúc phải sau thời gian bắt đầu',
            'order_max.numeric' => ' Giá trị lớn nhất của đơn hàng bắt buộc là số tiền',
            'quantity.numeric' => ' Số voucher bắt buộc là số tự nhiên',
            'quantity_per_account.numeric' => ' ố voucher mỗi tài khoản bắt buộc là số tự nhiên',
            'describe.required' => ' Mô tả bắt buộc nhập',
            ];

        //các loại định dạng bắt buộc khi nhập
        $validator = Validator::make($request->all(),[
            'code' => 'required',
            'value' => "required|numeric|min:0|not_in:0|max:$request->order_min|not_in:$request->order_min",
            'unit' => 'required',
            'order_min' => "nullable|numeric|max: $request->order_max|min:0|not_in:0",
            'order_max' => 'nullable|numeric|min:0|not_in:0',
            'compareDate'=> 'numeric|max:0|not_in:0',
            'quantity' => 'nullable|numeric|min:0|not_in:0',
            'quantity_per_account' => 'nullable|numeric|min:0|not_in:0',
            'describe' => 'required',
        ], $messages);

        if ($validator->passes()) {
            DB::table('voucher')->insert([
                'code'=>$request->code,
                'value'=>$request->value,
                'unit'=>$request->unit,
                'order_min'=>$request->order_min,
                'order_max'=>$request->order_max,
                'quantity'=>$request->quantity,
                'quantity_per_account'=>$request->quantity_per_account,
                'date_start'=>$request->date_start,
                'date_end'=>$request->date_end,
                'describe'=>$request->describe,
                'created_at'=>date("Y-m-d"),
            ]);
            Alert::success('Thành công', 'Cập nhật mã khuyến mãi thành công');
            return redirect()->route('voucher_show');
        }
        else{
            $error = $validator->errors()->all();
            Alert::error('Thất bại', $error);
            return redirect()->route('voucher_create');
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
        $voucher = DB::table('voucher')
            ->where("is_deleted", 0)
            ->where("voucher_type", 1)
            ->get();
        return view('admin/voucher/show')
            ->with(['title'=>'Danh sách mã khuyến mãi',
                'voucher'=>$voucher,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
                'controller'=>$this->controller,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($voucher_id)
    {
        $voucher = DB::table('voucher')
            ->where('id', $voucher_id)
            ->first();

        return view('admin/voucher/edit')
            ->with(['title'=>'Cập nhật mã giảm giá',
                'voucher'=>$voucher,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
                'controller'=>$this->controller,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $voucher_id)
    {
        if (isset($request->date_start) && isset($request->date_end)){
            $compareDate = $this->compareDate($request->date_start, $request->date_end);
            $request->request->add(['compareDate' => $compareDate]);
        }
//

        $messages = [
            'code.required' => ' Mã giả giá bắt buộc nhập',
            'value.required' => ' Giá trị giảm giá bắt buộc nhập',
            'value.numeric' => ' Giá trị giảm giá bắt buộc là số tiền',
            'value.max' => ' Giá trị giảm giá phải nhỏ hơn số tiền đơn hàng',
            'value.not_in' => ' Giá trị giá giá phải nhỏ hơn số tiền đơn hàng',
            'unit.required' => ' Đơn vị bắt buộc nhập',
//            'order_min.required' => 'Giá trị nhỏ nhất của đơn hàng bắt buộc nhập',
            'order_min.numeric' => ' Giá trị nhỏ nhất của đơn hàng bắt buộc là số tiền',
            'order_min.max' => ' Giá trị nhỏ nhất của đơn hàng không được vượt quá giá trị lớn nhất',
//            'order_max.required' => 'Giá trị giảm giá bắt buộc nhập',
            'compareDate.max'=> 'Ngày kết thúc phải sau ngày bắt đầu',
            'compareDate.not_in'=> 'Thời gian kết thúc phải sau thời gian bắt đầu',
            'order_max.numeric' => ' Giá trị lớn nhất của đơn hàng bắt buộc là số tiền',
            'quantity.numeric' => ' Số voucher bắt buộc là số tự nhiên',
            'quantity_per_account.numeric' => ' ố voucher mỗi tài khoản bắt buộc là số tự nhiên',
            'describe.required' => ' Mô tả bắt buộc nhập',
        ];

        //các loại định dạng bắt buộc khi nhập
        $validator = Validator::make($request->all(),[
            'code' => 'required',
            'value' => "required|numeric|min:0|not_in:0|max:$request->order_min|not_in:$request->order_min",
            'unit' => 'required',
            'order_min' => "nullable|numeric|max: $request->order_max|min:0|not_in:0",
            'order_max' => 'nullable|numeric|min:0|not_in:0',
            'compareDate'=> 'numeric|max:0|not_in:0',
            'quantity' => 'nullable|numeric|min:0|not_in:0',
            'quantity_per_account' => 'nullable|numeric|min:0|not_in:0',
            'describe' => 'required',
        ], $messages);

        if ($validator->passes()) {
            DB::table('voucher')->where('ID', $voucher_id)->update([
                'code'=>$request->code,
                'value'=>$request->value,
                'unit'=>$request->unit,
                'order_min'=>$request->order_min,
                'order_max'=>$request->order_max,
                'quantity'=>$request->quantity,
                'quantity_per_account'=>$request->quantity_per_account,
                'date_start'=>$request->date_start,
                'date_end'=>$request->date_end,
                'describe'=>$request->describe,
                'created_at'=>date("Y-m-d"),
            ]);
            Alert::success('Thành công', 'Thêm mã khuyến mãi thành công');
            return redirect()->route('voucher_show');
        }
        else{
            $error = $validator->errors()->all();
            Alert::error('Thất bại', $error);
            return redirect()->route('voucher_edit',['voucher_id' => $voucher_id]);
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
               if ($key == 'customer_name'){
                    $query.= "customer.name LIKE '%$value%' and  ";
                }
               else if ($key == 'value' or $key== 'custom_type'){
                   $query.= "$key = $value and ";
               }
                else if ($key == 'start_date'){
                    $query.= "date_start >= '$value' and ";
                }
                else if ($key == 'end_date'){
                    $query.= "date_end <= '$value' and ";
                }
                else {
                    $query.= "`$key` LIKE '%$value%' and ";
                }
            }
        }
        $query = chop($query,"and ");
        if (empty($query)){
            return redirect()->route('voucher_show');
        }
        $voucher = DB::table('voucher')
            ->where("is_deleted", 0)
            ->where("voucher_type", 1)
            ->whereRaw($query)
            ->get();
        return view('admin/voucher/show')
            ->with(['title'=>'Danh sách mã khuyến mãi',
                'voucher'=>$voucher,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
                'controller'=>$this->controller,
            ]);
    }
}
