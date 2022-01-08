@extends('page/main')
            
@section('content')
<section class="ftco-section">
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 text-center">
                <ul class="product-category">
                    <li><a href="{{ route('account') }}" >Thông tin tài khoản</a></li>
                    <li><a href="{{ route('order_history') }}">Lịch sử đặt hàng</a></li>
                    <li><a href="{{ route('account_post') }}"  class="active" >Đăng tin sản phẩm</a></li>
                    <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container"> 
    <?php
                $message = Session::get('message');
                if($message) {
                    echo '<div class="alert alert-success" style="width: 100%">'.$message.'</div>';
                    Session::put('message', null);
                }
                $stt=1;
            ?>
            <table class="table">
            <tr>
                    <th>STT</th>
                    <th>Tên đơn vị</th>
                    <th>Phương thức</th>
                    <th>Sản phẩm</th>
                    <th>Nhóm</th>
                    <th>Giá</th>
                    <th>Sản lượng TB</th>
                    <th>Tình trạng</th>
                    <th></th>
                </tr>
                <?php
                $message = Session::get('message');
                if($message) {
                    echo '<div class="alert alert-success" style="width: 100%">'.$message.'</div>';
                    Session::put('message', null);
                }
                $stt=1;
                ?>
                <?php
                if (isset($_GET['page']))
                {
                    $page = $_GET['page'];
                } 
                else $page = 1;
                $a = ( $page-1)*10+1; ?>
                @foreach($account_post as $item)
                <tr>
                    <td>{{ $a++ }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->method }}</td>
                    <td>{{ $item->product }}</td>
                    <td>{{ $item->group }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->averageyield }}</td>
                    <td>
                        {{$item->status}}            
                    </td>
                    <td>
                        <a href="{{ route('delete_post',['post_id'=>$item->id]) }}" onclick="confirm('Bạn có chắc chắn muốn xóa bài đăng này này')" style="color:blue">Xóa</i>
                        </a> 
                    </td>
                </tr>
                @endforeach
            </table>
    </div>
</section>
@stop