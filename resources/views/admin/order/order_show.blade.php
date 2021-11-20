@extends('admin/main')

@section('content')

<table style="text-align: center" class="table table-bordered" >
                <tr>
                    <th>STT</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Thời gian đặt</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php
                if (isset($_GET['page']))
                {
                    $page = $_GET['page'];
                } 
                else $page = 1;
                $a = ( $page-1)*10+1; ?>
                @foreach($order as $item)
                <tr>
                    <td>{{ $a++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->total)}} vnđ</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <a href="{{ route('order_detail_show', ['order_id'=> $item->id]) }}"> <i class="fas fa-edit"></i>
                        </a>                   
                    </td>
                    <td>
                        <a href="" onclick="confirm('Bạn có chắc chắn xóa không?')"> <i class="fas fa-trash-alt"></i>
                        </a>                   
                    </td>
                </tr>
                @endforeach
            </table> 
             
            {{ $order->links('pagination::bootstrap-4') }}
@stop