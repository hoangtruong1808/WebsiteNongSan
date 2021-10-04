<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class MenuController extends Controller
{
    public function index()
    {
        
    }
    
    public function create()
    {
        return view('admin/menu/create')
                ->with(['title'=>'Tạo danh mục']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('menu')->insert([
            'name'=>$request->name,
            'description'=>$request->description,
            'active'=>$request->active,
        ]);
        return redirect()->route('menu_show');
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
                ->paginate(20);
        return view('admin/menu/show')
            ->with(['title'=>'Danh sách danh mục',
                    'menu'=>$menu 
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
                'menu'=>$menu]);
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
        DB::table('menu')->where('id', $menu_id)->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'active'=>$request->active,
        ]);
        return redirect()->route('menu_show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($menu_id)
    {
        DB::table('menu')->where('id', $menu_id)->delete();
        return redirect()->route('menu_show');
    }

}