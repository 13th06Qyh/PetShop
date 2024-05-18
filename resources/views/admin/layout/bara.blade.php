<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <meta content="" name="description">
    <meta content="" name="keywords">
    @include('admin.include.css')
</head>


<body>
    <!-- Sidebar -->
    <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:250px">
        <aside class="app-sidebar">
            <div class="app-sidebar__user"><a href="{{route('user.view')}}"><img class="app-sidebar__user-avatar"
                        src="{{asset('Picture/logo.png')}}" width="50px" alt="Logo Image"></a>
                <div>
                    <p class="app-sidebar__user-name"><b>Admin</b></p>
                </div>
            </div>
            <hr>
            <ul class="app-menu">
                <li><a class="app-menu__item" href="{{route('admin.customer')}}"><i
                            class='app-menu__icon bx bx-user-voice'></i><span class="app-menu__label">Quản lý khách
                            hàng</span></a></li>
                <li><a class="app-menu__item" href="{{route('admin.sanpham')}}"><i
                            class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý sản
                            phẩm</span></a>
                </li>
                <li><a class="app-menu__item" href="{{route('admin.bill')}}"><i
                            class='app-menu__icon bx bx-task'></i><span class="app-menu__label">Quản lý đơn
                            hàng</span></a></li>
                <li><a class="app-menu__item" href="{{route('admin.revenue')}}"><i
                            class='app-menu__icon bx bx-pie-chart-alt-2'></i><span class="app-menu__label">Thống
                            kê</span></a>
                </li>
                <li><a class="app-menu__item" href="{{route('admin.blog')}}"><i
                            class="app-menu__icon bi bi-journal-bookmark"></i><span class="app-menu__label">Quản lý bài
                            viết</span></a>
                </li>
                <!-- <li><a class="app-menu__item" href=""><i
                            class="app-menu__icon bi bi-chat-dots"></i><span class="app-menu__label">Quản lý bình
                            luận</span></a>
                </li> -->
            </ul>
        </aside>

    </div>
    @yield('main')
    @include('admin.include.js')
    @yield('custom_js')

</body>

</html>