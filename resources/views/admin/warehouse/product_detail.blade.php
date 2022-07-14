@extends('admin/main')

@section('content')
    <style>
        .badge{
            font-size: 17px;
        }
    </style>
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
                    <th></th>
                    <th>Thông tin sản phẩm</th>
                    <th>Đang giao</th>
                    <th>Tồn kho</th>
                </tr>
                <tr>
                    <td><img src="{{asset('storage/product/'.$warehouse_product_detail->thumb)}}" width="60" height="60"></td>
                    <td style="text-align: left; width:170px ">
                        <div>{{ $warehouse_product_detail->name .' '.$warehouse_product_detail->unit }}</div>
                        <div>Giá: {{ number_format($warehouse_product_detail->price) }} VNĐ</div>
                        <div>Mã sản phẩm: {{ $warehouse_product_detail->product_id }}</div>
                    </td>
                    <td><span class="badge badge-info">{{ $warehouse_product_detail->delivery_quantity }}</span></td>
                    <td> <span class="badge badge-primary">{{ $warehouse_product_detail->inventory_quantity }}</span></td>
                </tr>
            </table>
            <br>
            <?php $a=1 ?>
            <table style="text-align: center" class="table table-bordered" >
                <tr>
                    <th colspan='5'>Quản lý lô hàng</th>
                </tr>

                <tr>
                    <th>
                        STT
                    </th>
                    <th>Số lượng sản phẩm còn lại</th>
                    <th>Ngày sản xuất</th>
                    <th>Hạn sử dụng</th>
                </tr>
                @foreach($warehouse_product_detail_import as $value)
                    <tr>
                        <td>
                            {{$a++}}
                        </td>
                        <td>
                            @if (($value->day_diff < 5) && ($value->day_diff > 0))
                                <span class="badge badge-danger">{{$value->quantity}}</span>
                            @elseif (($value->day_diff < 0))
                                <span class="badge">0</span>
                            @else
                                <span class="badge">{{$value->quantity}}</span>
                            @endif
                        </td>
                        <td>{{ $value->produce_date }} </td>
                        <td>
                            {{ $value->expiry_date }}
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>

@stop
