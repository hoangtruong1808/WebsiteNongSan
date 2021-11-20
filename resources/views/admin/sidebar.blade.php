  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../../index3.html" class="brand-link">
        <img src="{{ asset('logo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>Nông sản Việt</b></span>
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
              <a href="" class="nav-link">
                  <i class="fas fa-bars"></i>
                <p>
                  Danh mục
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('menu_show') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Danh sách</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('menu_create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Thêm</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">
                  <i class="fas fa-bars"></i>
                <p>
                  Sản phẩm
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('product_show') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Danh sách</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('product_create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Thêm</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{ route('order_show')}}" class="nav-link">
                  <i class="fas fa-bars"></i>
                <p>
                  Đơn đặt hàng
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