<head>
    <title>Xuất QR</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{asset('/jQuery.print.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body style="margin-left: 28%">
    <div id="qrcode">
        {!! QrCode::size(300)->generate(route('show_product_detail',['product_id'=>$product_id])) !!}
    </div>
    <div>
        <span class="btn btn-primary" id="print-btn" type="button" style="margin-top: 20px; margin-left: 45px; width:70px">In</span>
        <span class="btn btn-secondary" id="cancel-btn" style="margin-top: 20px; margin-left: 40px; width:70px">Hủy</span>
    </div>
</body>
<script>
    $('#print-btn').click(function(){
            $.print("#qrcode");

    })
    $("#cancel-btn").click(function() {
        window.close();
    });
</script>
