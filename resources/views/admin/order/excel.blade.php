<table>
    <thead>
        <tr>
            <th colspan='2'>
        </tr>
        <tr>
            <th></th>
            <th colspan='5'>CỬA HÀNG BÁN NÔNG SẢN VIỆT</th>
        </tr>
        <tr>
            <th></th>
            <th colspan='5'>Chuyên bán nông sản tươi và sạch sẽ, đảm bảo an toàn vệ sinh</th>
        </tr>
        <tr>
        </tr>
        <tr>
            <th colspan='6'>HÓA ĐƠN BÁN HÀNG</th>
        </tr>
        <tr>
            <th colspan='6'><i>Ngày {{date('d-m-Y')}}</i></th>
        </tr>
        <tr>
        </tr>
        <tr>
            <th colspan='6'>Họ tên khách hàng: {{$shipping->name}}</th>
        </tr>
        <tr>
            <th colspan='6'>Địa chỉ: {{$shipping->address}}</th>
        </tr>
        <tr>
            <th colspan='6'>Số điện thoại: {{$shipping->phone}}</th>
        </tr>
        <tr>
        </tr>
        <tr>
            <th>STT</th>
            <th>Sản phẩm</th>
            <th colspan='2'>Số lượng</th>
            <th>Đơn giá(VNĐ)</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt=1 ?>
        @foreach ($order_detail as $item)
        <tr>
            <td>{{ $stt++ }}</td>
            <td>{{ $item->name }}</td>
            <td colspan='2'>{{ $item->quantity }}</td>
            <td>{{ number_format($item->price) }} VNĐ</td>
            <td>{{ number_format($item->quantity*$item->price) }} VNĐ</td>
        </tr>
        @endforeach
        <tr>
            <td colspan='4' style="text-align: right">Khuyến mãi</td>
            <td colspan='2' style="text-align: center">{{ number_format($order->voucher_value) }}  VNĐ</td>
        </tr>
        <tr>
            <td colspan='4' style="text-align: right">Phí giao hàng</td>
            <td colspan='2' style="text-align: center">30.000 VNĐ</td>
        </tr>
        <tr>
            <td colspan='4' style="text-align: right"><b>Tổng cộng</b></td>
            <td colspan='2' style="text-align: center"><b>{{ number_format($order->total) }} VNĐ</b></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td colspan='3' style="text-align: center"><b>Khách hàng</b></td>
            <td colspan='3' style="text-align: center"><b>Nhân viên</b></td>
        </tr>
        <tr>
            <td colspan='3' style="text-align: center"><i>(ký, họ tên)</i></td>
            <td colspan='3' style="text-align: center"><i>(ký, họ tên)</i></td>
        </tr>
    </tbody>
</table>
