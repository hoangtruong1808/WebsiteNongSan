@extends('admin/main')

@section('content')

            <table style="text-align: center" class="table table-bordered" >
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Thành phần</th>
                    <th>Xuất sứ</th>
                    <th>Giá</th>
                    <th>Kích hoạt</th>
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
                @foreach($product as $item)
                <tr>
                    <td>{{ $a++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->thanhphan }}</td>
                    <td>{{ $item->xuatsu }}</td>
                    <td>{{ number_format($item->price)}}đ/{{ $item->unit}}</td>
                    <td>{{ $item->active }}</td>
                    <td>
                        <a href="{{ route('product_edit',['product_id' => $item->id]) }}"> <i class="fas fa-edit"></i>
                        </a>                   
                    </td>
                    <td>
                        <a href="{{ route('product_destroy', ['product_id' => $item->id]) }}" onclick="confirm('Bạn có chắc chắn xóa không?')"> <i class="fas fa-trash-alt"></i>
                        </a>                   
                    </td>
                </tr>
                @endforeach
            </table> 
             
            {{ $product->links('pagination::bootstrap-4') }}
@stop