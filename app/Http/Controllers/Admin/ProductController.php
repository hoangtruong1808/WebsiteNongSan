<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use Alert;

class ProductController extends Controller
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
        $menu = DB::table('menu')
                ->where('is_deleted', 0)
                ->get();
        return view('admin/product/create')
        ->with(['title'=>'Tạo sản phẩm',
                'menu'=>$menu,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
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
        try {
            $messages = [
                'name.required' => 'Tên sản phẩm bắt buộc nhập',
                'description.required' => 'Mô tả bắt buộc nhập',
                'menu_id.required' => 'Danh mục bắt buộc nhập',
                'menu_id.numeric' => 'Danh mục không hợp lệ',
                'price.required' => 'Giá sản phẩm bắt buộc nhập',
                'price.numeric' => 'Giá sản phẩm phải là số',
                'thumb.required' => 'Ảnh sản phẩm bắt buộc nhập',
                'thumb.image' => 'Ảnh sản phẩm phải là file ảnh có đuôi ".jpg, .png, .jpeg, .gif, .svg"',
                'thumb.mimes' => 'Ảnh sản phẩm phải là file ảnh có đuôi ".jpg, .png, .jpeg, .gif, .svg"',
            ];
            //các loại định dạng bắt buộc khi nhập
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'menu_id' => 'required|numeric',
                'price' => 'required|numeric',
                'thumb' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            ], $messages);

            if ($validator->passes()) {
                $thumb = $request->file('thumb')->getClientOriginalName();
                $request->file('thumb')->storeAs('public/product', $thumb);
                DB::table('product')->insert([
                    'name' => $request->name,
                    'description' => $request->description,
                    'menu_id' => $request->menu_id,
                    'price' => $request->price,
                    'active' => 1,
                    'unit' => $request->unit,
                    'thumb' => $thumb,
                    'thanhphan' => $request->thanhphan,
                    'muavu' => $request->muavu,
                    'donggoi' => $request->donggoi,
                    'hansudung' => $request->hansudung,
                    'xuatsu' => $request->xuatsu,
                    'giaohang' => $request->giaohang,
                ]);
                Alert::success('Thành công', 'Thêm sản phẩm thành công');
                return redirect()->route('product_show');
            } else {
                $error = $validator->errors()->all();
                Alert::error('Thất bại', $error);
                return redirect()->route('product_create');
            }
        }
        catch(Exception $e) {
            Alert::error('Thất bại', $e->getMessage());
            return redirect()->route('product_create');
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
        $menu = DB::table('menu')
            ->where('is_deleted', 0)
            ->get();
        $product = DB::table('product')
            ->where("is_deleted", 0)
            ->orderBy("id", "DESC")
            ->get();

        return view('admin/product/show')
            ->with(['title'=>'Danh sách sản phẩm',
                    'product'=>$product,
                    'unread'=>$this->unread,
                    'unread_count'=>$this->unread_count,
                    'menu'=>$menu,
                    'account'=>$this->current_account,
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {
        $menu = DB::table('menu')
            ->where('is_deleted', 0)
            ->get();
        $product = DB::table('product')
        ->where('id', $product_id)
        ->first();

        return view('admin/product/edit')
        ->with(['title'=>'Cập nhật sản phẩm',
                'product'=>$product,
                'menu'=>$menu,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id)
    {
        try {
            $messages = [
                'name.required' => 'Tên sản phẩm bắt buộc nhập',
                'description.required' => 'Mô tả bắt buộc nhập',
                'menu_id.required' => 'Danh mục bắt buộc nhập',
                'menu_id.numeric' => 'Danh mục không hợp lệ',
                'price.required' => 'Giá sản phẩm bắt buộc nhập',
                'price.numeric' => 'Giá sản phẩm phải là số',
                'thumb.image' => 'Ảnh sản phẩm phải là file ảnh có đuôi ".jpg, .png, .jpeg, .gif, .svg"',
                'thumb.mimes' => 'Ảnh sản phẩm phải là file ảnh có đuôi ".jpg, .png, .jpeg, .gif, .svg"',
            ];
            //các loại định dạng bắt buộc khi nhập
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required',
                'menu_id' => 'required|numeric',
                'price' => 'required|numeric',
                'thumb' => 'image|mimes:jpg,png,jpeg,gif,svg',
            ], $messages);

            if ($validator->passes()) {
                if (empty($request->file('thumb')))
                {
                    $data_array = DB::table('product')
                        ->select('thumb')
                        ->where('id',$product_id)
                        ->first();
                    $thumb = $data_array->thumb;
                }
                else
                {
                    $thumb = $request->file('thumb')->getClientOriginalName();
                    $request->file('thumb')->storeAs('public/product', $thumb);
                }
                DB::table('product')->where('id', $product_id)->update([
                    'name'=>$request->name,
                    'description'=>$request->description,
                    'menu_id'=>$request->menu_id ,
                    'price'=>$request->price,
                    'active'=>$request->active,
                    'unit'=>$request->unit,
                    'thumb'=>$thumb,
                    'thanhphan'=>$request->thanhphan,
                    'muavu'=>$request->muavu,
                    'donggoi'=>$request->donggoi,
                    'hansudung'=>$request->hansudung,
                    'xuatsu'=>$request->xuatsu,
                    'giaohang'=>$request->giaohang,
                ]);
                Alert::success('Thành công', 'Thêm sản phẩm thành công');
                return redirect()->route('product_show');
            } else {
                $error = $validator->errors()->all();
                Alert::error('Thất bại', $error);
                return redirect()->route('product_edit',['product_id'=>$product_id]);
            }
        }
        catch(Exception $e) {
            Alert::error('Thất bại', $e->getMessage());
            return redirect()->route('product_edit',['product_id'=>$product_id]);
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
        DB::table('product')->where('id', $request->product_id)->update([
            'is_deleted'=>1,
        ]);
    }
    public function export_qrcode($product_id){
        return view('admin/product/export_qrcode')
            ->with(['title'=>'Cập nhật sản phẩm',
            'product_id'=>$product_id]);
    }
    public function filter(Request $request){
        $query = "";
        foreach ($request->all() as $key=>$value){
            if (isset($value)){
                if ($key == 'min_price'){
                    $query.= "price >= $value and ";
                }
                else if ($key == 'max_price'){
                    $query.= "price <= $value and ";
                }
                else {
                    $query.= "$key LIKE '%$value%' and ";
                }
            }
        }
        $query = chop($query,"and ");
        if (empty($query)){
            return redirect()->route('product_show');
        }
        $menu = DB::table('menu')
            ->where('is_deleted', 0)
            ->get();
        $product = DB::table('product')
            ->where("is_deleted", 0)
            ->whereRaw($query)
            ->get();
        return view('admin/product/show')
            ->with(['title'=>'Danh sách danh mục',
                'product'=>$product,
                'menu'=>$menu,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
            ]);
    }
}
