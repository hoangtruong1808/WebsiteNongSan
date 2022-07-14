<style>
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/admin" class="brand-link">
        <img src="{{ asset('logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>NÔNG SẢN VIỆT</b></span>
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
              <hr  width="100%" size="12px" align="center" color="#6c757d" style="border-width: 2px; margin: 6px 0px; padding: 0px"/>
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
              <li class="nav-item">
                  <a href="{{ route('menu_show')}}" class="nav-link {{($controller == 'menu')?'active':''}}">
                      <i class="fas fa-bars"></i>
                      <p style="margin-left: 4px">
                          Danh mục
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('product_show')}}" class="nav-link {{($controller == 'product')?'active':''}}">
                      <i class="fas fa-carrot"></i>
                      <p style="margin-left: 4px">
                          Sản phẩm
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="" class="nav-link {{($controller == 'voucher')?'active':''}}">
                      <i class="fas fa-barcode"></i>
                      <p>
                          Ưu đãi
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>

                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('voucher_show')}}" class="nav-link">
                              <p>Mã khuyến mãi</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('discount_show') }}" class="nav-link">
                              <p>Giảm giá sản phẩm</p>
                          </a>
                      </li>
                  </ul>
              </li>
              <hr  width="100%" size="12px" align="center" color="#6c757d" style="border-width: 2px; margin: 6px 0px; padding: 0px"/>
              <li class="nav-item">
                  <a href="{{ route('customer_show') }}" class="nav-link {{($controller == 'customer')?'active':''}} ">
                      <i class="fas fa-user"></i>
                      <p style="margin-left: 4px">
                          Khách hàng
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
              </li>
            <li class="nav-item">
              <a href="{{ route('order_show')}}" class="nav-link {{($controller == 'order')?'active':''}}">
                  <i class="fas fa-credit-card"></i>
                <p style="margin-left: 4px">
                  Đơn đặt hàng
                    <i class="right fas fa-angle-left"></i>
                </p>
              </a>
            </li>
              <hr  width="100%" size="12px" align="center" color="#6c757d" style="border-width: 2px; margin: 6px 0px; padding: 0px"/>
              <li class="nav-item">
                  <a href="" class="nav-link {{($controller == 'warehouse')?'active':''}}">
                      <i class="fas fa-warehouse"></i>
                      <p>
                          Kho hàng
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>

                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('warehouse_show')}}" class="nav-link">
                              <p>Danh sách</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('import_goods')}}" class="nav-link">
                              <p>Nhập hàng</p>
                          </a>
                      </li>
                  </ul>
              </li>
              <li class="nav-item">
                  <a href="" class="nav-link {{($controller == 'turnover')?'active':''}}">
                      <i class="fas fa-money-bill"></i>
                      <p>
                          Thống kê doanh thu
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>

                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('turnover_based_on_product')}}" class="nav-link">
                              <p>Theo sản phẩm</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('turnover_based_on_customer') }}" class="nav-link">
                              <p>Theo khách hàng</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('turnover_based_on_date') }}" class="nav-link">
                              <p>Theo thời gian</p>
                          </a>
                      </li>
                  </ul>
              </li>
              <li class="nav-item">
                  <a href="{{ route('supplier_show') }}" class="nav-link {{($controller == 'supplier')?'active':''}}">
                      <i class="fas fa-address-book"></i>
                      <p style="margin-left: 4px">
                          Nhà cung cấp
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
              </li>
              <hr  width="100%" size="12px" align="center" color="#6c757d" style="border-width: 2px; margin: 6px 0px; padding: 0px"/>
              @if ($_SESSION['admin_id']==1)
              <li class="nav-item">
                  <a href="{{ route('staff_show')}}" class="nav-link {{($controller == 'staff')?'active':''}}">
                      <i class="fas fa-house-user"></i>
                      <p style="margin-left: 4px">
                          Nhân viên
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
              </li>
              <hr  width="100%" size="12px" align="center" color="#6c757d" style="border-width: 2px; margin: 6px 0px; padding: 0px"/>
              @endif

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
