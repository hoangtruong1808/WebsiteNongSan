@extends('page/main')
            
@section('content')
<section class="ftco-section">
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 text-center">
                <ul class="product-category">
                    <li><a href="{{ route('account') }}" >Thông tin tài khoản</a></li>
                    <li><a href="{{ route('order_history') }}" class="active" >Lịch sử đặt hàng</a></li>
                    <li><a href="{{ route('account_post') }}">Đăng tin sản phẩm</a></li>
                    <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container"> 
    <?php
                $message = Session::get('message');
                if($message) {
                    echo '<div class="alert alert-success" style="width: 100%">'.$message.'</div>';
                    Session::put('message', null);
                }
                $stt=1;
            ?>
            <table class="table">
                
                <tr>
                    <th>
                        STT
                    </th>
                    <th>
                        Thời gian đặt
                    </th>
                    <th>
                        Người nhận hàng
                    </th>
                    <th>
                        Địa chỉ
                    </th>
                    <th>
                        Số điện thoại
                    </th>
                    <th>
                        Tổng giá tiền
                    </th>
                    <th>
                        Thanh toán
                    </th>
                    <th>
                        Tình trạng
                    </th>
                    <th></th>
                </tr>
                <?php $stt=1; ?>
                @foreach($order_history as $value)
                <tr>
                    <th>
                        {{ $stt++ }}
                    </th>
                    <th>
                        {{ $value->created_at }}
                    </th>
                    <th>
                        {{ $value->name }}
                    </th>
                    <th>
                        {{ $value->address }}
                    </th>
                    <th>
                        {{ $value->phone }}
                    </th>
                    <th>
                        {{ number_format($value->total) }} VNĐ
                    </th>
                    <th>
                        {{ $value->method }}
                    </th>
                    <th>
                        {{ $value->status }}
                    </th>
                    <th>
                        @if ($value->status== "Đang xử lý")
                        <a href="{{ route('delete_order',['order_id'=>$value->id]) }}" onclick="confirm('Bạn có chắc chắn muốn hủy đơn hàng này')" style="color:blue">Hủy</i>
                        </a> 
                        @endif     
                    </th>
                </tr>
                @endforeach
            </table>
    </div>
</section>
@stop