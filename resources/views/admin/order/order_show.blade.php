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
                        <a class="btn btn-default" href="" data-toggle="modal" data-target="#filter-data"  style="font-size: 16px; margin-left: 20px ;margin-right: 10px; color: grey"><i class="fas fa-filter"></i></a>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="filter-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px">
                <form action="{{route('order_filter')}}" method="GET">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="padding-left: 47%">
                                <b style="font-size: 17px">Bộ lọc</b>
                            </div>
                            <div class="modal-body">
                                <ul class="fiter-form">
                                    <li><label>Tên khách hàng</label>
                                        <div class="form-group">
                                            <input type="form" name="customer_name" class="form-control" id="name">
                                        </div>
                                    </li>
                                    <li><label>Mã khách hàng</label>
                                        <div class="form-group">
                                            <input type="form" name="customer_id" class="form-control" id="name">
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
                                    <li><label>Thời gian đặt</label>
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
                                    <li><label>Trạng thái</label>
                                        <div class="form-group">
                                            <select name="status">
                                                <option value="" selected disabled>Chọn trạng thái</option>
                                                <option value="Đang xử lý">Đang xử lý</option>
                                                <option value="Đang giao hàng">Đang giao hàng</option>
                                                <option value="Đã nhận hàng">Đã nhận hàng</option>
                                                <option value="Đơn hàng bị hủy">Đơn hàng bị hủy</option>
                                            </select>
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
            <table class="table table-bordered" id="datatable" >
                <thead>
                <tr style="text-align: center">
                    <th>STT</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Thời gian đặt</th>
{{--                    <th style="width: 100px">Đang giao hàng</th>--}}
{{--                    <th style="width: 100px">Đã nhận hàng</th>--}}
                    <th>Thao tác</th>
                </tr>
                </thead>
                <?php $i=1 ?>
                <tbody>
                @foreach($order as $item)
                <tr>
                    <td style="text-align: center">{{ $i++ }}</td>
                    <td><a href="{{ route('customer_detail', ['customer_id'=>$item->customer_id]) }}">{{ $item->name }}</a></td>
                    <td>{{ number_format($item->total)}} VNĐ</td>
                    <td style="text-align: center">
                        @if ($item->status== "Đang xử lý")
                            <span class="badge badge-info"><i class="fas fa-clock"></i> {{ $item->status }}</span>
                        @elseif ($item->status== "Đang giao hàng")
                            <span class="badge badge-primary"><i class="fas fa-shipping-fast"></i> {{ $item->status }}</span>
                        @elseif ($item->status== "Đã nhận hàng")
                            <span class="badge badge-success"><i class="fas fa-check"></i> {{ $item->status }}</span>
                        @elseif ($item->status== "Đơn hàng bị hủy")
                            <span class="badge badge-danger"><i class="fas fa-x"></i> {{ $item->status }}</span>
                        @endif
                    </td>
                    <td style="text-align: center">
                        {{strftime('%H:%M %d-%m-%Y', strtotime($item->created_at))}}
                    </td>
                    <td style="text-align: center">
                        <a class="btn btn-info" href="{{ route('order_detail_show', ['order_id'=> $item->id]) }}" title="Xem chi tiết" style="margin-right: 5px"> <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-secondary" title="Cập nhật trạng thái" style="color:white; margin-right: 5px"  data-toggle="modal" data-target="#update-status-{{$item->id}}" ><i class="fas fa-pen"></i>
                        </a>
                        <a class="btn btn-success" href="{{ route('export_excel', ['order_id'=> $item->id]) }}" title="In đơn hàng" style="margin-right: 5px"> <i class="fas fa-print"></i>
                        </a>
                        <a class="btn btn-danger" href="" onclick="confirm('Bạn có chắc chắn xóa không?')" title="Xóa đơn hàng"> <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                    <div class="modal fade" id="update-status-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px">
                        <form action="{{route('update_status_order',['order_id'=>$item->id])}}" method="POST">
                            @csrf()
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="margin-left: 35%">
                                        <b style="font-size: 17px">Cập nhật trạng thái</b>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-check" style="margin-left: 10%; font-size: 18px">
                                            <div>
                                                <input class="form-check-input" type="radio" name="status" value='Đang xử lý' {{($item->status == 'Đang xử lý')?'checked':''}}>
                                                <span class="badge badge-info"><i class="fas fa-clock"></i> Đang xử lý</span>
                                            </div>
                                            <div>
                                                <input class="form-check-input" type="radio" name="status" value='Đang giao hàng' {{($item->status == 'Đang giao hàng')?'checked':''}}>
                                                <span class="badge badge-primary"><i class="fas fa-shipping-fast"></i> Đang giao hàng</span>
                                            </div>
                                            <div>
                                                <input class="form-check-input" type="radio" name="status" value='Đã nhận hàng' {{($item->status == 'Đã nhận hàng')?'checked':''}}>
                                                <span class="badge badge-success"><i class="fas fa-check"></i> Đã nhận hàng</span>
                                            </div>
                                            <div>
                                                <input class="form-check-input" type="radio" name="status" value='Đơn hàng bị hủy' {{($item->status == 'Đơn hàng bị hủy')?'checked':''}}>
                                                <span class="badge badge-danger"><i class="fas fa-x"></i> Hủy đơn hàng</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                                        <input type="submit" class="btn btn-info filter" style="color:white" value="Cập nhật">
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
                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@stop
