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
                <form action="{{route('customer_filter')}}" method="GET">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="padding-left: 47%">
                                <b style="font-size: 17px">Bộ lọc</b>
                            </div>
                            <div class="modal-body">
                                <ul class="fiter-form">
                                    <li><label>Mã khách hàng</label>
                                        <div class="form-group">
                                            <input type="form" name="id" class="form-control" id="name">
                                        </div>
                                    </li>
                                    <li><label>Tên khách hàng</label>
                                        <div class="form-group">
                                            <input type="form" name="name" class="form-control" id="name">
                                        </div>
                                    </li>
                                    <li><label>Địa chi</label>
                                        <div class="form-group">
                                            <input type="form" name="address" class="form-control" id="name">
                                        </div>
                                    </li>
                                    <li><label>Số điện thoại</label>
                                        <div class="form-group">
                                            <input type="form" name="phone" class="form-control" id="name">
                                        </div>
                                    </li>
                                    <li><label>Email</label>
                                        <div class="form-group">
                                            <input type="form" name="email" class="form-control" id="name">
                                        </div>
                                    </li>
                                    <li><label>Trạng thái</label>
                                        <div class="form-check">
                                            <div>
                                                <input class="form-check-input" type="radio" name="is_deleted" value='0'>
                                                <p class="form-check-label">Hoạt động</p>
                                            </div>
                                            <div>
                                                <input class="form-check-input" type="radio" name="is_deleted" value='1'>
                                                <p class="form-check-label">Bị khóa</p>
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
            <table class="table table-bordered" >
                <tr  style="text-align: center">
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Thông tin</th>
                    <th>Số đơn hàng</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                <?php $i=1 ?>
                @foreach($customer as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td style="text-align: left">
                        <div> Địa chỉ: {{ $item->address }}</div>
                        <div> SĐT: {{ $item->phone }}</div>
                        <div> Email: {{ $item->email }}</div>
                    </td>
                    <td style="font-size: 16px">
                        <div>
                            <div class="badge badge-info"><i class="fas fa-clock"></i> : {{ $item->process_order_count }}</div>

                            <div class="badge badge-primary"><i class="fas fa-shipping-fast"></i> : {{ $item->shipping_order_count }}</div>
                        </div>
                        <div>
                            <div class="badge badge-success"><i class="fas fa-check"></i> : {{ $item->complete_order_count }}</div>

                            <div class="badge badge-danger">X: {{ $item->cancel_order_count }}</div>
                        </div>
                        <div>Tổng: {{ $item->order_count }}</div>
                    </td>
                    <td  style="text-align: center">
                        @if($item->is_deleted == 1)
                        <span class="badge badge-dark">Bị khóa</span>
                        @else($item->is_deleted == 0)
                        <span class="badge badge-success">Hoạt động</span>
                        @endif
                    </td>
                    <td style="text-align: center">
                        <a class="btn btn-info" href="{{ route('customer_detail', ['customer_id'=>$item->id]) }}" title="Xem chi tiết" style="margin-right: 5px"> <i class="fas fa-eye"></i>
                        </a>
                        @if($item->is_deleted == 0)
                            <a class="btn btn-secondary" href="{{ route('lock_customer', ['customer_id'=>$item->id]) }}" onclick="confirm('Bạn có chắc chắn muốn khóa tài khoản này?')" title="Khóa tài khoản"> <i class="fas fa-lock"></i>
                            </a>
                        @else($item->is_deleted == 1)
                            <a class="btn" href="{{ route('unlock_customer', ['customer_id'=>$item->id]) }}" title="Mở khóa tài khoản"> <i class="fas fa-unlock"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop
