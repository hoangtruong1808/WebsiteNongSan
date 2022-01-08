@extends('admin/main')

@section('content')

            <table style="text-align: center" class="table table-bordered" >
                <tr>
                    <th>Họ tên</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                </tr>
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->email }}</td>
                </tr>
            </table>  
            <br>
            <?php $a=1 ?>
            <table style="text-align: center" class="table table-bordered" >
                <tr>
                    <th colspan='5'>Lịch sử đặt hàng</th>
                </tr>       
                <tr>
                    <th>STT</th>
                    <th>Thời gian</th>
                    <th>Tổng tiền</th>
                    <th>Tình trạng</th>
                    <th>Thanh toán</th>
                    <th>Xem chi tiết</th>
                </tr>
                @foreach($order_history as $key)
                <tr>
                    <td>{{ $a++ }}</td>
                    <td>{{ $key->created_at}}</td>
                    <td>{{ number_format($key->total) }} vnđ</td>
                    <td>{{ $key->status }} </td>
                    <td>{{ $key->method }} </td>
                    <td>
                        <a href="{{ route('order_detail_show', ['order_id'=> $key->id]) }}"> <i class="fas fa-edit"></i>
                        </a>                   
                    </td>
                </tr>
                @endforeach
            </table> 

@stop