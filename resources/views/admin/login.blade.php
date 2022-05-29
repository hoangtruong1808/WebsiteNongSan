<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng nhập</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <LINK REL="SHORTCUT ICON"  HREF="{{ asset('logo.png') }}">

    <link rel="stylesheet" href="{{ asset('admin_template/login/main.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_template/login/util.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_template/plugins/fontawesome-free/css/all.min.css') }}">
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
</head>
<body>
@include('sweetalert::alert')
<div class="limiter">
    <div class="container-login100" style="background-image: linear-gradient(-135deg, #D8EDDD, #57b846)">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="{{ asset('logo.png') }}" alt="IMG" style="width: 280px; height: 230px">
            </div>

            <form class="login100-form validate-form" action="{{route('exec_login')}}" method="POST">
					<span class="login100-form-title">
						ĐĂNG NHẬP
					</span>
                @csrf
                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100" type="password" name="password" placeholder="Mật khẩu">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>

                <div class="container-login100-form-btn">
                    <input type="submit" class="login100-form-btn" value="Đăng nhập"/>
                </div>

                <div class="text-center p-t-136">
                    <a class="txt2" href="#">
                        <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
