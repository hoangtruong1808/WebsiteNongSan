<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
Use Alert;
use Validator;

class MenuController extends Controller
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
        $this->controller = 'menu';

    }
    public function index()
    {

    }

    public function create()
    {
        return view('admin/menu/create')
                ->with(['title'=>'Tạo danh mục',
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
        $messages = [
            'name.required' => ' Tên danh mục bắt buộc nhập',
            'description.required' => ' Mô tả bắt buộc nhập',
        ];
        //các loại định dạng bắt buộc khi nhập
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
        ], $messages);

        if ($validator->passes()) {
            DB::table('menu')->insert([
                'name' => $request->name,
                'description' => $request->description,
                'active' => $request->active,
            ]);
            Alert::success('Thành công', 'Thêm danh mục thành công');
            return redirect()->route('menu_show');
        }
        else{
            $error = $validator->errors()->all();
            Alert::error('Thất bại', $error);
            return redirect()->route('menu_create');
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
                ->where("is_deleted", 0)
                ->get();
        return view('admin/menu/show')
            ->with(['title'=>'Danh sách danh mục',
                    'menu'=>$menu,
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
    public function edit($menu_id)
    {
        $menu = DB::table('menu')
                ->where('id', $menu_id)
                ->first();

        return view('admin/menu/edit')
        ->with(['title'=>'Cập nhật danh mục',
                'menu'=>$menu,
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
    public function update(Request $request, $menu_id)
    {
        $messages = [
            'name.required' => ' Tên danh mục bắt buộc nhập',
            'description.required' => ' Mô tả bắt buộc nhập',
        ];
        //các loại định dạng bắt buộc khi nhập
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
        ], $messages);

        if ($validator->passes()) {
            DB::table('menu')->where('id', $menu_id)->update([
                'name'=>$request->name,
                'description'=>$request->description,
                'active'=>$request->active,
            ]);
            Alert::success('Thành công', 'Cập nhật danh mục thành công');
            return redirect()->route('menu_show');
        }
        else{
            $error = $validator->errors()->all();
            Alert::error('Thất bại', $error);
            return redirect()->route('menu_edit', ['menu_id'=>$menu_id]);
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
                $query.= "$key LIKE '%$value%' and ";
            }
        }
        $query = chop($query,"and ");
        if (empty($query)){
            return redirect()->route('menu_show');
        }
        $menu = DB::table('menu')
            ->where("is_deleted", 0)
            ->whereRaw($query)
            ->get();
        return view('admin/menu/show')
            ->with(['title'=>'Danh sách danh mục',
                'menu'=>$menu,
                'unread'=>$this->unread,
                'unread_count'=>$this->unread_count,
                'account'=>$this->current_account,
                'controller'=>$this->controller,
            ]);
    }

}
