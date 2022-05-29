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
            <form action="{{ route('staff_store') }}" method="post" enctype="multipart/form-data">
                @csrf()
                <div class="card-body">
                    <div class="profilepic">
                        <img class="profilepic__image" id="output" src="{{asset('storage/avatar/default-avatar.png')}}" width="200" height="200" alt="Profibild" />
                        <div class="profilepic__content">
                            <span class="profilepic__icon"><i class="fas fa-camera"></i></span>
                            <span class="profilepic__text">Edit Profile</span>
                            <input type="file"  id="avatar" name="avatar"  accept="image/png, image/jpeg" style="" onchange="loadFile(event)">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Họ tên</label>
                        <input type="form" name="name" class="form-control" id="name" placeholder="Nhập họ tên">
                    </div>

                    <div class="form-group">
                        <label for="name">Số điện thoại</label>
                        <input type="form" name="phone" class="form-control" id="name" placeholder="Nhập số điện thoại">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="form" name="address" class="form-control" id="address" placeholder="Nhập địa chỉ">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="form" name="email" class="form-control" id="email" placeholder="Nhập email">
                    </div>

                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
                    </div>

                    <div class="form-group">
                        <label for="role" >Vai trò</label>
                        <select name="role" id="role" class="form-control">
                            <option disabled selected>Chọn vai trò </option>
                            <option value="1">Nhân viên</option>
                            <option value="2">Quản lý</option>
                        </select>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" style="background-color: #298A08; margin-left: 47%">Tạo tài khoản</button>
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

