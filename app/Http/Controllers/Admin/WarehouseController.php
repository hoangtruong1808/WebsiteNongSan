<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\ValidatorAwareRule;
use Illuminate\Http\Request;
use DB;
Use Alert;
use Validator;
use Response;
use Excel;
use App\Exports\PhieuNhapHangExport;

class WarehouseController extends Controller
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
        $this->controller = 'warehouse';
        DB::table('warehouse_product')
            ->whereRaw("expiry_date<CURRENT_TIMESTAMP")
            ->update([
                'quantity'=>0,
            ]);
        DB::table('warehouse_product')
            ->whereRaw("quantity=0")
            ->update([
                'status'=>0,
            ]);
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
    public function show()
    {
        $warehouse = DB::table('warehouse')
                ->join('product', 'product.id', '=', 'warehouse.product_id')
                ->where('product.is_deleted',0)
                ->get();
        foreach ($warehouse as $key=>$value){
            $warehouse_product_expire = DB::table('warehouse_product')
                ->where('product_id', $value->product_id)
                ->where('quantity', '>' ,0)
                ->whereRaw('DATEDIFF(expiry_date, now()) < 5')
                ->whereRaw('DATEDIFF(expiry_date, now()) > 0')
                ->orderBy('warehouse_product_id', 'ASC')
                ->first();
            if (isset($warehouse_product_expire)) {
                $warehouse[$key]->expire_quantity = $warehouse_product_expire->quantity;;
            }
            else {
                $warehouse[$key]->expire_quantity = 0;
            }
        }

        return view('admin/warehouse/show')
            ->with(['title'=>'Quản lý kho hàng',
                    'warehouse'=>$warehouse,
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
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->add_quantity != 0) {
            DB::table('warehouse')
                ->where('warehouse_id', $request->warehouse_id)
                ->update([
                    'inventory_quantity' => $request->inventory_quantity,
                ]);
            return Response::json(array(
                'success' => true,
                'error' => 'Cập nhật số lượng thành công'
            ));
        }
        else{
            return Response::json(array(
                'success' => false,
                'error' => 'Số lượng phải khác 0',
            ));
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
        DB::table('menu')->where('id', $request->menu_id)->update([
            'is_deleted'=>1,
        ]);
    }

    public function filter(Request $request){
        $query = "";
        foreach ($request->all() as $key=>$value){
            if (isset($value)){
                if ($key == 'filter_status'){
                    if ($value==2){
                        $query = "warehouse.inventory_quantity  < 6 and ";
                    }
                    else if ($value==3){
                        $query = "warehouse.inventory_quantity = 0 and ";
                    }
                }
                else if ($key == 'product_id'){
                    $query.= "warehouse.product_id = $value and";
                }
                else if ($key == 'name'){
                    $query.= "product.name LIKE '%$value%' and ";
                }
            }
        }
        $query = chop($query,"and ");
        if (empty($query)){
            return redirect()->route('warehouse_show');
        }
        $warehouse = DB::table('warehouse')
            ->join('product', 'product.id', '=', 'warehouse.product_id')
            ->where('product.is_deleted',0)
            ->whereRaw($query)
            ->get();
        foreach ($warehouse as $key=>$value) {
            $warehouse_product_expire = DB::table('warehouse_product')
                ->where('product_id', $value->product_id)
                ->where('quantity', '>', 0)
                ->whereRaw('DATEDIFF(expiry_date, now()) < 5')
                ->whereRaw('DATEDIFF(expiry_date, now()) > 0')
                ->orderBy('warehouse_product_id', 'ASC')
                ->first();
            if (isset($warehouse_product_expire)) {
                $warehouse[$key]->expire_quantity = $warehouse_product_expire->quantity;;
            } else {
                $warehouse[$key]->expire_quantity = 0;
            }
        }

        return view('admin/warehouse/show')
            ->with(['title'=>'Quản lý kho hàng',
                'warehouse'=>$warehouse,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
                'controller'=>$this->controller,
            ]);
    }

    public function import_goods(){

        $supplier = DB::table('supplier')
            ->where('is_deleted', 0)
            ->get();
        $staff = DB::table('staff')
            ->where('is_deleted', 0)
            ->where('role', 1)
            ->get();
        $product = DB::table('product')
            ->where('is_deleted', 0)
            ->get();
        return view('admin/warehouse/import_goods')
            ->with(['title'=>'Nhập hàng',
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
                'staff'=>$staff,
                'supplier'=>$supplier,
                'product'=>$product,
                'controller'=>$this->controller,
            ]);
    }
    public function import_goods_store(Request $request)
    {

        $total = 0;
        $error = false;
        if (isset($request->sanpham)) {
            $product_quantity = count($request->sanpham);

            for ($i = 0; $i < $product_quantity; $i++){
                $total += $request->soluong[$i] * $request->dongia[$i];
                if (!isset($request->sanpham[$i]) || !isset($request->soluong[$i]) || !isset($request->dongia[$i]) || !isset($request->supplier) || !isset($request->staff)){
                    Alert::error('Thất bại', 'Vui lòng nhập đầy đủ thông tin!');
                    return redirect()->route('import_goods');
                    die;
                }
                if ($this->compareDate($request->produce_date[$i], $request->expiry_date[$i])){
                    Alert::error('Thất bại', 'Hạn sử dụng sau ngày sản xuất!');
                    return redirect()->route('import_goods');
                    die;
                }
            }

            $import_goods_id = DB::table('import_goods')->insertGetId([
                'supplier_id' => $request->supplier,
                'staff_id' => $request->staff,
                'total' => $total,
            ]);


            for ($i = 0; $i < $product_quantity; $i++){
                $before_inventory_quantity =  DB::table('warehouse')->where('product_id', $request->sanpham[$i])->first()->inventory_quantity;
                DB::table('import_goods_detail')->insert([
                    'import_goods_id'=>$import_goods_id,
                    'product_id'=>$request->sanpham[$i],
                    'quantity'=>$request->soluong[$i],
                    'unit_price'=>$request->dongia[$i],
                    'price'=>$request->soluong[$i] * $request->dongia[$i],
                ]);

                DB::table('warehouse_product')->insert([
                    'import_goods_id'=>$import_goods_id,
                    'product_id'=>$request->sanpham[$i],
                    'quantity'=>$request->soluong[$i],
                    'produce_date'=>$request->produce_date[$i],
                    'expiry_date'=>$request->expiry_date[$i],
                ]);

                DB::table('warehouse')->where('product_id', $request->sanpham[$i])
                    ->update([
                        'inventory_quantity'=>$before_inventory_quantity+$request->soluong[$i],
                    ]);
            }

            return Excel::download(new PhieuNhapHangExport, 'PhieuNhapHang.xlsx');
        } else {
            Alert::error('Thất bại', 'Vui lòng nhập đầy đủ thông tin');
            return redirect()->route('import_goods');
        }
    }
    public function compareDate($date1, $date2){
        $time1 = date_parse_from_format('Y-m-d H:i:s', $date1);
        $time_stamp1 = mktime($time1['hour'],$time1['minute'],$time1['second'],$time1['month'],$time1['day'],$time1['year']);

        $time2 = date_parse_from_format('Y-m-d H:i:s', $date2);
        $time_stamp2 = mktime($time2['hour'],$time2['minute'],$time2['second'],$time2['month'],$time2['day'],$time2['year']);

        $comparision = $time_stamp1 - $time_stamp2;
        if ($comparision>=0){
            return true;
        }
        else{
            return false;
        }
    }
    public function product_detail($product_id){
        $warehouse_product_detail = DB::table('warehouse')
            ->join('product', 'product.id', '=', 'warehouse.product_id')
            ->where('product.id',$product_id)
            ->where('product.is_deleted',0)
            ->first();

        $warehouse_product_detail_import = DB::table('warehouse_product')
            ->select('warehouse_product.*', DB::raw('DATEDIFF(expiry_date, now()) AS day_diff'))
            ->where('product_id',$product_id)
            ->orderBy('warehouse_product_id','DESC')
            ->get();

        return view('admin/warehouse/product_detail')
            ->with(['title'=>'Quản lý kho hàng',
                'warehouse_product_detail'=>$warehouse_product_detail,
                'warehouse_product_detail_import'=>$warehouse_product_detail_import,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
                'controller'=>$this->controller,
            ]);
    }
}
