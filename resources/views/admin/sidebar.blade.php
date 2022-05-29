  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('Home') }}" class="brand-link">
        <img src="{{ asset('logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>VEGEFOODS</b></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
              <li class="nav-item">
                  <a href="{{ route('menu_show')}}" class="nav-link">
                      <i class="fas fa-bars"></i>
                      <p style="margin-left: 4px">
                          Danh mục
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('product_show')}}" class="nav-link">
                      <i class="fas fa-carrot"></i>
                      <p style="margin-left: 4px">
                          Sản phẩm
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
              </li>
            <li class="nav-item">
              <a href="{{ route('order_show')}}" class="nav-link">
                  <i class="fas fa-credit-card"></i>
                <p style="margin-left: 4px">
                  Đơn đặt hàng
                    <i class="right fas fa-angle-left"></i>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('customer_show') }}" class="nav-link">
                  <i class="fas fa-user"></i>
                <p style="margin-left: 4px">
                  Khách hàng
                    <i class="right fas fa-angle-left"></i>
                </p>
              </a>
            </li>
{{--            <li class="nav-item">--}}
{{--              <a href="{{ route('message_show') }}" class="nav-link">--}}
{{--                  <i class="fas fa-bars"></i>--}}
{{--                <p>--}}
{{--                  Tin nhắn--}}
{{--                  <i class="right fas fa-angle-left"></i>--}}
{{--                </p>--}}
{{--              </a>--}}
{{--            </li>--}}
              <li class="nav-item">
                  <a href="{{ route('voucher_show')}}" class="nav-link">
                      <i class="fas fa-barcode"></i>
                      <p style="margin-left: 4px">
                          Mã khuyến mãi
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('staff_show')}}" class="nav-link">
                      <i class="fas fa-house-user"></i>
                      <p style="margin-left: 4px">
                          Nhân viên
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
              </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
