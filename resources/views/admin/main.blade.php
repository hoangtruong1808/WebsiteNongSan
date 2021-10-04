
    <!DOCTYPE html>
    <html lang="en">
    @include('/admin/head')
    <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Navbar -->
      @include('/admin/navbar')
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      @include('/admin/sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <div class="card card-primary" style="margin: 20px 30px 0px 30px">
          <div class="card-header" style="background-color: #298A08">
            <h3 class="card-title">{{ $title }}</h3>
          </div>
        <!-- Content Header (Page header) -->
        @yield('content')
        </div>
      </div>  

      <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
          <b>Website nông sản</b> 
        </div>
        <strong>Copyright &copy; 2021 <a href="https://www.facebook.com/hoangtruong1808/">Nguyễn Hoàng Trường</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('/admin/foot')
    </body>
    </html>
