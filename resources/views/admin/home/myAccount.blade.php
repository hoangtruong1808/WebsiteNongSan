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
            <form action="{{ route('my_account_store') }}" method="post" enctype="multipart/form-data">
                @csrf()
                <div class="card-body">
                    <div class="profilepic">
                        <img class="profilepic__image" id="output" src="{{asset('storage/avatar/'.$account->avatar)}}" width="200" height="200" alt="Profibild" />
                        <div class="profilepic__content">
                            <span class="profilepic__icon"><i class="fas fa-camera"></i></span>
                            <span class="profilepic__text">Edit Profile</span>
                            <input type="file"  id="avatar" name="avatar"  accept="image/png, image/jpeg" style="" onchange="loadFile(event)">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Họ tên</label>
                        <input type="form" name="name" class="form-control" id="name" value="{{$account->name}}" >
                    </div>

                    <div class="form-group">
                        <label for="name">Số điện thoại</label>
                        <input type="form" name="phone" class="form-control" id="name" value="{{$account->phone}}" >
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="form" name="address" class="form-control" id="address" value="{{$account->address}}" >
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="form" name="email" class="form-control" id="email" value="{{$account->email}}" >
                    </div>

                    <div class="form-group">
                        <label for="name">Chức vụ</label>
                        <div  class="form-control" readonly>
                            @if ($account->role == 1)
                                Nhân viên
                            @elseif ($account->role == 2)
                                Quản lý
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" style="background-color: #298A08; margin-left: 47%">Cập nhật tài khoản</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        var loadFile = function (event) {
            var image = document.getElementById("output");
            image.src = URL.createObjectURL(event.target.files[0]);
        };

    </script>
@stop

