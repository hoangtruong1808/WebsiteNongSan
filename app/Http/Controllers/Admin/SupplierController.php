<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use Alert;

class SupplierController extends Controller
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
        $this->controller = 'supplier';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/supplier/create')
        ->with(['title'=>'Thêm mới nhà cung cấp',
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
                'controller'=>$this->controller,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Tên bắt buộc nhập',
            'address.required' => 'Địa chỉ bắt buộc nhập',
            'phone.required' => 'Số điện thoại bắt buộc nhập',
            'phone.numeric' => 'Số điện thoại  nhập đúng định dạng',
            'mail.required' => 'Email bắt buộc nhập',
        ];
        //các loại định dạng bắt buộc khi nhập
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'mail' => 'required',
            'phone'=>'required',
            'phone'=>'numeric',
        ], $messages);

        if ($validator->passes()) {
            DB::table('supplier')->insert([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'mail'=>$request->mail ,
            ]);
            Alert::success('Thành công', 'Thêm mới nhà cung cấp thành công');
            return redirect()->route('supplier_show');
        } else {
            $error = $validator->errors()->all();
            Alert::error('Thất bại', $error);
            return redirect()->route('supplier_create');
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
        $supplier = DB::table('supplier')
            ->where("is_deleted", 0)
            ->orderBy("id", "DESC")
            ->get();

        return view('admin/supplier/show')
            ->with(['title'=>'Danh sách nhà cung cấp',
                    'supplier'=>$supplier,
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
    public function edit($supplier_id)
    {
        $supplier = DB::table('supplier')
        ->where('id', $supplier_id)
        ->where('is_deleted', 0)
        ->first();

        return view('admin/supplier/edit')
        ->with(['title'=>'Cập nhật nhà cung cấp',
                'supplier'=>$supplier,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
                'controller'=>$this->controller,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $supplier_id)
    {
        $messages = [
            'name.required' => 'Tên bắt buộc nhập',
            'address.required' => 'Địa chỉ bắt buộc nhập',
            'phone.required' => 'Số điện thoại bắt buộc nhập',
            'phone.numeric' => 'Số điện thoại  nhập đúng định dạng',
            'mail.required' => 'Email bắt buộc nhập',
        ];
        //các loại định dạng bắt buộc khi nhập
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'mail' => 'required',
            'phone'=>'required',
            'phone'=>'numeric',
        ], $messages);

        if ($validator->passes()) {
            DB::table('supplier')
            ->where('id', $supplier_id)
            ->update([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'mail'=>$request->mail ,
            ]);
            Alert::success('Thành công', 'Cập nhật nhà cung cấp thành công');
            return redirect()->route('supplier_show');
        } else {
            $error = $validator->errors()->all();
            Alert::error('Thất bại', $error);
            return redirect()->route('supplier_edit',['supplier_id'=>$supplier_id]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::table('supplier')->where('id', $request->supplier_id)->update([
            'is_deleted'=>1,
        ]);
    }

}
