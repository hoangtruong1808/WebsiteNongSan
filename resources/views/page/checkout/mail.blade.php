<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <title>Mail xác nhận đơn hàng</title>
</head>
<body>
    <div class="mail-area" style="margin: 20px; border: #82ae46 1px solid; padding: 30px; text-align: left;">
        <b>Cảm ơn bạn đã mua hàng!</b>
        <p>Xin chào {{$name}}, Cửa hàng chúng tôi đã nhận được đơn hàng của bạn. Chúng tôi sẽ thông báo cho bạn khi tiếp tục gửi đi. </p>
    </div>
    <div class="mail-area customer-information" style="margin: 20px; border: #82ae46 1px solid; padding: 30px; text-align: left;">
        <table>
            <tr>
                <th colspan="2" style="font-size: 18px;  padding-bottom: 20px; padding-right: 30px;">Thông tin khách hàng</th>
            </tr>
            <tr>
                <td style="padding-bottom: 20px; padding-right: 50px;">
                    <div><b>Họ tên khách hàng</b></div>
                    <div>{{$name}}</div>
                </td>
                <td style="padding-bottom: 20px">
                    <div><b>Địa chỉ email</b></div>
                    <div>{{$email}}</div>
                </td>
            </tr>
            <tr>
                <td style="padding-bottom: 20px; padding-right: 50px;">
                    <div><b>Địa chỉ nhận hàng</b></div>
                    <div>{{$address}}</div>
                </td>
                <td style="padding-bottom: 20px">
                    <div><b>Số điện thoại</b></div>
                    <div>{{$phone}}</div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding-bottom: 20px; padding-right: 50px;">
                    <div><b>Ghi chú</b></div>
                    <div>{{$note}}</div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding-bottom: 20px; padding-right: 50px;">
                    <div><b>Thanh toán</b></div>
                    <div>{{$payment}}</div>
                </td>
            </tr>
        </table>
    </div>
    <div class="mail-area checkout-information" style="margin: 20px; border: #82ae46 1px solid; padding: 30px; text-align: left;">
        <table class="table">
            <thead class="thead-primary">
            <tr>
                <th colspan="4" style="font-size: 18px;  padding-bottom: 20px; padding-right: 30px;"><b>Thông tin đơn hàng</b></th>
            </tr>

            <tr class="text-center">
                <th style="padding-bottom: 20px; padding-right: 50px;">Tên sản phẩm</th>
                <th style="padding-bottom: 20px; padding-right: 50px;">Đơn giá</th>
                <th style="padding-bottom: 20px; padding-right: 50px;">Số lượng</th>
                <th style="padding-bottom: 20px; padding-right: 50px;">Tổng giá</th>
            </tr>
            </thead>
            <tbody>
            @foreach(Cart::content() as $key)
                    <tr>
                        <td style="padding-bottom: 20px; padding-right: 50px;">
                            {{ $key->name }}
                        </td>
                        <td style="padding-bottom: 20px; padding-right: 50px;">{{ number_format($key->price) }} VNĐ</td>

                        <td style="padding-bottom: 20px">
                            <div class="input-group mb-3">
                                {{ $key->qty }}
                            </div>
                        </td>
                        <td class="total" id="total" style="padding-bottom: 20px; padding-right: 50px;">{{ number_format($key->price * $key->qty)  }} VNĐ</td>
                    </tr><!-- END TR-->
            @endforeach
                    <tr>
                        <td colspan="3" style="font-weight: bold; text-align: right">Tổng đơn hàng: </td>
                        <td>{{ number_format(Cart::subtotal(0, "", "")) }} VNĐ</td>
                    </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
