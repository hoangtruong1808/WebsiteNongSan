
@extends('page/main')
            
@section('content')
<section class="ftco-section">
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 text-center">
                <ul class="product-category">
                    <li><a href="{{ route('product_sale') }}">Cần bán</a></li>
                    <li><a href="{{ route('product_buy') }}">Cần mua</a></li>
                    <li><a href="{{ route('post_product') }}" class="active">Đăng tin</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container"> 
        <form action="{{ route('post_product_process') }}" method="post" style="margin-left: 200px; margin-right: 200px">
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
            <?php
                $message = Session::get('message');
                if($message) {
                    echo '<div class="alert alert-success" style="width: 100%">'.$message.'</div>';
                    Session::put('message', null);
                }
                $stt=1;
            ?>
            <div class="card-body">
                <div class="form-group">
                    <label>Tên đơn vị</label>
                    <input type="form" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <span>
                        <input type="checkbox" value="Cần bán" name="method" />
                        <label ><span></span>Cần bán</label>
                    </span>
                    <span style="margin-left: 70px">
                        <input type="checkbox" value="Cần mua" name="method" />
                        <label><span></span>Cần mua</label>
                    </span>
                </div>
                <div class="form-group">
                    <label>Sản phẩm</label>
                    <input type="form" name="product" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Nhóm</label>
                    <select type="form" name="group" class="form-control">
                        <option>Chọn nhóm sản phẩm</option>
                        <option>Thủy hải sản</option>
                        <option>Cây ăn trái</option>
                        <option>Nông-thủy-hải sản chế biến</option>
                        <option>Lương thực</option>
                        <option>Chăn nuôi</option>
                        <option>Rau củ quả</option>
                        <option>Khác</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Giá</label>
                    <input type="form" name="price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Sản lượng TB</label>
                    <input type="form" name="averageyield" class="form-control">
                </div>
                <div class="form-group">
                    <label>Ghi chú</label>
                    <textarea name="note" class="form-control"></textarea>
                </div>

            <!-- /.card-body -->
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" style="margin-left: 42%">Đăng tin</button>
            </div>
            
        </form>
    </div>
</section>
@stop