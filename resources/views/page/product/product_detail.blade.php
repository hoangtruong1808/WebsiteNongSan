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

    				<p class="price"><span>{{ number_format($product->price) }} VNĐ / {{ $product->unit }}</span></p>--}}
    				<p>{{ $product->description }}</p>
                        @csrf()
                        <input  name='name' type='hidden' id='product_name' value='{{$product->name . ' '. $product->unit}}'/>
						<input  name='id' type='hidden' id='product_id' value='{{$product->id}}'/>
						<input  name='price' type='hidden' id='product_price' value='{{$product->price}}'/>
						<input  name='thumb' type='hidden' id='product_thumb' value='{{$product->thumb}}'/>
						<div class="table-price" style="margin-bottom: 15px; padding-top: 15px; border-top: 1.5px solid #A4A4A4">
							<table style="text-align: center">
								<tr>
									<th style="width: 280px">Đơn vị</th>
									<th style="width: 200px">Giá</th>
									<th style="width: 300px">Số lượng</th>
									<th style="width: 300px">Thành tiền</th>
								</tr>
								<tr>
									<td>{{ ucfirst($product->unit)}}</td>
									<td>{{ number_format($product->price) }} VNĐ</td>
									<td>
										<input type="button" value="-" id="btn-minus"/>
										<input id='quantity' min='1' name='quantity' type='text' style="width: 50px; text-align: center" value="1" required/>
										<input type="button" value="+" id="btn-plus"/>
									</td>
									<td id="money">{{ number_format($product->price) }} VNĐ</td>
								</tr>
								<tr>
									<td></td>
								</tr>
							</table>
                        <!-- /.card-body -->
                        </div>
                        <div class="error-login" style="margin-top: 10px"></div>
                        <div style="margin-left: 20%">
                            @if ($product->inventory_quantity > 0)
                                @if (isset($_SESSION['id']))
                                    @if ($product->is_favorite == 0)
                                        <button class="add-to-favorite" id="add-product-to-favorite-{{$product->id}}" data-type="add-favorite" style="cursor:pointer" data-id="{{$product->id}}" title="Yêu thích">
                                            Yêu thích
                                        </button>
                                    @else
                                        <button class="add-to-favorite" id="add-product-to-favorite-{{$product->id}}" style="color:white; background-color: #82ae46 !important; cursor:pointer" data-type="remove-favorite" data-id="{{$product->id}}" title="Bỏ yêu thích">
                                            Bỏ yêu thích
                                        </button>
                                    @endif
                                @endif
                                    <button id="add-cart" style="cursor:pointer; margin-left: 6%" ><span><i class="fas fa-cart-plus" style="color:#82ae46; margin-left: 5px"></i></span> Thêm giỏ hàng</button>
                            @else
                            Rất tiếc! Sản phẩm hết hàng.
                            @endif
                        </div>
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
                                    @if(isset($product->thanhphan))
									<tr>
										<td style="width: 200px"><b>Thành phần</b></td>
										<td>{{ $product->thanhphan }}</td>
									</tr>
                                    @endif
                                    @if(isset($product->muavu))
									<tr>
										<td><b>Mùa vụ</b></td>
										<td>{{ $product->muavu }}</td>
									</tr>
                                    @endif
                                    @if(isset($product->xuatsu))
									<tr>
										<td><b>Xuất xứ</b></td>
										<td>{{ $product->xuatsu }}</td>
									</tr>
                                        @endif
                                    @if(isset($product->giaohang))
									<tr>
										<td><b>Giao nhận hàng</b></td>
										<td>{{ $product->giaohang }}</td>
									</tr>
                                    @endif
								</table>
							</div>
							<div class="tab-pane fade comment-product" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="container mt-5">
                                    <div class="d-flex justify-content-center row">
                                            <div class="d-flex flex-column comment-section" style="width:100%">
                                                <div class="comment-show">
                                                    @foreach($comment as $key=>$value)
                                                        <div class="bg-white p-2" style="border-bottom: 1px solid lightgrey; margin-bottom: 10px ">
                                                            <div class="d-flex flex-row user-info"><img class="rounded-circle" src="{{asset('storage/avatar/default-avatar.png')}}"  width="40" height="40">
                                                                <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">{{$value->name}}</span><span class="date text-black-50">{{$value->date}}</span></div>
                                                            </div>
                                                            <div class="mt-2">
                                                                <p class="comment-text">{{$value->content}}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @if (isset($_SESSION['id']))
                                                <div class="bg-light p-2">
                                                    <div class="d-flex flex-row align-items-start"><img class="rounded-circle" src="{{asset('storage/avatar/default-avatar.png')}}"  width="40"  height="40"><textarea class="form-control ml-1 shadow-none textarea" id="text-comment"></textarea></div>
                                                    <div class="mt-2 text-right"><button class="btn btn-primary btn-sm shadow-none" id="btn-comment" type="button">Bình luận</button><button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="button">Hủy bỏ</button></div>
                                                    <div><input type="hidden" id="customer_id" value="{{$_SESSION['id']}}"></div>
                                                </div>
                                                    @endif
                                            </div>

                                    </div>
                                </div>
							</div>
						</div>
			</div>
		</div>
    </section>
	<script>
    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var quantity = Number($('#quantity').val());
		var soluong;
		var money;
        var comment;
        $('#btn-minus').click(function(){
			if (quantity > 0)
			{
				quantity=quantity-1;
			}
			soluong = quantity;
			money = soluong * {{$product->price}};
			$('#quantity').val(soluong);
            $('#money').html(money/1000 +',000 VNĐ');
		});
		$('#btn-plus').click(function(){
			quantity= quantity + 1;
			soluong = quantity;
			money = soluong * {{$product->price}};
			$('#quantity').val(soluong);
			$('#money').html(money/1000 +',000 VNĐ');
		});
        $('#add-cart').click(function() {
            var name = $('#product_name').val();
            var id = $('#product_id').val();
            var price = $('#product_price').val();
            var thumb = $('#product_thumb').val();
            var quantity = $('#quantity').val();
            var inventory_quantity = {{$product->inventory_quantity}};
            if (quantity > inventory_quantity)
            {
                swal("Thất bại", 'Rất tiếc! Số lượng sản phẩm trong kho không đủ', "error");
                return;
            }
            $.ajax({
                url: "{{route('store_cart')}}",
                method: 'POST',
                data: {_token: CSRF_TOKEN,
                    name: name,
                    id: id,
                    price: price,
                    thumb: thumb,
                    quantity: quantity,
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.success == true){
                        window.location.replace("{{ route('show_cart')}}");
                    }
                    else {
                        $(".error-input").remove();
                        swal("Thất bại", data.error, "error");
                    }
                }
            });
        });
        $('#btn-comment').click(function(){

            var xhtml ="";
            comment = $('#text-comment').val();
            customer_id = $('#customer_id').val();
            $.ajax({
                url: "{{route('comment_product')}}",
                method: 'POST',
                data: {_token: CSRF_TOKEN,
                    comment: comment,
                    product_id: {{$product->id}},
                    customer_id: customer_id,
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.success == true){
                        xhtml ='';
                        xhtml += '<div class="bg-white p-2" style="border-bottom: 1px solid lightgrey; margin-bottom: 20px ">';
                        xhtml += '<div class="d-flex flex-row user-info"><img class="rounded-circle" src="{{asset('storage/avatar/default-avatar.png')}}" width="40">'
                        xhtml +=  '<div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">'+data.data.name+'</span><span class="date text-black-50">'+data.data.date+'</span></div>'
                        xhtml += '</div>';
                        xhtml +=     '<div class="mt-2">';
                        xhtml +=         '<p class="comment-text">'+comment+'</p>';
                        xhtml +=    '</div>';
                        xhtml +=    '</div>';
                        $('.comment-show').append(xhtml);
                        $('#text-comment').val(' ');
                    }
                    else {
                        alert(data.error);
                    }
                }
            });
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
                                        <p class="price"><span>{{ number_format($item->price) }} VNĐ /{{ $item->unit }}</span></p>
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="/san-pham/{{$item->id}}" class="add-to-cart d-flex justify-content-center align-items-center mx-1" title="Thêm giỏ hàng" data-id="{{$item->id}}">
                                            <span><i class="fas fa-cart-plus"></i></span>
                                        </a>
                                        @if (isset($_SESSION['id']))
                                            @if ($item->is_favorite == 0)
                                                <a class="heart add-to-favorite d-flex justify-content-center align-items-center" id="add-to-favorite-{{$item->id}}" data-type="add-favorite" data-id="{{$item->id}}" title="Yêu thích">
                                                    <span><i class="fas fa-heart"></i></span>
                                                </a>
                                            @else
                                                <a class="heart add-to-favorite d-flex justify-content-center align-items-center" id="add-to-favorite-{{$item->id}}" data-type="remove-favorite" data-id="{{$item->id}}" title="Bỏ yêu thích" style="background-color: #e1f3c8; color: #82ae46;">
                                                    <span><i class="fas fa-heart"></i></span>
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				@endforeach
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
                    $("#add-to-favorite-"+product_id).attr('style', 'background-color: #e1f3c8; color: #82ae46;');
                    $("#add-product-to-favorite-"+product_id).attr('data-type', 'remove-favorite');
                    $("#add-product-to-favorite-"+product_id).attr('title', 'Bỏ yêu thích');
                    $("#add-product-to-favorite-"+product_id).attr('style', 'color:white; background-color: #82ae46 !important; cursor:pointer');
                    $("#add-product-to-favorite-"+product_id).html('Bỏ yêu thích');
                }
                else{
                    swal("Thành công", "Bỏ yêu thích sản phẩm thành công", "success");
                    $("#add-to-favorite-"+product_id).attr('data-type', 'add-favorite');
                    $("#add-to-favorite-"+product_id).attr('title', 'Yêu thích');
                    $("#add-to-favorite-"+product_id).attr('style', '');
                    $("#add-product-to-favorite-"+product_id).attr('data-type', 'add-favorite');
                    $("#add-product-to-favorite-"+product_id).attr('title', 'Yêu thích');
                    $("#add-product-to-favorite-"+product_id).attr('style', 'cursor:pointer');
                    $("#add-product-to-favorite-"+product_id).html('Yêu thích');
                }
            }
        });


    });
</script>
    @stop
