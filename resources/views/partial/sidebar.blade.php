<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md ">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">
        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body card-body-sidebar-top">
                <div class="media">
                    <div class="mr-2">
                        <a href="#"><img src="{{ asset('assets/backend/image/no-user.png') }}" width="20" height="20"
                                alt=""></a>
                    </div>
                    <div class="media-body">
                        <a href="#" class="text-white">
                            <div class="media-title font-weight-semibold">Thông tin </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->
        <!-- Main navigation -->
        <div class="card card-sidebar-mobile nav-menu-main">
            <ul class="nav nav-sidebar " data-nav-type="accordion">


                {{-- Quản trị đơn hàng --}}
                <li class="nav-item nav-item-submenu nav-item-open">
                    <a href="#" class="nav-link"><i class="icon-list-ordered"></i>
                        <span>Quản Trị Thông Tin Khách Hàng</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Themes" style="display: block;">
                        <li class="nav-item"><a href="/member/customer/all" class="nav-link">Danh sách Khách Hàng</a>
                        </li>
                    </ul>
                </li>

                @if (Auth::user()->role == 3)
                    <li class="nav-item nav-item-submenu">
                        <a href="#" class="nav-link"><i class="icon-color-sampler"></i>
                            <span>Quản trị thông tin CTV</span></a>
                        <ul class="nav nav-group-sub" data-submenu-title="Themes">
                            <li class="nav-item"><a href="/member/ctv/all" class="nav-link">Danh sách CTV</a></li>

                        </ul>
                    </li>
                @endif
                













                {{-- <li class="nav-item ">
                        <a href="{{ route('qt_adminbank.create') }}" class="nav-link">
                            <i class="icon-color-sampler"></i>
                            <span>Tạo CTV Ngân Hàng</span></a>
                    </li> --}}

                <!-- /page kits -->
            </ul>
        </div>
        {{-- <div class="card card-sidebar-mobile nav-sidebar-user">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <li class="nav-item nav-item-user">
                    <a href="#" class="nav-link"><i class="icon-user"></i> Thay đổi mật khẩu</a>
                    <a href="#" class="nav-link"><i class="icon-switch2"></i> Đăng xuất</a>
                </li>
            </ul>
        </div> --}}


        <!-- /main navigation -->
    </div>
    <!-- /sidebar content -->

</div>
