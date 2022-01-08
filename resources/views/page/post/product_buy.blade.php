@extends('page/main')
            
@section('content')
<section class="ftco-section">
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 text-center">
                <ul class="product-category">
                    <li><a href="{{ route('product_sale') }}">Cần bán</a></li>
                    <li><a href="{{ route('product_buy') }}" class="active">Cần mua</a></li>
                    <li><a href="{{ route('post_product') }}" >Đăng tin</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container"> 
    <table class="table">
        <tr>
            <th>
                Tên đơn vị
            </th>
            <th>
                Sản phẩm
            </th>
            <th>
                Nhóm
            </th>
            <th>
                Giá
            </th>
            <th>
                Sản lượng TB
            </th>
            <th>
                Ghi chú
            </th>
        </tr>
        <?php $stt=1; ?>
        @foreach($product_buy as $value)
        <tr>
            <th>
                {{ $stt++ }}
            </th>
            <th>
                {{ $value->name }}
            </th>
            <th>
                {{ $value->product }}
            </th>
            <th>
                {{ $value->group }}
            </th>
            <th>
                {{ $value->price}}
            </th>
            <th>
                {{ $value->averageyield}}
            </th>
            <th>
                {{ $value->note }}
            </th>
        </tr>
        @endforeach
    </table>
    </div>
</section>
@stop