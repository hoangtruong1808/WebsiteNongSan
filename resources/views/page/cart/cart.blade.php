    @extends('page/main')

    @section('content')
    <section class="ftco-section ftco-cart">
                <div class="container">
                    <div class="row">
                    <div class="col-md-12 ftco-animate">
                        <a href="http://localhost/san-pham?menu_id=6" style="text-decoration: underline;margin-bottom: 100px"><i class="fas fa-backward"></i> Tiếp tục mua hàng</a>
                        <div class="cart-list">
                            <table class="table">
                                <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng giá</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Cart::content() as $key)
                                <form method="POST" action="{{route('update_cart',['row_id'=>$key->rowId])}}">
                                @csrf()
                                <tr class="text-center">
                                    <td class="product-remove"><a href="{{ route('delete_cart',['row_id'=>$key->rowId]) }}"><i class="fas fa-times"></i></a></td>

                                    <td class="image-prod"><div class="img" style="background-image:url({{ asset('/storage/product/'.$key->options->thumb) }});"></div></td>

                                    <td class="product-name">
                                        <h3>{{ $key->name .' '. $key->unit}}</h3>

                                    </td>

                                    <td class="price">{{ number_format($key->price) }} VNĐ</td>

                                    <td class="quantity">
                                        <div class="input-group mb-3">
                                        <input type="text" name="quantity" id="quantity1" class="quantity form-control input-number" value="{{ $key->qty }}" min="0" max="100">
                                        </div>
                                    </td>

                                    <td class="total" id="total">{{ number_format($key->price * $key->qty)  }} VNĐ</td>
                                    <td><button class="btn btn-primary py-3 px-4 btn-hover" style="color: white ">Cập nhật</button></td>
                                </tr><!-- END TR-->
                                </form>
                                @endforeach</tbody>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li style="font-size: 15px; list-style-type: none">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                        <div class="cart-total mb-3">
                            @if(isset($_SESSION["id"]))
                            <h3>Nhập mã giảm giá</h3>
                            <p class="d-flex">
                                <input id="voucher" name="voucher" class="voucher">
                            </p>
                                @endif
                        </div>
                    </div>
                    <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                    </div>
                    <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                        <div class="cart-total mb-3">
                            <h3>Tổng giỏ hàng</h3>
                            <p class="d-flex">
                                <span>Tổng tiền</span>
                                <span>{{ Cart::initial(0,'.', ',') }} VNĐ</span>
                            </p>
                        </div>
                            <p><a class="btn btn-primary py-3 px-4 btn-hover" id="checkout-btn">Thanh toán</a></p>
                    </div>
                </div>
                </div>
            </section>
        <script>
            $("#checkout-btn").click(function(){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                voucher_code = $('#voucher').val();
                $.ajax({
                    method: "POST",
                    url: "{{route('check_voucher')}}",
                    data:{
                        _token: CSRF_TOKEN,
                        "voucher_code":voucher_code,
                    },
                    success:function(data) {

                       if(data.success==true){
                           window.location.href = "/thanh-toan";
                       }
                       else{
                           swal("Thất bại", data.error, "error");
                       }
                    }
                });
            });
        </script>
    @stop
