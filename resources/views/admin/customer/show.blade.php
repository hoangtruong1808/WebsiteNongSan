@extends('admin/main')

@section('content')

            <table style="text-align: center" class="table table-bordered" >
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                </tr>
                <?php $i=1 ?>
                @foreach($customer as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td><a href="{{ route('customer_detail', ['customer_id'=>$item->id]) }}">{{ $item->name }}</a></td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->email }}</td>
                </tr>
                @endforeach
            </table>    
@stop