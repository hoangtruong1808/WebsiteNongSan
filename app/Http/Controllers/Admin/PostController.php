<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;

class PostController extends Controller
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
    public function post_show()
    {
        $post = DB::table('post')
            ->orderBy('id', 'DESC')
            ->paginate(20);
        return view('admin.post.show')->with([
            'title'=>'Quản lý bài đăng cần bán cần mua',
            'post'=>$post,
            'unread'=>$this->unread,
            'unread_count'=>$this->unread_count,
        ]);
    }
    public function post_approve($post_id)
    {
        DB::table('post')
        ->where('id', $post_id)
        ->update([
            'status'=>'Đã duyệt',
        ]);
        Session::flash('message','Duyệt bài thành công!');
        return redirect()->route('post_show');
    }
    public function post_cancel($post_id)
    {
        DB::table('post')
        ->where('id', $post_id)
        ->update([
            'status'=>'Không được duyệt',
        ]);
        Session::flash('message','Không duyệt bài thành công!');
        return redirect()->route('post_show');
    }
}
