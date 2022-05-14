@extends('page/main')

@section('content')
<section class="ftco-section">
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 text-center">
                <ul class="product-category">
                    <li><a href="{{ route('account') }}" class="active">Thông tin tài khoản</a></li>
                    <li><a href="{{ route('order_history') }}">Lịch sử đặt hàng</a></li>
                    <li><a href="{{ route('show_voucher') }}">Mã khuyến mãi</a></li>
                    <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <form action="{{ route('update_account') }}" method="post" style="margin-left: 200px; margin-right: 200px">
            @csrf()
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="font-size: 15px">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card-body">
                <div class="form-group">
                    <label>Họ tên</label>
                    <input type="form" name="name" class="form-control" value="{{ $account->name }}" required>
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="form" name="address" class="form-control" value="{{ $account->address }}" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="form" name="email" class="form-control" value="{{ $account->email }}" required>
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="form" name="phone" class="form-control" value="{{ $account->phone }}" required>
                </div>
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" class="form-control" value="123" required>
                </div>
            <!-- /.card-body -->
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" style="margin-left: 42%">Cập nhật</button>
            </div>

        </form>
    </div>
</section>
@stop
