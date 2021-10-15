@extends('page/main')
            
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 ftco-animate">
            <div class="login-box" style="margin: 100px 60px 125px 125px">
                <div class="card">
                    <div class="card-body login-card-body">
                    <p class="login-box-msg">Đăng nhập tài khoản</p>

                    <form action="{{ route('store_login') }}" method="post">
                        @csrf()
                        <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Lưu mật khẩu
                                </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                            </div>

                            <!-- /.col -->
                        </div>                            
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                            </div>
                        @endif
                    </form>
                    <!-- /.social-auth-links -->

                    <p class="mb-1">
                        <a href="forgot-password.html">Quên mật khẩu?</a>
                    </p>
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

                    <form action="{{ route('store_signout') }}" method="post">
                    @csrf()
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Họ tên" name="name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-user"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Địa chỉ" name="address">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Số điện thoại" name="phone">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Mật khẩu" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="repassword">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
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
@stop