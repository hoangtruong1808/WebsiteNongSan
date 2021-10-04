    @extends('page/main')
            
    @section('content')
    <section class="ftco-section ftco-cart">
                <div class="container">
                    <div class="row">
                    <div class="col-md-12 ftco-animate">
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
                                        <h3>{{ $key->name }}</h3>
                               
                                    </td>
                                    
                                    <td class="price">{{ number_format($key->price) }} vnđ</td>
                                    
                                    <td class="quantity">
                                        <div class="input-group mb-3">
                                        <input type="text" name="quantity" id="quantity1" class="quantity form-control input-number" value="{{ $key->qty }}" min="0" max="100">
                                        </div>
                                    </td>
                                    
                                    <td class="total" id="total">{{ number_format($key->price * $key->qty)  }} vnđ</td>
                                    <td><button class="btn btn-primary py-2 px-3" style="color: white">Update</button></td>
                                </tr><!-- END TR-->
                                </form>
                                @endforeach</tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                        <div class="cart-total mb-3">
                            <h3>Coupon Code</h3>
                            <p>Enter your coupon code if you have one</p>
                            <form action="#" class="info">
                    <div class="form-group">
                        <label for="">Coupon code</label>
                        <input type="text" class="form-control text-left px-3" placeholder="">
                    </div>
                    </form>
                        </div>
                        <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Apply Coupon</a></p>
                    </div>
                    <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                        <div class="cart-total mb-3">
                            <h3>Estimate shipping and tax</h3>
                            <p>Enter your destination to get a shipping estimate</p>
                            <form action="#" class="info">
                    <div class="form-group">
                        <label for="">Country</label>
                        <input type="text" class="form-control text-left px-3" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="country">State/Province</label>
                        <input type="text" class="form-control text-left px-3" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="country">Zip/Postal Code</label>
                        <input type="text" class="form-control text-left px-3" placeholder="">
                    </div>
                    </form>
                        </div>
                        <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Estimate</a></p>
                    </div>
                    <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                        <div class="cart-total mb-3">
                            <h3>Tổng giỏ hàng</h3>
                            <p class="d-flex">
                                <span>Tổng tiền</span>
                                <span>{{ Cart::subtotal(0,',', '.') }} vnđ</span>
                            </p>
                            <p class="d-flex">
                                <span>Phí giao hàng</span>
                                <span>Free</span>
                            </p>
                            <p class="d-flex">
                                <span>Thuế</span>
                                <span>{{ Cart::tax(0,',', '.') }} vnđ</span>
                            </p>
                            <hr>
                            <p class="d-flex total-price">
                                <span>Thành tiền</span>
                                <span>{{ Cart::total(0,',', '.') }} vnđ</span>
                            </p>
                        </div>
                            @if(isset($_SESSION['id']))                         
                            <p><a href="{{route('checkout')}}" class="btn btn-primary py-3 px-4">Thanh toán</a></p>                    
                            @else 
                            <p><a href="{{route('login')}}" class="btn btn-primary py-3 px-4">Thanh toán</a></p>
                            @endif
               
                    </div>
                </div>
                </div>
            </section>
    @stop