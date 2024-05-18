<!-- Lấy phần header, footer, css -->
@extends('user.layout.main')

<!-- Tên trang -->
@section('title')
<title>Trang chủ</title>
@endsection

<!-- Nội dung của trang, phần thân -->
@section('main')
<!-- ======= Hero Section ======= -->
<section id="hero">
    <div class="hero-container">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

            <div class="carousel-inner" role="listbox">

                <!-- Slide 1 -->
                <div class="carousel-item active" style="background-image: url(Picture/cm1.jpg)">
                    <div class="carousel-container">
                        <div class="carousel-content">
                            <h2 class="animate__animated animate__fadeInDown">Chào mừng đến với <span>PETSHOP</span>
                            </h2>
                            <p class="animate__animated animate__fadeInUp">Hãy dạo quanh trang web để tìm hiểu về
                                các sản phẩm chất lượng cao và dịch vụ chăm sóc tuyệt vời mà chúng tôi cung cấp.
                                Chúng tôi hy vọng bạn sẽ tìm thấy những điều tuyệt vời và gặp được một thành viên
                                mới trong gia đình đáng yêu của bạn. Cảm ơn bạn đã ghé thăm và chúc bạn có một trải
                                nghiệm mua sắm thú vị!</p>

                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item" style="background-image: url(Picture/cm3.jpg)">
                    <div class="carousel-container">
                        <div class="carousel-content">
                            <h2 class="animate__animated fanimate__adeInDown">Review một số <span>Cún Cưng</span>
                            </h2>
                            <p class="animate__animated animate__fadeInUp">Cún cưng là những vị khách đáng yêu và
                                trung thành trong gia đình của chúng ta. Tại Petshop, chúng tôi cung cấp một loạt
                                các mặt hàng dành cho cún cưng, bao gồm thức ăn chất lượng cao, đồ chơi giải trí,
                                phụ kiện thời trang.</p>
                            <a href="{{ route('blogcho.view') }}"
                                class="btn-get-started animate__animated animate__fadeInUp">Go</a>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item" style="background-image: url(Picture/cm2.jpg)">
                    <div class="carousel-container">
                        <div class="carousel-content">
                            <h2 class="animate__animated animate__fadeInDown">Review một số <span>Mèo Cưng</span>
                            </h2>
                            <p class="animate__animated animate__fadeInUp">Mèo cưng là những bạn đồng hành đáng yêu
                                và nâng niu trong gia đình. Tại Petshop, chúng tôi cung cấp một loạt các sản phẩm
                                dành cho mèo cưng, bao gồm thức ăn chất lượng, đồ chơi giải trí, phụ kiện thoải mái.
                            </p>
                            <a href="{{ route('blogmeo.view') }}"
                                class="btn-get-started animate__animated animate__fadeInUp">Go</a>
                        </div>
                    </div>
                </div>

            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>
    </div>
</section><!-- End Hero -->

