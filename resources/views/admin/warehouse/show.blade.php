@extends('admin/main')

@section('content')

    <div class="content-wrapper">
        <div class="card card-primary" style="margin: 20px 30px 0px 30px">
            <div class="card-header" style="background-color: #298A08; " >
                <div class="row">
                    <div class="col-sm-11">
                        <h3 class="card-title" style="padding-top: 5px">{{ $title }}</h3>
                    </div>
                    <div class="col-sm-1">
                        <a class="btn btn-default" href="" data-toggle="modal" data-target="#filter-data"  style="font-size: 16px ;margin-right: 10px; color: grey"><i class="fas fa-filter"></i></a>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="filter-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px">
                <form action="{{route('warehouse_filter')}}" method="POST">
                    @csrf
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="padding-left: 47%">
                                <b style="font-size: 17px">Bộ lọc</b>
                            </div>
                            <div class="modal-body">
                                <ul class="fiter-form">
                                    <li><label>Trạng thái tồn kho</label>
                                        <div class="form-check">
                                            <div>
                                                <input class="form-check-input" type="radio" name="filter_status" value='1'>
                                                <p class="form-check-label">Tất cả sản phẩm</p>
                                            </div>
                                            <div>
                                                <input class="form-check-input" type="radio" name="filter_status" value='2'>
                                                <p class="form-check-label">Sản phẩm gần hết hàng</p>
                                            </div>
                                            <div style="margin-bottom: 10px">
                                                <input class="form-check-input" type="radio" name="filter_status" value='3'>
                                                <p class="form-check-label">Sản phẩm hết hàng</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li><label>Tên sản phẩm</label>
                                        <div class="form-group">
                                            <input type="form" name="name" class="form-control" id="name" placeholder="Nhập tên sảm phẩm">
                                        </div>
                                    </li>
                                    <li><label>ID sản phẩm</label>
                                        <div class="form-group">
                                            <input type="form" name="product_id" class="form-control" id="name" placeholder="Nhập ID sản phẩm">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                                <input type="submit" class="btn btn-info filter" style="color:white" value="Lọc">
                            </div>
                        </div>
                    </div>
                    <div class="card bg-success text-white shadow" style="display: none; position: fixed; bottom: 10px; left: 10px; border: none" id="xoahs_thanhcong">
                        <div class="card-body" style="align-items: center; display: flex; padding: 1rem">
                            <i class="fas fa-check-circle fa-2x" style="color: white; margin-right: 5px"></i>
                        </div>
                    </div>
                </form>
            </div>

            <table style="text-align: center" class="table table-bordered" id="datatable"  >
                <thead>
                    <tr style="text-align: center">
                        <th>STT</th>
                        <th>Hình ảnh</th>
                        <th>Thông tin sản phẩm</th>
                        <th>Chờ giao</th>
                        <th>Đang giao</th>
                        <th>Đã bán</th>
                        <th>Tồn kho</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <?php $i=1 ?>
                <tbody>
                @foreach($warehouse as $item)
                    <tr id="row{{$item->id}}">
                        <td>{{ $i++ }}</td>
                        <td><img src="{{asset('storage/product/'.$item->thumb)}}" width="60" height="60"></td>
                        <td style="text-align: left">
                            <div>{{ $item->name }}</div>
                            <div>Giá: {{ number_format($item->price) }} VNĐ</div>
                            <div>Mã sản phẩm: {{ $item->product_id }}</div>
                        </td>
                        <td> <span class="badge badge-warning" style="font-size: 16px">{{ $item->wait_delivery_quantity }}</span></td>
                        <td> <span class="badge badge-info" style="font-size: 16px">{{ $item->delivery_quantity }}</span></td>
                        <td> <span class="badge badge-success" style="font-size: 16px">{{ $item->sold_quantity }}</span></td>
                        <td> <span class="badge badge-primary" id="inventory_quantity_{{ $item->warehouse_id }}" style="font-size: 16px">{{ $item->inventory_quantity }}</span></td>
                        <td>
                            <input type="button" value="-" class="btn-minus" data-id="{{ $item->warehouse_id }}"/>
                            <input id="quantity_{{$item->warehouse_id}}" name='quantity' type='text' style="width: 50px; text-align: center" value="0"/>
                            <input type="button" value="+" class="btn-plus" data-id="{{ $item->warehouse_id }}"/>
                            <button class="btn btn-secondary save-button" id="save-button_{{$item->warehouse_id}}"   data-id="{{$item->warehouse_id}}" data-inventory="{{$item->inventory_quantity}}" style="margin-left: 5px" title="Lưu cập nhật">
                                <i class="fas fa-save"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
{{--            delete modal--}}
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var quantity;
            var soluong;
            $(".btn-minus").click(function () {
                var id = $(this).attr('data-id');
                quantity = Number($('#quantity_'+id).val());
                quantity = quantity - 1;
                $('#quantity_'+id).val(quantity);
            });
            $('.btn-plus').click(function () {
                var id = $(this).attr('data-id');
                quantity = Number($('#quantity_'+id).val());
                quantity = quantity + 1;
                $('#quantity_'+id).val(quantity);
            });
            $('.save-button').click(function () {
                console.log('abc');
                var warehouse_id = $(this).attr('data-id');
                var add_quantity = Number($('#quantity_'+warehouse_id).val());
                var inventory_quantity = Number($(this).attr('data-inventory'))+add_quantity;
                // console.log(warehouse_id);
                $.ajax({
                    method: "POST",
                    url: "{{route('warehouse_update')}}",
                    data:{
                        _token: CSRF_TOKEN,
                        "inventory_quantity":inventory_quantity,
                        "warehouse_id":warehouse_id,
                        "add_quantity":add_quantity,
                    },
                    success:function(data) {

                        if(data.success==true){
                            $('#quantity_'+warehouse_id).val(0);
                            $('#inventory_quantity_'+warehouse_id).html(inventory_quantity);
                            $('#save-button_'+warehouse_id).attr('data-inventory', inventory_quantity);
                            swal("Thành công", 'Cập nhật số lượng thành công', "success");
                        }
                        else{
                            swal("Thất bại", data.error, "error");
                        }
                    }
                });
            })
        });
    </script>
@stop
