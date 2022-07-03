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
                        <a class="btn btn-default" href="{{ route('staff_create') }}" style="color: grey"><i class="fas fa-plus"></i> Tạo mới</a>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="filter-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 100px">
                <form action="{{route('staff_filter')}}" method="GET">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="padding-left: 47%">
                                <b style="font-size: 17px">Bộ lọc</b>
                            </div>
                            <div class="modal-body">
                                <ul class="fiter-form">
                                    <li><label>Mã nhân viên</label>
                                        <div class="form-group">
                                            <input type="form" name="id" class="form-control" id="name">
                                        </div>
                                    </li>
                                    <li><label>Tên nhân viên</label>
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
                                                <p class="form-check-label">Dừng hoạt động</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li><label>Vai trò</label>
                                        <div class="form-check">
                                            <div>
                                                <input class="form-check-input" type="radio" name="role" value='2'>
                                                <p class="form-check-label">Quản lý</p>
                                            </div>
                                            <div>
                                                <input class="form-check-input" type="radio" name="role" value='1'>
                                                <p class="form-check-label">Nhân viên</p>
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
                    <th style="width: 100px">Avatar</th>
                    <th>Tên</th>
                    <th>Thông tin</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                <?php $i=1 ?>
                @foreach($staff as $item)
                    <tr style="text-align: center">
                        <td>{{ $i++ }}</td>
                        <td>
                            <img src="{{asset('storage/avatar/'.$item->avatar)}}" width="100px" height="100px">
                        </td>
                        <td>{{ $item->name }}</td>
                        <td style="text-align: left">
                            <div> Địa chỉ: {{ $item->address }}</div>
                            <div> SĐT: {{ $item->phone }}</div>
                            <div> Email: {{ $item->email }}</div>
                        </td>
                        <td  style="text-align: center">
                            @if($item->role == 1)
                                Nhân viên
                            @else($item->role == 2)
                                Quản lý
                            @endif
                        </td>
                        <td  style="text-align: center">
                            @if($item->is_deleted == 1)
                                <span class="badge badge-dark">Dừng hoạt động</span>
                            @else($item->is_deleted == 0)
                                <span class="badge badge-success">Hoạt động</span>
                            @endif
                        </td>
                        <td style="text-align: left">
                            <a class="btn btn-info" href="{{ route('staff_edit', ['staff_id'=>$item->id]) }}" title="Cập nhật" style="margin-right: 5px"> <i class="fas fa-pen"></i>
                            </a>
                            @if ($item->id != $_SESSION['admin_id'])
                                @if($item->is_deleted == 0)
                                    <a class="btn btn-secondary" href="{{ route('lock_staff', ['staff_id'=>$item->id]) }}" onclick="confirm('Bạn có chắc chắn muốn khóa tài khoản này?')" title="Dừng hoạt động tài khoản"> <i class="fas fa-lock"></i>
                                    </a>
                                @else($item->is_deleted == 1)
                                    <a class="btn" href="{{ route('unlock_staff', ['staff_id'=>$item->id]) }}" title="Khôi phục tài khoản"> <i class="fa fa-rotate-left"></i>
                                    </a>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop
