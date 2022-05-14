@extends('page/main')

@section('content')
<section class="ftco-section">
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 text-center">
                <ul class="product-category">
                    <li><a href="{{ route('account') }}" >Thông tin tài khoản</a></li>
                    <li><a href="{{ route('order_history') }}">Lịch sử đặt hàng</a></li>
                    <li><a href="{{ route('show_voucher') }}"  class="active" >Mã khuyến mãi</a></li>
                    <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
            <table class="table">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã giảm giá</th>
                    <th>Mô tả</th>
                    <th>Giá trị</th>
                    <th>Đơn hàng</th>
                    <th>Thời gian khuyến mãi</th>
                    <th>Tình trạng</th>
                </tr>
                </thead>
                <?php
                $message = Session::get('message');
                if($message) {
                    echo '<div class="alert alert-success" style="width: 100%">'.$message.'</div>';
                    Session::put('message', null);
                }
                $stt=1;
                ?>
                <?php
                if (isset($_GET['page']))
                {
                    $page = $_GET['page'];
                }
                else $page = 1;
                $a = ( $page-1)*10+1; ?>
                <tbody>
                @foreach($account_voucher as $item)
                <tr>
                    <td>{{ $stt++ }}</td>
                    <td>
                        <div>{{ $item->code }}</div>
                        <div><button class="copy-btn" data-code="{{ $item->code }}" title="Copy" style="border: 0.5px darkgrey solid"><i class="fas fa-copy"></i></button></div>
                    </td>
                    <td>{{ $item->describe }}</td>
                    <td>{{ number_format($item->value) }} {{ $item->unit }}</td>
                    <td>
                        @if(isset($item->order_min))
                            <div>Từ: {{ number_format($item->order_min) }} VNĐ</div>
                        @endif
                        @if(isset($item->order_max))
                            <div>Đến: {{ number_format($item->order_max) }} VNĐ</div>
                        @endif
                    </td>
                    <td>
                        @if(isset($item->date_start))
                            <div>Từ: {{strftime('%H:%M %d-%m-%Y', strtotime($item->date_start))}} </div>
                        @endif
                        @if(isset($item->date_end))
                            <div>Đến: {{strftime('%H:%M %d-%m-%Y', strtotime($item->date_end ))}} </div>
                        @endif
                    </td>
                    <td>
                        <div>
                            @if ($item->active == 1)
                                <span class="badge badge-success" style="font-size: 14px">Đang sử dụng</span>
                            @elseif ($item->active == 2)
                                <span class="badge badge-danger" style="font-size: 14px">Hết hạn sử dụng</span>
                            @elseif ($item->active == 3)
                                <span class="badge badge-warning" style="font-size: 14px">Hết số lượng</span>
                            @endif
                        </div>
                    </td>
                </tr>
                </tbody>
                @endforeach
            </table>
        <div style="margin-left: 45%">
            {{ $account_voucher->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>
    <script>
            $(document).ready(function() {
            $( ".copy-btn" ).click(function() {
                var code = $(this).attr('data-code');
                copyToClipboard(code);
                $(this).css("color", "blue");
                $( ".copy-btn" ).not(this ).css( "color", "black");

            });
        });
            function copyToClipboard(text) {
            var sampleTextarea = document.createElement("textarea");
            document.body.appendChild(sampleTextarea);
            sampleTextarea.value = text; //save main text in it
            sampleTextarea.select(); //select textarea contenrs
            document.execCommand("copy");
            document.body.removeChild(sampleTextarea);
        }
    </script>
@stop
