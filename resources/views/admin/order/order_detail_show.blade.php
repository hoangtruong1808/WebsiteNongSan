@extends('admin/main')

@section('content')
    <div class="content-wrapper">
        <div class="card card-primary" style="margin: 20px 30px 0px 30px">
            <div class="card-header" style="background-color: #298A08; " >
                <div class="row">
                    <div class="col-sm-10">
                        <h3 class="card-title">{{ $title }}</h3>
                    </div>
                </div>
            </div>
            <table style="text-align: center" class="table table-bordered" >
                <tr>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Thời gian đặt</th>
                </tr>
                <tr>
                    <td><a href="{{ route('customer_detail', ['customer_id'=>$order->customer_id]) }}">{{ $order->name }}</a></td>
                    <td>{{ number_format($order->total)}} vnđ</td>
                    <td>{{ $order->status }}</td>
                    <td>{{strftime('%H:%M %d-%m-%Y', strtotime($order->created_at))}}</td>
                </tr>
            </table>
            <br>
            <?php $a=1 ?>
            <table style="text-align: center" class="table table-bordered" >
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                </tr>
                @foreach($order_detail as $key)
                <tr>
                    <td>{{ $a++ }}</td>
                    <td>{{ $key->name}}</td>
                    <td>{{ $key->quantity }} kg</td>
                    <td>{{ number_format($key->price)}} vnđ</td>
                </tr>
                @endforeach
            </table>
            <br>
            <table style="text-align: center" class="table table-bordered" >
                <tr>
                    <th>Người nhận</th>
                    <th>Địa chỉ</th>
                    <th>Điện thoại</th>
                    <th>Ghi chú</th>
                    <th>Hình thức thanh toán</th>
                </tr>
                <tr>
                    <td>{{ $shipping->name }}</td>
                    <td>{{ $shipping->address}}</td>
                    <td>{{ $shipping->phone }}</td>
                    <td>{{ $shipping->note }}</td>
                    <td>{{ $shipping->method }}</td>
                </tr>
            </table>
        </div>
    </div>
@stop
