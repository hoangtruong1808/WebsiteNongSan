		@extends('/page/main')

		@section('content')
		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-8 mb-5 text-center">
						<ul class="product-category">
							<li><a href="{{ route('show_all_product')}}" <?php if ($menu_id==0) echo 'class="active"'?>>All</a></li>
							@foreach ($menu as $item)
							<li><a href="{{ route('show_menu_product',['menu_id'=>$item->id]) }}" <?php if ($item->id==$menu_id) echo 'class="active"'?>>{{ $item->name }}</a></li>
							@endforeach
						</ul>
					</div>
					<div class="col-md-4">
						<form action="{{ route('search_product',['menu_id'=>$menu_id]) }}" method="post">
							<div class="input-group">
								@csrf()
								<input type="text" name="key" style="padding-right: 10px, width: 90%">
								<span class="input-group-btn"  style="margin-left: 10px">
									<button class="btn btn-primary" type="submit">Tìm</button>
								</span>  
							</div>
						</form>
					</div>
				</div>
	</br>
				<div class="row">
					@foreach($product as $item)
					<div class="col-md-6 col-lg-3 ftco-animate">
							<div class="product">
								<a href="{{route('show_product_detail', ['product_id'=>$item->id])}}" class="img-prod"><img class="img-fluid" style="height: 202px; width: 100%" src="{{ asset('storage/product/'.$item->thumb) }}" alt="Colorlib Template">
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
				<div class="row mt-5">
			<div class="col text-center">
				{{ $product->links('pagination::bootstrap-4') }}
			</div>
			</div>
			</div>
		</section>
		@stop