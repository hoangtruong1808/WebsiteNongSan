@extends('/page/main')

@section('content')

<section class="ftco-section" style="padding-bottom: 0px">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-6 mb-5 ftco-animate">
    				<a href="{{ asset('storage/product/'.$product->thumb) }}" class="image-popup"><img src="{{ asset('storage/product/'.$product->thumb) }}" class="img-fluid" alt="Colorlib Template"></a>
    			</div>
    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
    				<h3>{{ $product->name }}</h3>
					{{--
    				<div class="rating d-flex">
							<p class="text-left mr-4">
								<a href="#" class="mr-2">5.0</a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
							</p>
							<p class="text-left mr-4">
								<a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
							</p>
							<p class="text-left">
								<a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
							</p>
					</div>
					
    				<p class="price"><span>{{ number_format($product->price) }} vnđ / {{ $product->unit }}</span></p>--}}
    				<p>{{ $product->description }}</p>
					<form method="POST" action="{{route('store_cart')}}">
						@csrf()
						<input  name='name' type='hidden' value='{{$product->name}}'/>
						<input  name='id' type='hidden' value='{{$product->id}}'/>
						<input  name='price' type='hidden' value='{{$product->price}}'/>
						<input  name='thumb' type='hidden' value='{{$product->thumb}}'/>
						<div class="table-price" style="margin-bottom: 15px; padding-top: 15px; border-top: 1.5px solid #A4A4A4">
							<table style="text-align: center">
								<tr>
									<th style="width: 280px">Phân loại</th>
									<th style="width: 200px">Giá</th>
									<th style="width: 300px">Số lượng</th>
									<th style="width: 300px">Thành tiền</th>
								</tr>
								<tr>
									<td>1kg</td>
									<td>{{ number_format($product->price) }}đ</td>
									<td>
										<input type="button" value="-" id="btn-minus"/>
										<input id='quantity' min='0' name='quantity' type='text' value='0' style="width: 50px; text-align: center"/>
										<input type="button" value="+" id="btn-plus"/>
									</td>
									<td id="money"></td>
								</tr>
							</table>
						</div>
						<button>Thêm giỏ hàng</button>
					<form>
    			</div>
    		</div>
    	</div>
		<div class="product-content">
			<div class="container">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Thông tin thực phẩm</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Bình luận</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade show active  py-3" id="home" role="tapanel" aria-labelledby="home-tab">
								<table class="table-product_detail">
									<tr>
										<td style="width: 200px"><b>Thành phần</b></td>
										<td>{{ $product->thanhphan }}</td>
									</tr>
									<tr>
										<td><b>Mùa vụ</b></td>
										<td>{{ $product->muavu }}</td>
									</tr>
									<tr>
										<td><b>Đóng gói</b></td>
										<td>{{ $product->donggoi }}</td>
									</tr>
									<tr>
										<td><b>HSD</b></td>
										<td>{{ $product->hansudung }}</td>
									</tr>
									<tr>
										<td><b>Xuất sứ</b></td>
										<td>{{ $product->xuatsu }}</td>
									</tr>
									<tr>
										<td><b>Giao nhận hàng</b></td>
										<td>{{ $product->giaohang }}</td>
									</tr>
								</table>
							</div>
							<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								Nội dung Tab2 - HTML code
							</div>
						</div>
			</div>
		</div>
    </section>
	<script>
    $(document).ready(function(){
		var quantity = Number($('#quantity').val());
		var soluong; 
		var money;
        $('#btn-minus').click(function(){
			if (quantity > 0.1)
			{
				quantity=quantity-0.1;
			}
			soluong = parseFloat(quantity).toFixed(1);
			money = soluong * {{$product->price}};
			$('#quantity').val(soluong);
			$('#money').html(money);
		});
		$('#btn-plus').click(function(){
			quantity= quantity + 0.1;
			soluong = parseFloat(quantity).toFixed(1);
			money = soluong * {{$product->price}};
			$('#quantity').val(soluong);
			$('#money').html(money);
		});
		

    });
	</script>

    <section class="ftco-section" style="margin-top: 0px">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Products</span>
            <h2 class="mb-4">Các sản phẩm liên quan</h2>
            <p>Hàng nông sản tươi và sạch sẽ, đảm bảo an toàn vệ sinh thực phẩm cho Quý Khách Hàng.</p>
          </div>
        </div>   		
    	</div>
    	<div class="container">
    		<div class="row">
				@foreach ($related_product as $item)
				<div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="{{route('show_product_detail', ['product_id' => $item->id])}}" class="img-prod"><img class="img-fluid" style="height: 202px; width: 100%" src="{{ asset('storage/product/'.$item->thumb) }}" alt="Colorlib Template">
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="#">{{ $item->name }}</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span>{{ number_format($item->price) }} vnđ /{{ $item->unit }}</span></p>
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                            <span><i class="ion-ios-menu"></i></span>
                                        </a>
                                        <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                            <span><i class="ion-ios-cart"></i></span>
                                        </a>
                                        <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                            <span><i class="ion-ios-heart"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				@endforeach
    		</div>
    	</div>
    </section>
    @stop