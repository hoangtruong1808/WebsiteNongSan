<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">{{ $unread_count }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
{{--          @foreach($unread as $item)--}}
{{--          <a href="#" class="dropdown-item">--}}
{{--            <!-- Message Start -->--}}
{{--            <div class="media">--}}
{{--              <img src="{{ asset('avatar.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">--}}
{{--              <div class="media-body">--}}
{{--                <h3 class="dropdown-item-title">--}}
{{--                  {{$item->name}}--}}
{{--                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>--}}
{{--                </h3>--}}
{{--                <p class="text-sm">{{$item->content}}</p>--}}
{{--                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{$item->time}}</p>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--            <!-- Message End -->--}}
{{--          </a>--}}
{{--          <div class="dropdown-divider"></div>--}}
{{--          @endforeach--}}



          <a href="{{ route('message_show') }}" class="dropdown-item dropdown-footer">Xem tất cả tin nhắn</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
        <div class="collapse navbar-collapse" id="navbar-list-4">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset('storage/avatar/'.$account->avatar)}}" width="40" height="40" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{route('admin_myaccount')}}">Tài khoản</a>
                        <a class="dropdown-item" href="{{route('admin_change_password')}}">Đổi mật khẩu</a>
                        <a class="dropdown-item" href="{{route('admin_logout')}}">Đăng xuất</a>
                    </div>
                </li>
            </ul>
        </div>

    </ul>
  </nav>
