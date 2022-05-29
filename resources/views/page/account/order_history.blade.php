@extends('page/main')

@section('content')
<section class="ftco-section">
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 text-center">
                <ul class="product-category">
                    <li><a href="{{ route('account') }}" >Thông tin tài khoản</a></li>
                    <li><a href="{{ route('order_history') }}" class="active" >Lịch sử đặt hàng</a></li>
                    <li><a href="{{ route('show_voucher') }}">Mã khuyến mãi</a></li>
                    <li><a href="{{ route('show_favorite') }}">Sản phẩm yêu thích</a></li>
                    <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
    <?php
        if (isset($_GET['page']))
        {
            $page = $_GET['page'];
        }
        else $page = 1;
        $a = ( $page-1)*10+1;

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
                        Địa chỉ nhận hàng
                    </th>
                    <th>
                        Tổng giá tiền
                    </th>
                    <th>
                        Thời gian đặt
                    </th>
                    <th>
                        Thanh toán
                    </th>
                    <th>
                        Tình trạng
                    </th>
                    <th>
                        Thao tác
                    </th>
                </tr>
                <?php $stt=1; ?>
                @foreach($order_history as $value)
                <tr>
                    <th>
                        {{ $a++ }}
                    </th>

                    <th style="text-align: left; width: 200px">
                        {{ $value->address }}
                    </th>
                    <th style="text-align: left">
                        {{ number_format($value->total) }} VNĐ
                    </th>
                    <th>
                        {{strftime('%H:%M %d-%m-%Y', strtotime($value->created_at))}}
                    </th>
                    <th style="text-align: left">
                        {{ $value->method }}
                    </th>
                    <th style="text-align: center">
                        @if ($value->status== "Đang xử lý")
                            <span class="badge badge-info"> {{ $value->status }}</span>
                        @elseif ($value->status== "Đang giao hàng")
                            <span class="badge badge-primary"> {{ $value->status }}</span>
                        @elseif ($value->status== "Đã nhận hàng")
                            <span class="badge badge-success"> {{ $value->status }}</span>
                        @elseif ($value->status== "Đơn hàng bị hủy")
                            <span class="badge badge-danger"> {{ $value->status }}</span>
                        @endif
                    </th>
                    <th style="text-align: left">
                        <a href="" class="btn btn-info detail-order-btn" data-order_id="{{$value->id}}" style="font-size: 13px; width: 50px; height: 33px; margin-right: 5px; margin-left: 47px" data-toggle="modal" data-target="#exampleModalLong" title="Chi tiết đơn hàng" >
                            Xem
                        </a>

                        <!-- Modal -->
                        @if ($value->status== "Đang xử lý")
                        <a href="{{ route('delete_order',['order_id'=>$value->id]) }}" onclick="confirm('Bạn có chắc chắn muốn hủy đơn hàng này')" class="btn btn-danger" style="font-size: 13px; width: 50px; height: 33px">Hủy
                        </a>
                        @elseif ($value->status== "Đã nhận hàng")
                        <a href="/admin/order/export-excel/{{$value->id}}" class="btn btn-success" style="font-size: 15px; width: 50px; height: 33px" title="In đơn hàng" ><i class="fas fa-print"></i>
                        </a>
                        @endif
                    </th>
                </tr>
                @endforeach
            </table>
        <div style="margin-left: 45%">
            {{ $order_history->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle" style="font-size: 16px; font-weight: bold; font-family: arial; margin-left: 38%">Chi tiết đơn hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" style="min-width: 480px !important; max-width: 480px ">
                    <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                    </tr>
                    </thead>
                    <tbody class="list-product">


                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var order_id;
    $('.detail-order-btn').click(function(){
        $('.list-product').empty();
        order_id = $(this).attr('data-order_id');
        console.log('abc');
        var htmlx;
        $.ajax({
            method: "POST",
            url: "{{route('order_detail')}}",
            data:{
                _token: CSRF_TOKEN,
                order_id: order_id,
            },
            success:function(data) {
                $.each(data, function( product_key, product ) {
                    htmlx += '<tr>';
                    htmlx += '<th>'+product.product_name+'</th>';
                    htmlx += '<th>'+product.price+' VNĐ </th>';
                    htmlx += '<th>'+product.quantity+' </th>';
                    htmlx += '</tr>';
                });
                $('.list-product').append(htmlx);
                console.log(htmlx);

            }
        });
    });
</script>
@stop
