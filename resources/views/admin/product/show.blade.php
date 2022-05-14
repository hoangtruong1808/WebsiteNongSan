@extends('admin/main')

@section('content')
    <?php $stt=1 ?>
            <table style="text-align: center" class="table table-bordered" id="datatable"  >
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th style="width:400px">Thành phần</th>
                        <th>Xuất sứ</th>
                        <th>Giá</th>
                        <th>Kích hoạt</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <?php $stt=1 ?>
                <tbody>
                    @foreach($product as $item)
                    <tr id="row{{$item->id}}">
                        <td>{{ $stt++ }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->thanhphan }}</td>
                        <td>{{ $item->xuatsu }}</td>
                        <td>{{ number_format($item->price)}}đ/{{ $item->unit}}</td>
                        <td>
                            @if ($item->active == 1)
                                <span class="badge badge-success" style="font-size: 14px">Sử dụng</span>
                            @elseif ($item->active == 0)
                                <span class="badge badge-danger" style="font-size: 14px">Không sử dụng</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('product_edit',['product_id' => $item->id]) }}" title="Cập nhật sản phẩm"> <i class="fas fa-edit"></i>
                            </a>
                            <a href="" class="delete-button" data-toggle="modal" data-target="#delete-data" data-id="{{$item->id}}" style="color:red" title="Xóa sản phẩm">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <a href="" class="export-qr-button"  data-id="{{$item->id}}" style="color:black" title="Xuất QR">
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
                            if (typeof(data.error_input) != "undefined" && data.error_input_export !== null)
                            {
                                swal("Thành công", "Xóa sản phẩm thất bại!", "error");
                            }
                            else {
                                $(".xoa-modal").modal('hide');
                                $("#row" + delete_id).remove();
                                $(".alert").remove();
                                swal("Thành công", "Xóa danh mục thành công!", "success");
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
