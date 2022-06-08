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
                        <a class="btn btn-default" href="{{ route('voucher_create') }}" style="color: grey"><i class="fas fa-plus"></i> Tạo mới</a>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="filter-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px">
                <form action="{{route('voucher_filter')}}" method="GET">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="padding-left: 47%">
                                <b style="font-size: 17px">Bộ lọc</b>
                            </div>
                            <div class="modal-body">
                                <ul class="fiter-form">
                                    <li><label>Mô tả</label>
                                        <div class="form-group">
                                            <textarea id="description" name="describe" class="form-control"></textarea>
                                        </div>
                                    </li>
                                    <li><label>Mức giảm giá</label>
                                        <div class="form-group" style="display:block">
                                            <input type="form" name="value" style="width:78%; display:unset" class="form-control" id="name" placeholder="Nhập tên danh mục">
                                            <select class="form-control"  style="display:unset; width:20%" id="unit" name="unit">
                                                <option value="">Chọn đơn vị</option>
                                                <option value="VNĐ">VNĐ</option>
                                                <option value="%">%</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li><label>Thời gian khuyến mãi</label>
                                        <div class="form-group" >
                                            <div style=" display:block; margin-bottom: 10px">
                                                <span> Từ </span>
                                                <input type="datetime-local" name="start_date" class="form-control" style="margin-left: 10px; width:60%; display:unset" id="min_price">
                                                <span> VNĐ</span>
                                            </div>

                                            <div style=" display:block">
                                                <span> Đến </span>
                                                <input type="datetime-local" name="end_date" class="form-control" style="width:60%; display:unset" id="max_price">
                                                <span>VNĐ</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="customer_type">Áp dụng với khách hàng </label>
                                        <div class="form-group" >
                                            <select class="form-control" id="customer_type" name="customer_type">
                                                <option value="">Chọn loại khách hàng</option>
                                                <option value="0">Tất cả khách hàng</option>
                                                <option value="1">Khách hàng vip</option>
                                                <option value="2">Khách hàng thường</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li><label>Tình trạng</label>
                                        <div class="form-check">
                                            <div>
                                                <input class="form-check-input" type="radio" name="active" value='1'>
                                                <p class="form-check-label">Đang sử dụng</p>
                                            </div>
                                            <div>
                                                <input class="form-check-input" type="radio" name="active" value='0'>
                                                <p class="form-check-label">Hết hạn</p>
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

            <table style="text-align: center" class="table table-bordered" id="datatable" >
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã code</th>
                        <th>Mô tả</th>
                        <th>Mức giảm giá</th>
                        <th>Đơn hàng</th>
                        <th>SL còn</th>
                        <th>Thời gian KM</th>
                        <th>Tình trạng</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <?php $i=1 ?>
                <tbody>
                @foreach($voucher as $key=>$item)
                <tr id="row{{$item->ID}}">
                    <td>{{ $i++ }}</td>
                    <td>
                        <div>{{ $item->code }}</div>
                        <div><button class="copy-btn" data-code="{{ $item->code }}" title="Copy" style="border: 0.5px darkgrey solid"><i class="fas fa-copy"></i></button></div>
                    </td>
                    <td>{{ $item->describe }}</td>
                    <td>{{ number_format($item->value) }} {{ $item->unit }}</td>
                    <td>
                        @if(isset($item->order_min))
                        <div>Từ: {{ number_format($item->order_min) }} VNĐ</div>
                        @endif
                        @if(isset($item->order_max))
                        <div>Đến: {{ number_format($item->order_max) }} VNĐ</div>
                                @endif
                    </td>
                    <td>
                        {{ $item->quantity }}
                    </td>
                    <td>
                        @if(isset($item->date_start))
                        <div>Từ: {{strftime('%H:%M %d-%m-%Y', strtotime($item->date_start))}} </div>
                        @endif
                        @if(isset($item->date_end))
                        <div>Đến: {{strftime('%H:%M %d-%m-%Y', strtotime($item->date_end ))}} </div>
                            @endif
                    </td>
                    <td>
                        <div>
                            @if ($item->active == 1)
                                <span class="badge badge-success" style="font-size: 14px">Đang sử dụng</span>
                            @elseif ($item->active == 2)
                                <span class="badge badge-danger" style="font-size: 14px">Hết hạn sử dụng</span>
                            @elseif ($item->active == 3)
                                <span class="badge badge-warning" style="font-size: 14px">Chưa được sử dụng</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <a class="btn btn-info" href="{{ route('voucher_edit',['voucher_id' => $item->ID]) }}" title="Cập nhật mã khuyến mãi"> <i class="fas fa-edit"></i>
                        </a>
                        <a href="" class="delete-button btn btn-danger" data-toggle="modal" data-target="#delete-data" data-id="{{$item->ID}}" title="Xóa mã khuyến mãi">
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
                            <div style="margin-bottom: 10px"><i class="fas fa-exclamation-triangle" ></i> Bạn có chắc muốn xóa mã giảm giá này?</div>
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
                url: "{{route('voucher_destroy')}}",
                data:{
                    _token: CSRF_TOKEN,
                    "voucher_id":delete_id,
                },
                success:function(data) {
                    if (typeof(data.error_input) != "undefined" && data.error_input_export !== null)
                    {
                        swal("Thất bại", "Xóa mã giảm giá thất bại!", "error");
                    }
                    else {
                        $(".xoa-modal").modal('hide');
                        $("#row" + delete_id).remove();
                        $(".alert").remove();
                        swal("Thành công", "Xóa mã giảm giá thành công!", "success");
                    }
                }
            });
        });
    </script>
@stop
