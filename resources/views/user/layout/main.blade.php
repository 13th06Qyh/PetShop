<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    @include('user.include.css')
</head>

<body>
    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <a href="mailto:quynhpn.22it@vku.udn.vn"><i class="bi bi-envelope d-flex align-items-center">
                        &nbsp;Mail&nbsp;&nbsp;</a></i>

            </div>
            @yield('find')
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
            </div>
        </div>
    </section>
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex justify-content-between align-items-center">

            <div class="logo">
                <a href="{{ route('user.view') }}"><img src="{{ asset('Picture/logo.png') }}" alt=""
                        class="img-fluid"></a>
            </div>


            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="active" href="{{ route('user.view') }}">Trang Chủ</a></li>

                    <li class=" dropdown"><a href="#"><span>Review</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ route('blogcho.view') }}">Giống Cún</a></li>
                            <li><a href="{{ route('blogmeo.view') }}">Giống Mèo</a></li>
                            <li><a href="{{ route('blogchim.view') }}">Giống Chim</a></li>
                            <li><a href="{{ route('blogchuot.view') }}">Giống Chuột</a></li>
                            <li><a href="{{ route('blogca.view') }}">Giống Cá</a></li>
                        </ul>
                    </li>

                    <li class="dropdown"><a href="#"><span>Shop Cún</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ route('shopchoqa.view') }}">Áo quần và phụ kiện</a></li>
                            <li><a href="{{ route('shopchota.view') }}">Đồ ăn</a></li>
                            <li><a href="{{ route('shopchodc.view') }}">Đồ chơi và vật dụng</a></li>
                        </ul>
                    </li>

                    <li class="dropdown"><a href="#"><span>Shop Mèo</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ route('shopmeota.view') }}">Áo quần và phụ kiện</a></li>
                            <li><a href="{{ route('shopmeoqa.view') }}">Đồ ăn</a></li>
                            <li><a href="{{ route('shopmeodc.view') }}">Đồ chơi và vật dụng</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('shopchim.view') }}">Chim Cảnh</a></li>
                    <li><a href="{{ route('shopchuot.view') }}">Chuột Cảnh</a></li>
                    <li><a href="{{ route('shopca.view') }}">Cá Cảnh</a></li>

                    <li><a href="{{ route('contact.view') }}">Liên hệ</a></li>


                    @if (auth()->check())
                    <li class="dropdown"><a href="#"><span>Tài khoản</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ route('account.view') }}">Thông tin</a></li>
                            @if (auth()->user()->role == 'admin')
                            <li><a href="{{ route('admin.customer') }}">Quản lý</a></li>
                            @elseif (auth()->user()->role == 'user')
                            <li><a href="{{ route('order.view') }}">Đơn hàng</a></li>
                            @endif
                            <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                        </ul>
                    </li>
                    @else
                    <li class="dropdown"><a href="#"><span>Đăng nhập/Đăng kí</span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ route('login.view') }}">Đăng nhập</a></li>
                            <li><a href="{{ route('sigin.view') }}">Đăng kí</a></li>
                        </ul>
                    </li>


                    @endif



                </ul>
                <!-- <form class="d-flex"> -->
                @if (auth()->check())
                @if (auth()->user()->role == 'user')
                <button id="nextButton" class="btn btn-outline-dark">
                    <img src="{{ asset('giohang.png') }}" alt="" width="35px">
                </button>
                @else
                <label id="" class="btn btn-outline-dark">
                    <img src="{{ asset('admintrator.png') }}" alt="" width="35px">
                </label>
                @endif
                @else
                <button id="nextButton" class="btn btn-outline-dark">
                    <img src="{{ asset('giohang.png') }}" alt="" width="35px">
                </button>
                @endif


                <!-- </form> -->
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    @yield('main')
    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Giới Thiệu</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('user.view') }}">Trang chủ</a>
                            </li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('blogcho.view') }}">Cún cưng</a>
                            </li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('blogmeo.view') }}">Mèo cưng</a>
                            </li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('blogchim.view') }}">Chim
                                    cảnh</a>
                            </li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('blogchuot.view') }}">Chuột
                                    cảnh</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('blogca.view') }}">Cá cảnh</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Mặt hàng</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Áo Quần</a>
                                <ul class="sub_menu">
                                    <li><i class="bx bx-chevron-right"></i> <a href="{{ route('shopchoqa.view') }}">Áo
                                            Quần Của
                                            Cún</a></li>
                                    <li><i class="bx bx-chevron-right"></i> <a href="{{ route('shopmeoqa.view') }}">Áo
                                            Quần Của
                                            Mèo</a></li>
                                </ul>
                            </li>

                            <li><i class="bx bx-chevron-right"></i> <a href="#">Thức Ăn</a>
                                <ul class="sub_menu">
                                    <li><i class="bx bx-chevron-right"></i> <a href="{{ route('shopchota.view') }}">Thức
                                            Ăn Của
                                            Cún</a></li>
                                    <li><i class="bx bx-chevron-right"></i> <a href="{{ route('shopmeota.view') }}">Thức
                                            Ăn Của
                                            Mèo</a></li>
                                </ul>
                            </li>

                            <li><i class="bx bx-chevron-right"></i> <a href="#">Dồ Chơi</a>
                                <ul class="sub_menu">
                                    <li><i class="bx bx-chevron-right"></i> <a href="{{ route('shopchodc.view') }}">Đồ
                                            Chơi Của
                                            Cún</a></li>
                                    <li><i class="bx bx-chevron-right"></i> <a href="{{ route('shopmeodc.view') }}">Đồ
                                            Chơi Của
                                            Mèo</a></li>
                                </ul>
                            </li>

                            <li><i class="bx bx-chevron-right"></i> <a href="#">Khác</a>
                                <ul class="sub_menu">
                                    <li><i class="bx bx-chevron-right"></i> <a href="{{ route('shopchim.view') }}">Vật
                                            Dụng Của
                                            Chim</a></li>
                                    <li><i class="bx bx-chevron-right"></i> <a href="{{ route('shopchuot.view') }}">Vật
                                            Dụng Của
                                            Chuột</a></li>
                                    <li><i class="bx bx-chevron-right"></i> <a href="{{ route('shopca.view') }}">Vật
                                            Dụng Của Cá</a>
                                    </li>
                                </ul>

                            </li>
                        </ul>

                    </div>



                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h4>Liên hệ</h4>
                        <p>
                            Trường Đại Học Công Nghệ thông tin và truyền thông Việt Hàn <br>
                            Địa chỉ: Khu đô thị Đại học Đà Nẵng, 470 Đường Trần Đại Nghĩa, phường Hòa Quý, quận Ngũ Hành
                            Sơn, Đà Nẵng<br>
                            Việt Nam <br><br>
                            <strong>Phone:</strong> 0147.8.443.677<br>
                            <strong>Email:</strong> quynhpn.22it@vku.udn.vn<br>
                        </p>

                    </div>

                    <div class="col-lg-3 col-md-6 footer-info">
                        <h3>PetShop</h3>
                        <p>Pet Shop là thiên đường thú cưng , nơi cung cấp toàn bộ những thứ liên quan đến đời sống của
                            pet. Pet Shop đảm bảo 100% về chất lượng và độ an toàn!</p>
                        <div class="social-links mt-3">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bi bi-tiktok"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-youtube"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &#64; Cửa hàng kinh doanh thú cưng - <strong><span> PetShop</span></strong><br>
                Chúc mọi người một ngày tốt lành <i class="bi bi-emoji-smile"></i>
            </div>

        </div>
    </footer><!-- End Footer -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('user.include.js')
    <script>
    var nextButton = document.getElementById("nextButton");
    nextButton.onclick = function() {
        window.location.href = "{{ route('cart.view') }}"
    }
    </script>
    @yield('custom_js')
</body>

</html>