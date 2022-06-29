
<!DOCTYPE html>
<html lang="en">
<head>
    @include('page/head')
</head>
<body class="goto-here">
@include('sweetalert::alert')
@include('page/navbar')
<!-- END nav -->

@include('page/banner')

@yield('content')

@include('page/footer')

<!-- loader -->
@include('page/lib')
<script>
    var customer_name;
    @if (isset($_SESSION['id']))
        customer_name = '{{$_SESSION["customer_name"]}}'
    @else
        customer_name = 'bạn'
    @endif
        frameEndpoint: '/en/botman'
    var botmanWidget = {
        title: 'Chatbot tư vấn',
        aboutText: '',
        placeholderText: 'Nhập tin nhắn',
        introMessage: "Xin chào "+customer_name+"!. Chào mừng bạn đến với cửa hàng Nông Sản Việt. Mình có thể hỗ trợ gì cho bạn?",
        mainColor: "#82ae46",
        bubbleBackground: "#82ae46",
        headerTextColor: 'white',
        background: 'none',
        // desktopHeight: '700',
        // desktopWidth: '440',
    };
</script>
</body>
</html>

