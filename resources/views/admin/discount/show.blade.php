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
                        <a class="btn btn-default" href="{{ route('discount_create') }}" style="color: grey"><i class="fas fa-plus"></i> Tạo mới</a>
                    </div>
                </div>
            </div>
            <table style="text-align: center" class="table table-bordered" id="datatable" >
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Sản phẩm</th>
                        <th>Mức giảm giá</th>
                        <th>Giá sau giảm giá</th>
                        <th>Thời gian KM</th>
                        <th>Tình trạng</th>
                        <th style="width:100px;">Thao tác</th>
                    </tr>
                </thead>
                <?php $i=1 ?>
                <tbody>
                @foreach($discount as $key=>$item)
                <tr id="row{{$item->ID}}">
                    <td>{{ $i++ }}</td>
                    <td>
                        <img src="{{asset('storage/product/'.$item->thumb)}}" width="60" height="60">
                        <div >
                            <div>{{ $item->name .' '.$item->unit }}</div>
                            <div>Giá: {{ number_format($item->price) }} VNĐ</div>
                            <div>Mã sản phẩm: {{ $item->product_id }}</div>
                        </div>
                    </td>
                    <td>{{ number_format($item->value) }} %</td>
                    <td>{{number_format(round($item->price*(100-$item->value)/100, -3))}} VNĐ</td>
                    <td style="text-align: left">
                        @if(isset($item->date_start))
                        <div>Từ: {{strftime('%H:%M %d-%m-%Y', strtotime($item->date_start))}} </div>
                        @endif
                        @if(isset($item->date_end))
                        <div>Đến: {{strftime('%H:%M %d-%m-%Y', strtotime($item->date_end ))}} </div>
                            @endif
                    </td>
                    <td>
                        <div>
                            @if ($item->discount_active == 1)
                                <span class="badge badge-success" style="font-size: 14px">Đang sử dụng</span>
                            @elseif ($item->discount_active == 2)
                                <span class="badge badge-danger" style="font-size: 14px">Hết hạn sử dụng</span>
                            @elseif ($item->discount_active == 3)
                                <span class="badge badge-warning" style="font-size: 14px">Chưa được sử dụng</span>
                            @elseif ($item->discount_active == 0)
                                <span class="badge" style="font-size: 14px">Không sử dụng</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <a class="btn btn-info" href="{{ route('discount_edit',['discount_id' => $item->ID]) }}" title="Cập nhật"> <i class="fas fa-edit"></i>
                        </a>
                        <a href="" class="delete-button btn btn-danger" data-toggle="modal" data-target="#delete-data" data-id="{{$item->ID}}" title="Xóa">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            {{--            delete modal--}}
            <div class="modal fade xoa-modal" id="delete-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <b style="font-size: 17px">Xác nhận</b>
                        </div>
                        <div class="modal-body" style="font-size: 17px; margin-top: 15px; margin-bottom: 30px; text-align: center">
                            <div style="margin-bottom: 10px"><i class="fas fa-exclamation-triangle" ></i> Bạn có chắc muốn xóa giảm giá này?</div>
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
        $(document).ready(function() {
            $( ".copy-btn" ).click(function() {
                var code = $(this).attr('data-code');
                copyToClipboard(code);
                $(this).css("color", "blue");
                $( ".copy-btn" ).not(this ).css( "color", "black");

            });
        });
        function copyToClipboard(text) {
            var sampleTextarea = document.createElement("textarea");
            document.body.appendChild(sampleTextarea);
            sampleTextarea.value = text; //save main text in it
            sampleTextarea.select(); //select textarea contenrs
            document.execCommand("copy");
            document.body.removeChild(sampleTextarea);
        }
        let delete_select_id;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(".delete-button").click(function(){
            delete_select_id = $(this).data("id");
        });
        $(".delete").click(function(){
            var delete_id = delete_select_id;
            $.ajax({
                method: "POST",
                url: "{{route('discount_destroy')}}",
                data:{
                    _token: CSRF_TOKEN,
                    "discount_id":delete_id,
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
                        swal("Thành công", "Xóa giảm giá thành công!", "success");
                    }
                }
            });
        });
    </script>
@stop
