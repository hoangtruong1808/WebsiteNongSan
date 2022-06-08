        @extends('page/main')

        @section('content')
        <section class="ftco-section">
                <div class="container">
                    <div class="row no-gutters ftco-services">
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                    <i class="fas fa-shipping-fast" style="color:white; font-size: 40px;"></i>
                </div>
                <div class="media-body">
                    <h3 class="heading">Miễn phí giao hàng</h3>
                    <span>Cho đơn hàng trên 1 triệu</span>
                </div>
                </div>
            </div>
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                    <i class="fas fa-carrot" style="color:white; font-size: 40px;"></i>
                </div>
                <div class="media-body">
                    <h3 class="heading">Nông sản tươi - sạch</h3>
                    <span>Yên tâm sử dụng</span>
                </div>
                </div>
            </div>
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                    <i class="fas fa-medal" style="color:white; font-size: 40px;"></i>
                </div>
                <div class="media-body">
                    <h3 class="heading">Chứng nhận chất lượng</h3>
                    <span>Bộ nông nghiệp</span>
                </div>
                </div>
            </div>
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                    <i class="fas fa-concierge-bell" style="color:white; font-size: 40px;"></i>
                </div>
                <div class="media-body">
                    <h3 class="heading">Hỗ trợ</h3>
                    <span>Hỗ trợ 24/7</span>
                </div>
                </div>
            </div>
            </div>
                </div>
            </section>

            <section class="ftco-section ftco-category ftco-no-pt">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6 order-md-last align-items-stretch d-flex">
                                    <div class="category-wrap-2 ftco-animate img align-self-stretch d-flex" style="background-image: url({{ asset('page_template/images/category.jpg') }});">
                                        <div class="text text-center">
                                            <h2>Nông sản Việt</h2>
                                            <p>Bảo vệ sức khỏe mọi nhà</p>
                                            <p><a href="#" class="btn btn-primary">Mua hàng</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url({{ asset('page_template/images/category-1.jpg') }});">
                                        <div class="text px-3 py-1">
                                            <h2 class="mb-0"><a href="#">Trái cây</a></h2>
                                        </div>
                                    </div>
                                    <div class="category-wrap ftco-animate img d-flex align-items-end" style="background-image: url({{ asset('page_template/images/category-2.jpg') }});">
                                        <div class="text px-3 py-1">
                                            <h2 class="mb-0"><a href="#">Rau củ</a></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url({{ asset('page_template/images/category-3.png') }});">
                                <div class="text px-3 py-1">
                                    <h2 class="mb-0"><a href="#">Thủy - hải sản</a></h2>
                                </div>
                            </div>
                            <div class="category-wrap ftco-animate img d-flex align-items-end" style="background-image: url({{ asset('page_template/images/category-4.jpg') }});">
                                <div class="text px-3 py-1">
                                    <h2 class="mb-0"><a href="#">Đồ khô</a></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <section class="ftco-section">
            <div class="container">
                    <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h2 class="mb-4">Sản phẩm mới</h2>
                <p>Hàng nông sản tươi và sạch sẽ, đảm bảo an toàn vệ sinh thực phẩm cho Quý Khách Hàng.</p>
            </div>
            </div>
            </div>
            <div class="container">
                <div class="row">
                    @foreach($product as $item)
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="{{ route('show_product_detail', ['product_id'=>$item->id]) }}" class="img-prod"><img class="img-fluid" style="height: 202px; width: 100%" src="{{ asset('storage/product/'.$item->thumb) }}" alt="Colorlib Template">
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="{{ route('show_product_detail', ['product_id'=>$item->id]) }}">{{ $item->name }}</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price"><span>{{ number_format($item->price) }} vnđ /{{ $item->unit }}</span></p>
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

        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center mb-3 pb-3">
                    <div class="col-md-12 heading-section text-center ftco-animate">
                        <h2 class="mb-4">Sản phẩm bán chạy</h2>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    @foreach($best_seller as $item)
                        <div class="col-md-6 col-lg-3 ftco-animate">
                            <div class="product">
                                <a href="{{ route('show_product_detail', ['product_id'=>$item->id]) }}" class="img-prod"><img class="img-fluid" style="height: 202px; width: 100%" src="{{ asset('storage/product/'.$item->thumb) }}" alt="Colorlib Template">
                                    <div class="overlay"></div>
                                </a>
                                <div class="text py-3 pb-4 px-3 text-center">
                                    <h3><a href="{{ route('show_product_detail', ['product_id'=>$item->id]) }}">{{ $item->name }}</a></h3>
                                    <div class="d-flex">
                                        <div class="pricing">
                                            <p class="price"><span>{{ number_format($item->price) }} vnđ /{{ $item->unit }}</span></p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="pricing">
                                            <p class="price"><span>Đã bán <b>{{ceil($item->sum)}}</b> sản phẩm</span></p>
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
        <hr>
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
                        }
                        else{
                            swal("Thành công", "Bỏ yêu thích sản phẩm thành công", "success");
                            $("#add-to-favorite-"+product_id).attr('data-type', 'add-favorite');
                            $("#add-to-favorite-"+product_id).attr('title', 'Yêu thích');
                            $("#add-to-favorite-"+product_id).attr('style', '');
                        }
                    }
                });


            });
        </script>
        @stop