<main id="main">

    <!-- ======= Featured Section ======= -->
    <section id="featured" class="featured">
        <div class="container">

            <div class="row">
                <div class="col-lg-4">
                    <div class="icon-box">
                        <i class="bi bi-bag-check"></i>
                        <!-- <i class="bi bi-card-checklist"></i> -->
                        <h3><a href="">Sản phẩm chất lượng</a></h3>
                        <p>
                            Tại Petshop, chúng tôi tự hào cung cấp những sản phẩm chất lượng cao cho cún cưng và mèo
                            cưng của bạn. Chúng tôi đảm bảo rằng tất cả các sản phẩm của chúng tôi đều được chọn lọc
                            kỹ càng để đảm bảo đáp ứng nhu cầu dinh dưỡng, giải trí và làm đẹp tốt nhất cho thú cưng
                            của bạn.</p>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <i class="bi bi-truck"></i>
                        <!-- <i class="bi bi-bar-chart"></i> -->
                        <h3><a href="">Giao hàng tốc độ</a></h3>
                        <p>
                            Tốc độ giao hàng là ưu tiên hàng đầu của chúng tôi tại Petshop. Chúng tôi cam kết cung
                            cấp dịch vụ giao hàng nhanh chóng để bạn nhận được sản phẩm cho thú cưng của mình trong
                            thời gian ngắn nhất có thể. Chúng tôi hiểu rằng thú cưng là thành viên quan trọng trong
                            gia đình, vì vậy chúng tôi luôn nỗ lực để đảm bảo sự hài lòng và tiện lợi cho khách hàng
                            của chúng tôi.</p>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box">
                        <i class="bi bi-chat-dots"></i>
                        <!-- <i class="bi bi-binoculars"></i> -->
                        <h3><a href="">Phản hồi thân thiện</a></h3>
                        <p>
                            Tại Petshop, chúng tôi luôn sẵn sàng đáp ứng và giúp đỡ khách hàng với tinh thần tận tâm
                            và thân thiện. Chúng tôi lắng nghe và hiểu những nhu cầu của khách hàng, và sẵn lòng
                            cung cấp sự hỗ trợ và giải đáp mọi câu hỏi một cách chu đáo và nhanh chóng. Sự hài lòng
                            của khách hàng là ưu tiên hàng đầu của chúng tôi và chúng tôi cam kết mang đến sự phục
                            vụ tốt nhất cho từng khách hàng đến với Petshop.</p>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Featured Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">

                    <!-- VIDEO START-->
                    <img src="gifmeo_video.gif" alt="" width="100%" height="auto">
                    <!-- <iframe width="100%" height="500"  src="videomeo.mp4">
            </iframe> -->

                    <!-- VIDEO END -->



                </div>

            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                    <div class="icon-box">
                        <img src="Picture/Chim_Canh/chimcanh.jpg" alt="">

                        <!-- <div class="icon" ><i class="bx bxl-dribbble"></i></div> -->
                        <h4><a href="{{ route('blogchim.view') }}">Chim cảnh</a></h4>
                        <p>Tại PetShop, chúng tôi sẽ giới thiệu một số loài chim cảnh phổ biến và được yêu thích.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                    <div class="icon-box">
                        <img src="Picture/Hamster/chuotcanh.jpg" alt="">
                        <!-- <div class="icon"><i class="bx bx-file"></i></div> -->
                        <h4><a href="{{ route('blogchuot.view') }}">Chuột cảnh</a></h4>
                        <p>Những chú chuột dễ thương là một trong những lựa chọn để yêu thương và nuôi dưỡng của
                            người muốn có một bé cưng nhỏ nhắn.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                    <div class="icon-box">
                        <img src="Picture/Ca_Canh/cacanh.jpg" alt="">
                        <!-- <div class="icon"><i class="bx bx-tachometer"></i></div> -->
                        <h4><a href="{{ route('blogca.view') }}">Cá cảnh</a></h4>
                        <p>Ngắm nhìn những bé cá bơi lượn trong nước cũng là một cách thư giãn.</p>
                    </div>
                </div>
                <div class="videochim">
                    <div class="col-lg-12">

                        <!-- VIDEO START-->
                        <img src="gifca_video.gif" alt="" width="100%" height="auto">
                        <!-- <iframe width="100%" height="500"  src="videoca.mp4">
                </iframe> -->

                        <!-- VIDEO END -->



                    </div>
                </div>




            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
        <div class="container">

            <div class="section-title">
                <h2><i class="bi bi-chat-heart-fill"></i>&nbsp;Theo Dõi Chúng Tôi</h2>
                <p>Tại Petshop, chúng tôi luôn sẵn lòng hỗ trợ khách hàng bằng nhiều phương thức khác nhau. Bạn có
                    thể theo dõi và liên hệ với chúng tôi qua điện thoại, Email, Facebook, Twitter, Instagram,
                    Tiktok hoặc trên Youtube của PetShop. Chúng tôi cũng cung cấp dịch vụ tư vấn chuyên nghiệp để
                    giúp bạn chăm sóc và lựa chọn sản phẩm phù hợp cho thú cưng của bạn. Chúng tôi luôn sẵn lòng
                    đồng hành và giúp đỡ bạn trong mọi vấn đề liên quan đến thú cưng yêu quý của bạn. <i
                        class="bi bi-suit-heart"></i></p>
            </div>

            <div class="clients-slider swiper">
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide"><a href=""><img src="Picture/MXH/emailpng.png" class="img-fluid"
                                alt=""></a></div>
                    <div class="swiper-slide"><a href=""><img src="Picture/MXH/face.png" class="img-fluid" alt=""></a>
                    </div>
                    <div class="swiper-slide"><a href=""><img src="Picture/MXH/Ins.webp" class="img-fluid" alt=""></a>
                    </div>
                    <div class="swiper-slide"><a href=""><img src="Picture/MXH/Titok.png" class="img-fluid" alt=""></a>
                    </div>
                    <div class="swiper-slide"><a href=""><img src="Picture/MXH/yt.jpg" class="img-fluid" alt=""></a>
                    </div>
                    <div class="swiper-slide"><a href=""><img src="Picture/MXH/twitter.jpg" class="img-fluid"
                                alt=""></a></div>
                    <div class="swiper-slide"><a href=""><img src="Picture/MXH/zalo.png" class="img-fluid" alt=""></a>
                    </div>
                    <div class="swiper-slide"><a href="tel:0867942231"><img src="Picture/MXH/phone.png"
                                class="img-fluid" alt=""></a></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Clients Section -->

</main><!-- End #main -->

@endsection

@section('custom_js')
@endsection