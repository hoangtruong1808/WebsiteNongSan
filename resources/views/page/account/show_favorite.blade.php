@extends('page/main')

@section('content')
<section class="ftco-section">
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 text-center">
                <ul class="product-category">
                    <li><a href="{{ route('account') }}" >Thông tin tài khoản</a></li>
                    <li><a href="{{ route('order_history') }}">Lịch sử đặt hàng</a></li>
                    <li><a href="{{ route('show_voucher') }}" >Mã khuyến mãi</a></li>
                    <li><a href="{{ route('show_favorite') }}" class="active">Sản phẩm yêu thích</a></li>
                    <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
            <table class="table">
                <thead>
                <tr>
                    <th>STT</th>
                    <th></th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th></th>
                </tr>
                </thead>
                <?php
                if (isset($_GET['page']))
                {
                    $page = $_GET['page'];
                }
                else $page = 1;
                $a = ( $page-1)*10+1; ?>
                <tbody>
                @foreach($account_favorite as $item)
                <tr>
                    <td>{{ $a++ }}</td>

                    <td class="image-prod"><div class="img" style="background-image:url({{ asset('/storage/product/'.$item->thumb) }});"></div></td>

                    <td><a href="/san-pham/{{ $item->id }}">{{ $item->name }}</a></td>
                    <td>{{ number_format($item->price) }} VNĐ / {{$item->unit}}</td>
                    <td>
                        <a class="heart add-to-favorite d-flex justify-content-center align-items-center" id="add-to-favorite-{{$item->id}}" data-type="remove-favorite" data-id="{{$item->id}}" title="Bỏ yêu thích" style="color: red; font-size: 22px; cursor: pointer">
                            <span><i class="fas fa-heart"></i></span>
                        </a>
                    </td>
                </tr>
                </tbody>
                @endforeach
            </table>
        <div style="margin-left: 45%">
            {{ $account_favorite->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>
    <script>
        var product_id;
        var favorite_type;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $( ".add-to-favorite" ).click(function() {
            favorite_type = $(this).attr('data-type');
            product_id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('favorite_product')}}",
                method: 'POST',
                data: {_token: CSRF_TOKEN,
                    name: name,
                    product_id: product_id,
                    favorite_type: favorite_type,
                },
                dataType: 'JSON',
                success: function (data) {
                    if (favorite_type == 'add-favorite'){
                        swal("Thành công", "Yêu thích sản phẩm thành công", "success");
                        $("#add-to-favorite-"+product_id).attr('data-type', 'remove-favorite');
                        $("#add-to-favorite-"+product_id).attr('title', 'Bỏ yêu thích');
                        $("#add-to-favorite-"+product_id).attr('style', 'color: red; font-size: 22px; cursor: pointer');
                    }
                    else{
                        swal("Thành công", "Bỏ yêu thích sản phẩm thành công", "success");
                        $("#add-to-favorite-"+product_id).attr('data-type', 'add-favorite');
                        $("#add-to-favorite-"+product_id).attr('title', 'Yêu thích');
                        $("#add-to-favorite-"+product_id).attr('style', 'color: #f7d4d4; font-size: 22px; cursor: pointer');
                    }
                }
            });


        });
    </script>
@stop
