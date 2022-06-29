@extends('admin/main')

@section('content')
<style>
    .select2-container--default .select2-selection--single{
        padding:6px;
        height: 37px;
        position: relative;
    }
</style>
    <div class="content-wrapper">
        <div class="card card-primary" style="margin: 20px 30px 0px 30px">
            <div class="card-header" style="background-color: #298A08; " >
                <div class="row">
                    <div class="col-sm-11">
                        <h3 class="card-title" style="padding-top: 5px">{{ $title }}</h3>
                    </div>
                </div>
            </div>
            <form action="{{route('import_goods_store')}}" method="post">
                @csrf()
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nhà cung cấp</label>
                        <select class="form-control select2" style=" font-size:14px" tabindex="-1" aria-hidden="true" name="supplier">
                            <option value="" selected disabled hidden>Chọn nhà cung cấp</option>
                            @foreach($supplier as $value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Nhân viên nhập hàng</label>
                        <select class="form-control input-lg select2 select2-hidden-accessible area" style="width: 100%; height: 40px;" tabindex="-1" aria-hidden="true" name="staff">
                            <option value="" selected disabled hidden>Chọn nhân viên nhập</option>
                            @foreach($staff as $value)
                                <option value="{{ $value->id }}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Số sản phẩm:</label>
                        <div style=" display:block">
                            <input type="text" class="form-control" style="width: 80px; display:unset" id="product_quantity" name="product_quantity" value="1">
                            <a class="btn btn-default" id="tao" style="display: unset ">Tạo</a>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered tbl-dgrr-physical" >
                        <thead>
                        <tr>
                            <th>Loại sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá(VNĐ) </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="table-row">
                                <td>
                                    <select class="form-control input-lg select2 select2-hidden-accessible area" style="width: 100%;" tabindex="-1" aria-hidden="true" name="sanpham[]">
                                        <option value="" selected disabled hidden>Chọn sản phẩm</option>
                                        @foreach($product as $value)
                                        <option value="{{ $value->id }}">{{$value->name . ' ' . $value->unit}}</option>
                                        @endforeach
                                     </select>
                                </td>
                                <td>
                                     <input type="text" class="form-control" style="width: 80px" name="soluong[]">
                                </td>
                                <td>
                                    <input type="text" class="form-control" style="width: 150px" name="dongia[]">
                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <!-- /.card-body -->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" style="background-color: #298A08; margin-left: 45%">In hóa đơn</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var tbody_html = $('tbody').html();
            $("#tao").click(function(){
                var sosanpham = $("#product_quantity").val();

                if (sosanpham > 0){
                    if (sosanpham <= 10) {
                        $('tbody').empty();
                        for (var i = 0; i < sosanpham; i++) {
                            $('tbody').append(tbody_html);
                            $('.select2').select2();
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
            $('.select2').select2();


        });
    </script>
@stop
