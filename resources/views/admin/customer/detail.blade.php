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
                    <th>Xem đơn hàng</th>
                </tr>
                @foreach($order_history as $key)
                <tr>
                    <td>{{ $a++ }}</td>
                    <td>{{strftime('%H:%M %d-%m-%Y', strtotime($key->created_at))}}</td>
                    <td>{{ number_format($key->total) }} VNĐ</td>
                    <td style="font-size: 16px">
                        @if ($key->status== "Đang xử lý")
                            <span class="badge badge-info"><i class="fas fa-clock"></i> {{ $key->status }}</span>
                        @elseif ($key->status== "Đang giao hàng")
                            <span class="badge badge-primary"><i class="fas fa-shipping-fast"></i> {{ $key->status }}</span>
                        @elseif ($key->status== "Đã nhận hàng")
                            <span class="badge badge-success"><i class="fas fa-check"></i> {{ $key->status }}</span>
                        @elseif ($key->status== "Đơn hàng bị hủy")
                            <span class="badge badge-danger"><i class="fas fa-x"></i> {{ $key->status }}</span>
                        @endif
                    </td>
                    <td>{{ $key->method }} </td>
                    <td>
                        <a class="btn btn-info" href="{{ route('order_detail_show', ['order_id'=> $key->id]) }}" title="Xem chi tiết" style="margin-right: 5px"> <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </table>
            <div style="margin-right: 0px">{{ $order_history->links('pagination::bootstrap-4') }}</div>

        </div>
    </div>

@stop
