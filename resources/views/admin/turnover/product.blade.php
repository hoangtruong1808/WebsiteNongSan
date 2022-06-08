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
                        <a class="btn btn-default" href="{{route('turnover_product_chart')}}" style="font-size: 16px; margin-left: 20px ;margin-right: 10px; color: grey"><i class="fas fa-chart-line"></i></a>
                    </div>
                </div>
            </div>
            <?php $stt=1 ?>
            <table class="table table-bordered" id="datatable"  >
                <thead>
                <tr style="text-align: center" >
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng đã bán</th>
                    <th>Doanh thu</th>
                </tr>
                </thead>
                <?php
                $stt=1;
                $total = 0;

                ?>
                <tbody>
                @foreach($turnover_product as $item)
                    <tr id="row{{$item->id}}">
                        <td style="text-align: center" >{{ $stt++ }}</td>
                        <td>{{ $item->name }}</td>
                        <td style="text-align: center">{{ number_format($item->price)}} VNĐ</td>
                        <td style="text-align: center">{{ ceil($item->sum) }}</td>
                        <td style="text-align: center">{{ number_format($item->price*ceil($item->sum)) }} VNĐ</td>
                        <?php $total += $item->price*ceil($item->sum) ?>
                    </tr>
                @endforeach
                    <tr>
                        <td colspan="4" style="text-align: center"><b>Tổng doanh thu</b></td>
                        <td style="text-align: center">{{number_format($total)}} VNĐ</td>
                    </tr>
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
