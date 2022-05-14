@extends('page/main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 ftco-animate">
            <div class="login-box" style="margin: 100px 60px 125px 125px">
                <div class="card">
                    <div class="card-body login-card-body">
                    <p class="login-box-msg">Đăng nhập tài khoản</p>
                    <form>
                        @csrf()
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" id="email-login" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password-login" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        </div>
                        <div class="error-login" style="margin-top: 10px">
                        </div>
                        <div class="col-12">
                            <div id="login-btn" class="btn btn-primary btn-block">Đăng nhập</div>
                            <div class="mb-1" style=" margin-top: 10px; text-align: center">
                                <a href="forgot-password.html" style="text-align: center">Quên mật khẩu?</a>
                            </div>
                        </div>


                    </form>
                    <!-- /.social-auth-links -->

                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
        <div class="col-md-6 ftco-animate">
            <div class="register-box" style="margin: 100px 60px 125px 125px">

                <div class="card">
                    <div class="card-body register-card-body">
                    <p class="login-box-msg">Đăng ký tài khoản mới</p>
                    <form method="post">
                    @csrf()
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Họ tên" id="name-signin" name="name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-user"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" id="email-signin" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Địa chỉ" id="address-signin" name="address">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-address-card"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Số điện thoại" id="phone-signin" name="phone">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Mật khẩu" id="password-signin" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" id="repassword-signin" name="repassword">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        </div>
                        <div class="error-signin" style="margin-top: 10px">
                        </div>
                        <div class="row">
                        <!-- /.col -->

                            <div class="col-12">
                                <div id="signin-btn" class="btn btn-primary btn-block">Đăng ký</div>
                            </div>


                        <!-- /.col -->
                        </div>
                    </form>
                    </div>
                    <!-- /.form-box -->
                </div><!-- /.card -->
            </div>
        </div>
    </div>
</div>
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');


    $( "#login-btn" ).click(function() {
        var email =  $("#email-login").val();
        var password = $("#password-login").val();
        $.ajax({
            url: "{{ route('store_login') }}",
            method: 'POST',
            data: {_token: CSRF_TOKEN,
                    email: email,
                    password: password,
                    },
            dataType: 'JSON',
            success: function (data) {
                if (data.success == true){
                    swal("Thành công", "Đăng nhập thành công", "success");
                    window.location.replace("{{ route('Home') }}");
                }
                else {
                    var error="";
                    $.each( data.error, function( key, value ) {
                        error += value + ', ';
                    });
                    swal("Thất bại", error, "error");
                }
            }
        });
    });
    $( "#signin-btn" ).click(function() {
        var name =  $("#name-signin").val();
        var email =  $("#email-signin").val();
        var address =  $("#address-signin").val();
        var phone =  $("#phone-signin").val();
        var password =  $("#password-signin").val();
        var repassword =  $("#repassword-signin").val();
        $.ajax({
            url: "{{ route('store_signout') }}",
            method: 'POST',
            data: {_token: CSRF_TOKEN,
                email: email,
                password: password,
                name: name,
                address: address,
                phone: phone,
                repassword: repassword,
            },
            dataType: 'JSON',
            success: function (data) {
                if (data.success == true){
                    swal("Thành công", "Đăng ký thành công", "success");
                    window.location.replace("{{ route('Home') }}");
                }
                else {
                    var error="";
                    $.each( data.error, function( key, value ) {
                        error += value + ', ';
                    });
                    swal("Thất bại", error, "error");

                }
            }
        });
    });
</script>
@stop
