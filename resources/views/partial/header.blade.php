<div class="navbar navbar-expand-md navbar-dark">

    <div class="navbar-brand pb-0 pt-0">
        <a href="" class="d-flex">
            <img src="{{ asset('assets/backend/image/Group49.png') }}" alt="" width="22" class="mr-2 logo-icon">
            <img src="{{ asset('assets/backend/image/RepeatGrid2.png') }}" alt="" class="logo-header" width="100">
        </a>
    </div>

    <div class="d-md-none">
       
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>

        <span class="badge bg-success ml-md-3 mr-md-auto menu-user-header-response">Online</span>

         <ul class="navbar-nav">
            <li class="nav-item dropdown dropdown-user ">
                <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle  menu-user-header-response" data-toggle="dropdown">
                    <img src="{{ asset('assets/backend/image/no-user.png') }}" class="rounded-circle mr-2" height="34"
                        alt="">
                    <span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right list-info-user">
                    <a href="/ctv/change_password" class="dropdown-item"><i class="icon-user"></i> Đổi mật khẩu </a>
                    <a href="{{route('logout')}}" class="dropdown-item"><i class="icon-switch2"></i> Đăng xuất</a>
                </div>
            </li>

        </ul> 
        
    </div>

</div>
<div id="bg-loader">
    <div class="loader">Loading...</div>
</div>
