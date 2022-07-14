@extends('admin/main')

@section('content')
    <div class="content-wrapper">
        <div class="card card-primary" style="margin: 20px 30px 0px 30px">
            <div class="card-header" style="background-color: #298A08; " >
                <div class="row">
                    <div class="col-sm-10">
                        <h3 class="card-title" style="padding-top: 5px">{{ $title }}</h3>
                    </div>
                    <div class="col-sm-2">
                        <a class="btn btn-default" href="" data-toggle="modal" data-target="#filter-data"  style="font-size: 16px; margin-left: 20px ;margin-right: 10px; color: grey"><i class="fas fa-filter"></i></a>
                        <a class="btn btn-default" href="{{ route('product_create') }}" style="color: grey"><i class="fas fa-plus"></i> Tạo mới</a>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="filter-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px">
                <form action="{{route('product_filter')}}" method="GET">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="padding-left: 47%">
                                <b style="font-size: 17px">Bộ lọc</b>
                            </div>
                            <div class="modal-body">
                                <ul class="fiter-form">
                                    <li><label>Tên sản phẩm</label>
                                        <div class="form-group">
                                            <input type="form" name="name" class="form-control" id="name">
                                        </div>
                                    </li>
                                    <li><label>Mô tả</label>
                                        <div class="form-group">
                                            <textarea id="description" name="description" class="form-control"></textarea>
                                        </div>
                                    </li>
                                    <li><label>Danh mục</label>
                                        <div class="form-group">
                                            <select class="form-control" name="menu_id">
                                                <option value="" selected disabled>Chọn danh mục</option>
                                                @foreach($menu as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                    <li><label>Giá</label>
                                        <div class="form-group" >
                                            <div style=" display:block; margin-bottom: 10px">
                                                <span> Từ </span>
                                                <input type="form" name="min_price" class="form-control" style="margin-left: 10px; width:60%; display:unset" id="min_price">
                                                <span> VNĐ</span>
                                            </div>

                                            <div style=" display:block">
                                                <span> Đến </span>
                                                <input type="form" name="max_price" class="form-control" style="width:60%; display:unset" id="max_price">
                                                <span>VNĐ</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li><label>Xuất xứ</label>
                                        <div class="form-group">
                                            <input type="form" name="xuatsu" class="form-control" id="xuatsu">
                                        </div>
                                    </li>
                                    <li><label>Kích hoạt</label>
                                        <div class="form-check">
                                            <div>
                                                <input class="form-check-input" type="radio" name="active" value='1'>
                                                <p class="form-check-label">Có</p>
                                            </div>
                                            <div>
                                                <input class="form-check-input" type="radio" name="active" value='0'>
                                                <p class="form-check-label">Không</p>
                                            </div>
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

    <?php $stt=1 ?>
            <table class="table table-bordered" id="datatable"  >
                <thead>
                    <tr style="text-align: center" >
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Xuất xứ</th>
                        <th>Giá</th>
                        <th>Kích hoạt</th>
                        <th style="width:150px">Thao tác</th>
                    </tr>
                </thead>
                <?php $stt=1 ?>
                <tbody>
                    @foreach($product as $item)
                    <tr id="row{{$item->id}}">
                        <td style="text-align: center" >{{ $stt++ }}</td>
                        <td>{{ $item->name }} {{ $item->unit}}</td>
                        <td>{{ $item->xuatsu }}</td>
                        <td>{{ number_format($item->price)}} VNĐ</td>
                        <td style="text-align: center" >
                            @if ($item->active == 1)
                                <span class="badge badge-success" style="font-size: 14px">Sử dụng</span>
                            @elseif ($item->active == 0)
                                <span class="badge badge-danger" style="font-size: 14px">Không sử dụng</span>
                            @endif
                        </td>
                        <td style="text-align: center" >
                            <a class="btn btn-info" href="{{ route('product_edit',['product_id' => $item->id]) }}" title="Cập nhật sản phẩm"> <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger delete-button" href="" data-toggle="modal" data-target="#delete-data" data-id="{{$item->id}}"  title="Xóa sản phẩm">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <a class="btn btn-secondary export-qr-button" href=""  data-id="{{$item->id}}" title="Xuất QR">
                                <i class="fas fa-qrcode"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="modal fade xoa-modal" id="delete-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <b style="font-size: 17px">Xác nhận</b>
                        </div>
                        <div class="modal-body" style="font-size: 17px; margin-top: 15px; margin-bottom: 30px; text-align: center">
                            <div style="margin-bottom: 10px"><i class="fas fa-exclamation-triangle" ></i> Bạn có chắc muốn xóa sản phẩm này?</div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                            <a class="btn btn-primary delete">Xóa</a>
                        </div>
                    </div>
                </div>
                <div class="card bg-success text-white shadow" style="display: none; position: fixed; bottom: 10px; left: 10px; border: none" id="xoahs_thanhcong">
                    <div class="card-body" style="align-items: center; display: flex; padding: 1rem">
                        <i class="fas fa-check-circle fa-2x" style="color: white; margin-right: 5px"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <script>
                let delete_select_id;
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $(".delete-button").click(function(){
                    delete_select_id = $(this).data("id");
                    console.log(delete_select_id);
                });
                $(".delete").click(function(){
                    var delete_id = delete_select_id;
                    console.log(delete_id);
                    $.ajax({
                        method: "POST",
                        url: "{{route('product_destroy')}}",
                        data:{
                            _token: CSRF_TOKEN,
                            "product_id":delete_id,
                        },
                        success:function(data) {
                            if (data.error != null)
                            {
                                swal("Thất bại", data.error, "error");
                                $(".xoa-modal").modal('hide');
                            }
                            else {
                                $(".xoa-modal").modal('hide');
                                $("#row" + delete_id).remove();
                                $(".alert").remove();
                                swal("Thành công", "Xóa sản phẩm thành công!", "success");
                            }
                        }
                    });
                });
                $(".export-qr-button").click(function() {
                    var product_id =  $(this).data("id");
                    window.open('/admin/product/export-qrcode/'+product_id, '_blank', 'location=yes,height=450,width=700,scrollbars=yes,status=yes');
                });

            </script>

@stop
