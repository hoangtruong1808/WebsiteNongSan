@extends('admin/main')

@section('content')

    <div class="content-wrapper">
        <div class="card card-primary" style="margin: 20px 30px 0px 30px">
            <div class="card-header" style="background-color: #298A08; " >
                <div class="row">
                    <div class="col-sm-10">
                        <h3 class="card-title" style="padding-top: 5px">{{ $title }}</h3>
                    </div>
                </div>
            </div>
            <form action="" method="post">
                @csrf()
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nhà cung cấp</label>
                        <select class="form-control input-lg select2 select2-hidden-accessible area" style="width: 100%;" tabindex="-1" aria-hidden="true" name="nhacungcap" required>
                            <option value="" selected disabled hidden>Chọn nhà cung cấp</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Nhân viên nhập hàng</label>
                        <select class="form-control input-lg select2 select2-hidden-accessible area" style="width: 100%;" tabindex="-1" aria-hidden="true" name="nhacungcap" required>
                            <option value="" selected disabled hidden>Chọn nhà cung cấp</option>
                            @foreach($staff as $value)
                                <option value="{{ $value->id }}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Số sản phẩm:</label>
                        <div style=" display:block">
                            <input type="text" class="form-control" style="width: 80px; display:unset" id="sosanpham" name="sosanpham" value="1" required>
                            <a class="btn btn-default" id="tao" style="display: unset ">Tạo</a>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered tbl-dgrr-physical" >
                        <thead>
                        <tr>
                            <th>Loại sản phẩm</th>
                            <th>Số lượng(chỉ)</th>
                            <th>Đơn giá(VNĐ) / chỉ</th>
                            <th>Thành tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="table-row">
                                <td>
                                    <select class="form-control input-lg select2 select2-hidden-accessible area" style="width: 100%;" tabindex="-1" aria-hidden="true" name="sanpham">
                                        <option value="" selected disabled hidden>Loại sản phẩm</option>
{{--                                        @foreach($danhmuc as $value)--}}
{{--                            <option value="{{ $value->ID }}">{{$value->Ten}}</option>--}}
{{--                                        @endforeach--}}
                                     </select>
                                </td>
                                <td>
                                     <input type="text" class="form-control" style="width: 80px" name="soluong[]">
                                </td>
                                <td>
                                    <input type="text" class="form-control" style="width: 150px" name="dongia[]">
                                </td>
                                <td>
                                    <input type="text" class="form-control" style="width: 150px" name="thanhtien[]">
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <!-- /.card-body -->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" style="background-color: #298A08">Tạo danh mục</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            $("#tao").click(function(){
                var sosanpham = $("#sosanpham").val();

                if (sosanpham > 0){
                    if (sosanpham <= 10) {
                        $('tbody').empty();
                        for (var i = 0; i < sosanpham; i++) {
                            $('tbody').append(
                                '<tr class="table-row"><td><select class="form-control input-lg select2 select2-hidden-accessible area" style="width: 100%;" tabindex="-1" aria-hidden="true" name="sanpham[]"> <option value="" selected disabled hidden>Loại sản phẩm</option>  </select></td><td><input type="text" class="form-control" style="width: 80px" name="soluong[]"></td><td><input type="text" class="form-control" style="width: 150px" name="dongia[]"></td><td><input type="text" class="form-control" style="width: 150px" name="thanhtien[]"></td></tr>'
                            );
                        }
                    }
                    else{
                        swal("Thất bại", "Số sản phẩm không quá 10", "error");
                    }
                }
                else{
                    swal("Thất bại", "Số sản phẩm phải lớn hơn 0", "error");
                }
            });

        });
    </script>
@stop
