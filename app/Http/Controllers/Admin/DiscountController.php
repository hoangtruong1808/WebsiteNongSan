<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
Use Alert;
use Validator;
use Response;

class DiscountController extends Controller
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
        DB::table('discount')
            ->whereRaw("date_end<CURRENT_TIMESTAMP")
            ->where('is_deleted', 0)
            ->update([
                'active'=>2,
            ]);
        DB::table('discount')
            ->whereRaw("date_start>CURRENT_TIMESTAMP")
            ->where('is_deleted', 0)
            ->update([
                'active'=>3,
            ]);
        DB::table('discount')
            ->whereRaw("date_start<CURRENT_TIMESTAMP AND date_end>CURRENT_TIMESTAMP")
            ->where('is_deleted', 0)
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
        $product = DB::table('product')
            ->where('is_deleted', 0)
            ->get();
        return view('admin/discount/create')
            ->with(['title'=>'Tạo khuyến mãi sản phẩm',
                'product'=>$product,
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

        $messages = [
            'product_id.required' => ' Sản phẩm bắt buộc chọn',
            'value.required' => ' Mức giảm giá bắt buộc nhập',
            'value.numeric' => ' Mức giảm giá bắt buộc là số tự nhiên',
            'value.max' => '  Mức giảm giá phải nhỏ hơn 100%',
            'compareDate.max'=> ' Ngày kết thúc phải sau ngày bắt đầu',
            'compareDate.not_in'=> 'Thời gian kết thúc phải sau thời gian bắt đầu',
            'order_max.numeric' => ' Giá trị lớn nhất của đơn hàng bắt buộc là số tiền',

        ];

        //các loại định dạng bắt buộc khi nhập
        $validator = Validator::make($request->all(),[
            'product_id' => "required",
            'value' => "required|numeric|min:0|not_in:0|max:100",
            'compareDate'=> 'numeric|max:0|not_in:0',
        ], $messages);

        if ($validator->passes()) {
            DB::table('discount')
                ->where('product_id', $request->product_id)
                ->update([
                    'is_deleted' => 1,
                ]);

            DB::table('discount')->insert([
                'product_id' => $request->product_id,
                'value' => $request->value,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
            ]);
            Alert::success('Thành công', 'Thêm khuyến mãi thành công');
            return redirect()->route('discount_show');
        }
        else{
            $error = $validator->errors()->all();
            Alert::error('Thất bại', $error);
            return redirect()->route('discount_create');
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
        $discount = DB::table('discount')
            ->join('product', 'product.id', '=' ,'discount.product_id')
            ->select('discount.*', 'product.*', 'discount.active as discount_active')
            ->where("discount.is_deleted", 0)
            ->orderBy('discount.id', 'DESC')
            ->get();
        return view('admin/discount/show')
            ->with(['title'=>'Khuyến mãi sản phẩm',
                'discount'=>$discount,
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
    public function edit($discount_id)
    {
        $product = DB::table('product')
            ->where('is_deleted', 0)
            ->get();
        $discount = DB::table('discount')
            ->where('id', $discount_id)
            ->first();

        return view('admin/discount/edit')
            ->with(['title'=>'Cập nhật khuyến mãi sản phẩm',
                'product' => $product,
                'discount'=>$discount,
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

    public function update(Request $request, $discount_id)
    {
        if (isset($request->date_start) && isset($request->date_end)){
            $compareDate = $this->compareDate($request->date_start, $request->date_end);
            $request->request->add(['compareDate' => $compareDate]);
        }

        $messages = [
            'product_id.required' => ' Sản phẩm bắt buộc chọn',
            'value.required' => ' Mức giảm giá bắt buộc nhập',
            'value.numeric' => ' Mức giảm giá bắt buộc là số tự nhiên',
            'value.max' => '  Mức giảm giá phải nhỏ hơn 100%',
            'compareDate.max'=> ' Ngày kết thúc phải sau ngày bắt đầu',
            'compareDate.not_in'=> 'Thời gian kết thúc phải sau thời gian bắt đầu',
            'order_max.numeric' => ' Giá trị lớn nhất của đơn hàng bắt buộc là số tiền',

        ];

        //các loại định dạng bắt buộc khi nhập
        $validator = Validator::make($request->all(),[
            'product_id' => "required",
            'value' => "required|numeric|min:0|not_in:0|max:100",
            'compareDate'=> 'numeric|max:0|not_in:0',
        ], $messages);

        if ($validator->passes()) {
            DB::table('discount')->where('ID', $discount_id)->update([
                'product_id' => $request->product_id,
                'value' => $request->value,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
            ]);
            Alert::success('Thành công', 'Cập nhật khuyến mãi thành công');
            return redirect()->route('discount_show');
        }
        else{
            $error = $validator->errors()->all();
            Alert::error('Thất bại', $error);
            return redirect()->route('discount_edit',['discount_id'=>$discount_id]);
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

        DB::table('discount')->where('ID', $request->discount_id)->update([
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
}
