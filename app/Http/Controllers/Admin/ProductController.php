<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public $unread;
    public $unread_count;
    public function __construct()
    {
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
        $menu = DB::table('menu')->get();
        return view('admin/product/create')
        ->with(['title'=>'Tạo sản phẩm',
                'menu'=>$menu,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
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
        $thumb = $request->file('thumb')->getClientOriginalName();
        $request->file('thumb')->storeAs('public/product', $thumb);
        DB::table('product')->insert([
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
        return redirect()->route('product_show');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $product = DB::table('product')
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('admin/product/show')
            ->with(['title'=>'Danh sách sản phẩm',
                    'product'=>$product,
                    'unread'=>$this->unread,
                    'unread_count'=>$this->unread_count,
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
        $menu = DB::table('menu')->get();
        $product = DB::table('product')
        ->where('id', $product_id)
        ->first();

        return view('admin/product/edit')
        ->with(['title'=>'Cập nhật sản phẩm',
                'product'=>$product,
                'menu'=>$menu,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,]);
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
        return redirect()->route('product_show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        DB::table('product')->where('id', $product_id)->delete();
        return redirect()->route('product_show');
    }
}
