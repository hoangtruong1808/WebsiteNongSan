@extends('admin/main')

@section('content')
    <div class="content-wrapper">
        <div class="card card-primary" style="margin: 20px 30px 0px 30px">
            <div class="card-header" style="background-color: #298A08; " >
                <div class="row">
                    <div class="col-sm-10">
                        <h3 class="card-title">{{ $title }}</h3>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('supplier_update',['supplier_id'=>$supplier->id]) }}" method="post" enctype="multipart/form-data">
                @csrf()
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Tên nhà cung cấp</label>
                        <input type="form" name="name" class="form-control" id="name" placeholder="Nhập tên nhà cung cấp" value="{{$supplier->name}}">
                    </div>

                    <div class="form-group">
                        <label for="name">Số điện thoại</label>
                        <input type="form" name="phone" class="form-control" id="name" placeholder="Nhập số điện thoại" value="{{$supplier->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="form" name="address" class="form-control" id="address" placeholder="Nhập địa chỉ" value="{{$supplier->address}}">
                    </div>
                    <div class="form-group">
                        <label for="mail">Email</label>
                        <input type="form" name="mail" class="form-control" id="mail" placeholder="Nhập email" value="{{$supplier->mail}}">
                    </div>

                    <!-- /.card-body -->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" style="background-color: #298A08; margin-left: 47%">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
@stop

