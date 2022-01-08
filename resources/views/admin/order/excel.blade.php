<table>
    <thead>
        <tr>
        </tr>
        <tr>
            <th colspan='6'>CỬA HÀNG BÁN NÔNG SẢN VIỆT</th>
        </tr>
        <tr>
            <th colspan='6'>Chuyên bán nông sản tươi và sạch sẽ, đảm bảo an toàn vệ sinh</th>
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
            <th colspan='6'>Họ tên người nhận hàng: {{$shipping->name}}</th>
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
            <th>Số lượng</th>
            <th>Đơn vị</th>
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
            <td>{{ $item->quantity }}</td>
            <td>kg</td>
            <td>{{ number_format($item->price) }} VNĐ</td>
            <td>{{ number_format($item->quantity*$item->price) }} VNĐ</td>
        </tr>
        @endforeach
        <tr>
            <td colspan='5' style="text-align: right">Tổng cộng</td>
            <td>{{ number_format($order->total) }} VNĐ</td>
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