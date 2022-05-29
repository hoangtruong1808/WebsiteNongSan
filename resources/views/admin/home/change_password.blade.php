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
            <form action="{{ route('exec_admin_change_password') }}" method="post">
                @csrf()
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Mật khẩu cũ</label>
                        <input type="password" name="old_password" class="form-control" >
                    </div>

                    <div class="form-group">
                        <label for="name">Mẫu khẩu mới</label>
                        <input type="password" name="new_password" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="address">Nhập lại mật khẩu mới</label>
                        <input type="password" name="re_password" class="form-control">
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" style="background-color: #298A08; margin-left: 47%">Đổi mật khẩu</button>
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

