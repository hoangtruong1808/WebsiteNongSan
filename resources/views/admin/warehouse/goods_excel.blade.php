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
            <th colspan='6'>PHIẾU NHẬP HÀNG</th>
        </tr>
        <tr>
            <th colspan='6'><i>Ngày {{date('d-m-Y')}}</i></th>
        </tr>
        <tr>
        </tr>
        <tr>
            <th colspan='6'>Nhà cung cấp: {{$phieunhaphang->supplier_name}}</th>
        </tr>
        <tr>

        </tr>
        <tr>
            <th colspan='6'>Số điện thoại: {{$phieunhaphang->supplier_phone}}</th>
        </tr>
        <tr>
        </tr>
        <tr>
            <th>STT</th>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th colspan='2'>Đơn giá(VNĐ)</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt=1 ?>
        @foreach ($chitietphieunhaphang as $item)
        <tr>
            <td>{{ $stt++ }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td colspan='2'>{{ number_format($item->unit_price) }} VNĐ</td>
            <td>{{ number_format($item->price) }} VNĐ</td>
        </tr>
        @endforeach
        <tr>
            <td colspan='5' style="text-align: right">Tổng cộng</td>
            <td>{{ number_format($phieunhaphang->total) }} VNĐ</td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td colspan='3' style="text-align: center"><b>Nhà cung cấp</b></td>
            <td colspan='3' style="text-align: center"><b>Nhân viên</b></td>
        </tr>
        <tr>
            <td colspan='3' style="text-align: center"><i>(ký, họ tên)</i></td>
            <td colspan='3' style="text-align: center"><i>(ký, họ tên)</i></td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td colspan='3'></td>
            <td colspan='3' style="text-align: center"><b><i>{{$phieunhaphang->staff_name}}</i></b></td>
        </tr>
    </tbody>
</table>
