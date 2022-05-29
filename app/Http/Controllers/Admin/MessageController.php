<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class MessageController extends Controller
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
    public function message_show()
    {
        $message = DB::table('message')
                ->join('customer', 'message.customer_id', '=', 'customer.id')
                ->select('message.*', 'customer.name')
                ->orderBy('message.id', 'DESC')
                ->get();
        DB::table('message')->where('status',0)
                ->update([
                    'status'=>1,
                ]);
        return view('admin/message/show')
            ->with(['title'=>'Danh sách tin nhắn',
                    'message'=>$message,
                    'unread'=>$this->unread,
                    'unread_count'=>$this->unread_count,
                    'account'=>$this->current_account,
                ]);
    }
}
