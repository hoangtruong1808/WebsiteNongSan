<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
Use Alert;
use Validator;
use Response;

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

        return view('admin/warehouse/show')
            ->with(['title'=>'Quản lý kho hàng',
                    'warehouse'=>$warehouse,
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

        return view('admin/warehouse/show')
            ->with(['title'=>'Quản lý kho hàng',
                'warehouse'=>$warehouse,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
            ]);
    }
    public function import_goods(){
        $staff = DB::table('staff')
            ->where('is_deleted', 0)
            ->where('role', 1)
            ->get();
        return view('admin/warehouse/import_goods')
            ->with(['title'=>'Nhập hàng',
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
                'staff'=>$staff,
            ]);
    }
}
