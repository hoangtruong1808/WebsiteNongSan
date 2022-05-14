    @extends('page/main')

    @section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-xl-7 ftco-animate">
                <form action="{{ route('store_checkout') }}" method="POST" class="billing-form">
                    @csrf()
                    <h3 class="mb-4 billing-heading">Thanh toán đơn hàng</h3>
                    @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="font-size: 15px">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @if(isset($_SESSION['id']))
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="firstname">Họ tên:</label>
                            <input type="text" class="form-control" placeholder="" value="{{$customer->name}}" style="font-size: 16px; font-weight: bold" name="name">
                        </div>
                    </div>

                    <div class="w-100"></div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="streetaddress">Địa chỉ</label>
                            <input type="text" class="form-control" placeholder="" value="{{$customer->address}}" style="font-size: 16px; font-weight: bold" name="address">
                        </div>
                    </div>

                    <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" class="form-control" placeholder="" value="{{$customer->phone}}" style="font-size: 16px; font-weight: bold" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emailaddress">Email</label>
                                <input type="text" class="form-control" placeholder="" value="{{$customer->email}}" style="font-size: 16px; font-weight: bold" name="email">
                            </div>
                        </div>

                    @else
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="firstname">Họ tên:</label>
                            <input type="text" class="form-control" placeholder="" style="font-size: 16px; font-weight: bold" name="name">
                        </div>
                    </div>

                    <div class="w-100"></div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="streetaddress">Địa chỉ</label>
                            <input type="text" class="form-control" placeholder="" style="font-size: 16px; font-weight: bold" name="address">
                        </div>
                    </div>

                    <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" class="form-control" placeholder="" style="font-size: 16px; font-weight: bold" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emailaddress">Email</label>
                                <input type="text" class="form-control" placeholder="" style="font-size: 16px; font-weight: bold" name="email">
                            </div>
                        </div>
                    @endif
                    <div class="w-100"></div>
                    <label for="note">Ghi chú</label>
                    <div class="col-md-12">
                        <div class="form-group">

                            <textarea style="width: 100%; height: 170px; border: #D8D8D8 1px solid" name="note"></textarea>
                        </div>
                    </div>

                    </div>
                        </div>
                        <div class="col-xl-5">
                <div class="row mt-5 pt-3">
                    <div class="col-md-12 d-flex mb-5">
                        <div class="cart-detail cart-total p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Tổng giỏ hàng</h3>
                            <p class="d-flex">
                                <span>Tổng tiền</span>
                                <span>{{ Cart::initial(0,'.', ',') }} vnđ</span>
                            </p>
                            <p class="d-flex">
                                <span>Giảm giá</span>
                                <span>{{Cart::discount(0,'.', ',')}} vnđ</span>
                            </p>
                            <p class="d-flex">
                                <span>Phí giao hàng </span>
                                <span>Free</span>
                            </p>
                            <hr>
                            <p class="d-flex total-price">
                                <span>Thành tiền</span>
                                <span>{{ Cart::subtotal(0,'.', ',') }} vnđ</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="cart-detail p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Phương thức thanh toán</h3>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                    <label><input type="radio" name="payment_method" value="Chuyển tiền trực tiếp" class="mr-2">Chuyển tiền trực tiếp</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                    <label><input type="radio" name="payment_method" value="Thanh toán khi nhận hàng" class="mr-2">Thanh toán khi nhận hàng</label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary py-3 px-4">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div> <!-- .col-md-8 -->
            </div>
        </div>
        </section>
        @stop
