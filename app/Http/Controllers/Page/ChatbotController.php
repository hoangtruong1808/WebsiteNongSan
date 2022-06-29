<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use Session;
use DB;
use Cart;
use Validator;
use Illuminate\Validation\Rule;
use Alert;
use Mail;


class ChatbotController extends Controller
{
    private $product;
    private $menu_id;
    public function handle()
    {
        session_start();
        $botman = app('botman');

        $botman->hears('{message}', function($botman, $message) {
//            $this->askName($botman);
            $this->script($message, $botman);
        });

        $botman->listen();
    }

    /**
     * Place your BotMan logic here.
     */
    public function script($message, $botman){
        //chứa sản phẩm
        $this->product = DB::table('product')
            ->where('is_deleted', 0)
            ->get();
        //tìm kiếm danh sách sản phẩm
        $message1 = strtolower($message);
        if (($this->containMessage($message1,'danh sách') ||  $this->containMessage($message1,'loại')) && !($this->containMessage($message1,'thông tin') ||  $this->containMessage($message1,'tìm hiểu') ||  $this->containMessage($message1,'chi tiết'))){
            $data_list[6] = ['rau', 'hành', 'ớt', 'cà chua', 'cà rốt', 'cà'];
            $data_list[7] = ['bưởi', 'chuối', 'táo', 'việt quất', 'dưa hấu', 'dâu', 'quýt', 'cherry'];
            $data_list[8] = ['cá', 'tôm', 'cua', 'thịt'];
            $data_list[9] = ['đậu xanh', 'cá khô', 'bò khô', 'hello'];
            $product_list ="";
            foreach($data_list as $menu_key=>$menu_value){
                foreach ($menu_value as $key_word){
                    if ($this->containMessage($message1,$key_word))
                    {

                        $menu_id = $menu_key;
                        $keywords[] = $key_word;
                        foreach ($keywords as $value){
                            $product_list_data = DB::table('product')
                                ->where('product.menu_id', $menu_id)
                                ->where('product.is_deleted', 0)
                                ->whereRaw("product.name LIKE '%$value%'")
                                ->get();
                            foreach ($product_list_data as $product){
                                $product_list .= $product->name .', ';
                            }
                        }
                        if (!empty($product_list)) {
                            $botman->reply("Hiện tại cửa hàng đang bán các loại $key_word bao gồm: " . $product_list . '...');
                        }
                    }
                }
            }
            if ($product_list == ""){
                $botman->reply("Hiện tại cửa hàng không có sẵn danh sách nông sản mà quý khách muốn. Mong bạn thông cảm và chọn lại!");
            }

        }
        //hỏi thông tin sản phẩm
        if (($this->containMessage($message1,'thông tin') ||  $this->containMessage($message1,'tìm hiểu') ||  $this->containMessage($message1,'chi tiết')) & !$this->containMessage($message1,'danh sách') & !$this->containMessage($message1,'loại')) {
            foreach ($this->product as $key=>$product_value){
                if(strpos($message1, strtolower($product_value->name))){
                    $botman->reply("Thông tin chi tiết về sản phẩm $product_value->name tại cửa hàng Nông sản Việt: <br> - Hiện tại cửa hàng đang bán sản phẩm $product_value->name với giá $product_value->price VNĐ/$product_value->unit. <br> - Thành phần $product_value->thanhphan với xuất sứ tại $product_value->xuatsu. <br> Nếu quý khách muốn thêm vào giỏ hàng, vui lòng nhập cú pháp 'thêm giỏ hàng - tên sản phẩm - số lượng cần mua' nhé!.");
                }
            }
        }

        //thêm giỏ hàng
        if ($this->containMessage($message1,'thêm giỏ hàng')) {
            $message_array = explode(',', $message1);
            foreach($message_array as $message_value) {
                foreach ($this->product as $key=>$product_value){
                    if (strpos($message_value, strtolower($product_value->name))) {
                        $cart_message = explode('-', $message_value);
                        if((int)$cart_message[1] && (int)$cart_message[1]>0){
                            $data=[
                                'id'=>$product_value->id,
                                'name'=>$product_value->name . ' ' . $product_value->unit,
                                'quantity'=>(int)$cart_message[1],
                                'price'=>$product_value->price,
                                'thumb'=>$product_value->thumb,

                            ];
                            $product_inventory = DB::table('product')
                                ->where('product.id', $product_value->id)
                                ->join('warehouse', 'product.id', '=', 'warehouse.product_id')
                                ->first()
                                ->inventory_quantity;
                            if ($product_inventory > $data['quantity']) {
                                Cart::add($data['id'], $data['name'], $data['quantity'], $data['price'], $data['id'], ['thumb' => $data['thumb']]);
                                $botman->reply("Thêm giỏ hàng sản phẩm $product_value->name  thành công! <br> Để thanh toán giỏ hàng, Qúy khách vui lòng nhập cú pháp: 'Thanh toán giỏ hàng: Họ tên - SĐT - Địa chỉ - Email - Ghi chú(nếu có)' nhé <br> Ví dụ: Thanh toán giỏ hàng: Hoàng Trường - 012345678 - 22/14 Phan Văn Hớn, TP.Hồ Chí Minh - hoangtruong1808@gmail.com");
                            }
                            else{
                                $botman->reply("Rất tiếc sản phẩm $product_value->name không đủ hàng. Qúy khách vui lòng chọn sản phẩm khác!");
                            }
                        }
                        else{
                            $botman->reply("Mời nhập chính xác số lượng sản phẩm!");
                        }
                    }
                }
            }
        }
        //thanh toán giỏ hàng
        if ($this->containMessage($message1,'thanh toán giỏ hàng') || $this->containMessage($message1,'thanh toán đơn hàng')){
            if (Cart::count()==0 ){
                $botman->reply("Giỏ hàng chưa có sản phẩm nào để thanh toán!");
            }
            else {
                $error = "";
//                Thanh toán giỏ hàng: Hoàng Trường - 012345678 - 22/14 Phan Văn Hớn, TP.Hồ Chí Minh - hoangtruong1808@gmail.com
                $request = new Request();

                $data_array = explode(' - ', $message);
                if (isset($data_array[0]) && isset($data_array[1]) && isset($data_array[2]) && isset($data_array[3]) ) {
                    $request->name = ltrim($data_array[0], "Thanh toán giỏ hàng");
                    $request->name = ltrim($request->name, "thanh toán giỏ hàng");
                    $request->name = ltrim($request->name, ': ');
                    $request->phone = $data_array[1];
                    $request->address = $data_array[2];
                    $request->email = $data_array[3];
                }

                if (isset($data_array[4])){
                    $request->note = $data_array[4];
                }
                $request->payment_method = 'Thanh toán khi nhận hàng';
                if($request->name == NULL || $request->phone == NULL || $request->address == NULL || $request->email == NULL){
                    $error = "Qúy khách vui lòng nhập đầy đủ thông tin theo cú pháp 'Thanh toán giỏ hàng: Họ tên - Số điện thoại - Địa chỉ - Email - Ghi chú'.";
                }
                else{
                    if(!is_numeric($request->phone)){
                        $error = "Qúy khách vui lòng nhập đúng định dạng số điện thoại";
                    }
                    if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $request->email)) {
                        $error = "Qúy khách vui lòng nhập đúng định dạng email";
                    }
                }
                if ($error == ""){
                    $this->store_checkout($request);
                    $botman->reply(            "<p><b>Qúy khách đã đặt hàng thành công!</b></p>
            <p> - Hóa đơn đặt hàng đã được chuyển đến Địa chỉ Email có trong phần Thông tin Khách hàng của chúng tôi.</p>
            <p> - Chúng tôi sẽ liên lạc quý khách khi đơn hàng được giao.</p>
            <p> - Cảm ơn Quý khách đã tin tưởng và sử dụng sản phẩm của chúng tôi. </p>");
                } else{
                    $botman->reply($error);
                }

            }
        }
    }
    public function store_checkout($request)
    {
            $shipping_id = DB::table('shipping')->insertGetId([
                'name'=>$request->name,
                'address'=>$request->address,
                'email'=>$request->email,
                'note'=>$request->note,
                'phone'=>$request->phone,
                'created_at'=> date('Y-m-d H:i:s'),
            ]);
            $payment_id = DB::table('payment')->insertGetId([
                'method'=>$request->payment_method,
                'status'=>'Đang xử lý',
            ]);
            if(isset($_SESSION['id']))
            {
                $customer_id = $_SESSION['id'];
            }
            else {
                $customer_id = 0;
            };
            $order_id = DB::table('order')->insertGetId([
                'customer_id' => $customer_id,
                'shipping_id' => $shipping_id,
                'status' => 'Đang xử lý',
                'total' => Cart::subtotal(0, "", ""),
                'created_at' => date('Y-m-d H:i:s'),
                'payment_id' => $payment_id,
            ]);
            foreach (Cart::content() as $key) {
                DB::table('order_detail')->insert([
                    'product_id' => $key->id,
                    'order_id' => $order_id,
                    'price' => $key->price,
                    'name' => $key->name,
                    'quantity' => $key->qty,

                ]);

                $inventory_quantity =  DB::table('warehouse')
                    ->where('product_id', $key->id)
                    ->first()
                    ->inventory_quantity;
                $wait_delivery_quantity = DB::table('warehouse')
                    ->where('product_id', $key->id)
                    ->first()
                    ->wait_delivery_quantity;
                DB::table('warehouse')
                    ->where('product_id', $key->id)
                    ->update([
                        'wait_delivery_quantity' => $wait_delivery_quantity + $key->qty,
                        'inventory_quantity' => $inventory_quantity - $key->qty,
                    ]);
            }
            if (isset($_SESSION['voucher_id'])) {
                DB::table('use_voucher')->insert([
                    'customer_id' => $customer_id,
                    'order_id' => $order_id,
                    'voucher_id' => $_SESSION['voucher_id'],
                ]);
                DB::table('voucher')
                    ->where('ID', $_SESSION['voucher_id'])
                    ->update([
                        'quantity' => DB::table('voucher')->where('ID', $_SESSION['voucher_id'])->first()->quantity - 1,
                    ]);
            }
            $_SESSION['checkout']['name'] = $request->name;
            $_SESSION['checkout']['address'] = $request->address;
            $_SESSION['checkout']['email'] = $request->email;
            $_SESSION['checkout']['note'] = $request->note;
            $_SESSION['checkout']['phone'] = $request->phone;
            $_SESSION['checkout']['payment'] = $request->payment_method;

        $to_name = "Cửa hàng Nông sản Việt";
        $to_email = $_SESSION['checkout']['email'];//send to this email

        $data = array("name"=>"Đơn hàng từ Nông sản Việt", "body"=>"noi dung body", 'check-out'); //body of mail.blade.php

        $data = $_SESSION['checkout'];

        Mail::send('page/checkout/mail',$data,function($message) use ($to_name,$to_email){
            $message->to('hoangtruong.test@outlook.com.vn')->subject('Thông tin đơn hàng');//send this mail with subject
            $message->from('hoangtruong.test@outlook.com.vn','Cửa hàng nông sản');//send from this mail

        });
        unset($_SESSION['checkout']);
        Cart::destroy();
        unset($_SESSION['voucher_id']);


    }

    public function askName($botman)
    {
        $botman->ask('Hello! What is your Name?', function(Answer $answer) {

//            var_dump($answer);
            $name = $answer->getText();

            $this->say('Nice to meet you '.$name);
        });
    }

    public function containMessage($string1, $string2){
        if (strlen(strstr($string1, $string2)) > 0)
        {
            return true;
        }
        else {
            return false;
        }
    }
}
