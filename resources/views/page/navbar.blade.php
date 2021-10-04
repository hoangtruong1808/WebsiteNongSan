<div class="py-1 bg-primary">
            <div class="container">
                <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                    <div class="col-lg-12 d-block">
                        <div class="row d-flex">
                            <div class="col-md pr-4 d-flex topper align-items-center">
                                <div class="icon mr-2 d-flex justify-content-center align-items-center" style="color:white"><i class="fas fa-phone"></i></div>
                                <span class="text">+0704804311</span>
                            </div>
                            <div class="col-md pr-4 d-flex topper align-items-center">
                                <div class="icon mr-2 d-flex justify-content-center align-items-center " style="color:white"><i class="fas fa-envelope"></i></div>
                                <span class="text">hoangtruong1808@gmail.com</span>
                            </div>
                            <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                                <span class="text"><a href="" class="text">Đăng nhập</a> / <a  href="" class="text">Đăng ký</a></span> 
                            
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">
            <a class="navbar-brand" href="{{ route('Home') }}"><img src="{{ asset('logo.jpg') }}" style="width: 75px; margin-right: 20px">VEGEFOODS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ route('Home') }}" class="nav-link">Trang chủ</a></li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="route('show_all_product')" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mua hàng</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                    <a class="dropdown-item" href="{{ route('show_menu_product',['menu_id'=>5]) }}">Combo</a>
                    <a class="dropdown-item" href="{{ route('show_menu_product',['menu_id'=>6]) }}">Rau củ</a>
                    <a class="dropdown-item" href="{{ route('show_menu_product',['menu_id'=>7]) }}">Trái cây</a>
                    <a class="dropdown-item" href="{{ route('show_menu_product',['menu_id'=>8]) }}">Thủy hải sản</a>
                    <a class="dropdown-item" href="{{ route('show_menu_product',['menu_id'=>9]) }}">Đồ khô</a>
                </div>
                </li>
                <li class="nav-item"><a href="#" class="nav-link">Cần bán - Cần mua</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Giới thiệu</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Liên hệ</a></li>
                <li class="nav-item cta cta-colored"><a href="{{ route('show_cart') }}" class="nav-link"><span><i class="fas fa-shopping-cart"></i></span>[{{ Cart::content()->count() }}]</a></li>

                </ul>
            </div>
            </div>
        </nav>