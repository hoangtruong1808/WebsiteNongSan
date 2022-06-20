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
                        <a class="btn btn-default" href="{{ route('supplier_create') }}" style="color: grey"><i class="fas fa-plus"></i> Tạo mới</a>
                    </div>
                </div>
            </div>
            <?php $stt=1 ?>
            <table class="table table-bordered" id="datatable"  >
                <thead>
                    <tr style="text-align: center" >
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <?php $stt=1 ?>
                <tbody>
                    @foreach($supplier as $item)
                    <tr id="row{{$item->id}}">
                        <td style="text-align: center" >{{ $stt++ }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->mail }}</td>
                        <td style="text-align: center" >
                            <a class="btn btn-info" href="{{ route('supplier_edit',['supplier_id' => $item->id]) }}" title="Cập nhật nhà cung cấp"> <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger delete-button" href="" data-toggle="modal" data-target="#delete-data" data-id="{{$item->id}}"  title="Xóa nhà cung cấp">
                                <i class="fas fa-trash-alt"></i>
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
                            <div style="margin-bottom: 10px"><i class="fas fa-exclamation-triangle" ></i> Bạn có chắc muốn xóa nhà cung cấp này?</div>
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
                        url: "{{route('supplier_destroy')}}",
                        data:{
                            _token: CSRF_TOKEN,
                            "supplier_id":delete_id,
                        },
                        success:function(data) {
                            if (typeof(data.error_input) != "undefined" && data.error_input_export !== null)
                            {
                                swal("Thành công", "Xóa nhà cung cấp thất bại!", "error");
                            }
                            else {
                                $(".xoa-modal").modal('hide');
                                $("#row" + delete_id).remove();
                                $(".alert").remove();
                                swal("Thành công", "Xóa nhà cung cấp thành công!", "success");
                            }
                        }
                    });
                });

            </script>

@stop
