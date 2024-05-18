<!-- Lấy phần header, footer, css -->
@extends('user.layout.main')

<!-- Tên trang -->
@section('title')
<title>Shop quần áo chó</title>
@endsection
@section('find')
<form action="{{ route('searchQAC.view') }}" method="GET">
    <input placeholder="&nbsp; Tìm kiếm quần áo của cún tại đây" type="search" class="input" name="search">
    <button type="submit"><i class="bi bi-search"></i></button>
</form>

<!-- <input name="search" placeholder="&nbsp; Tìm kiếm thức ăn của cún tại đây" type="search" class="input"> -->
@endsection
<!-- Nội dung của trang, phần thân -->
@section('main')
<main id="main">


    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ route('user.view') }}"><i class="bi bi-house-door-fill"></i>&nbsp;Trang chủ</a></li>
                <li><a href="{{ route('shopchoqa.view') }}">Shop Cún Quần Áo</a></li>
            </ol>
            <center>
                <h2>Quần Áo Của Chó Cưng</h2>
            </center>

        </div>
    </section><!-- End Breadcrumbs -->



    <section class="property-grid grid">
        <div class="container">

            <div style="padding-top: 50px;" class="content-name">
                <h1 style="text-align: center;">SẢN PHẨM MỚI NHẤT</h1>
            </div>

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($sanphamW as $sanpham)
                    <div class="swiper-slide">
                        @if (isset($sanpham->ImageSP[0]))
                        @php
                        $firstImage = explode('|', $sanpham->ImageSP[0]->image);
                        @endphp
                        <a href="{{ route('infosp.view', ['id' => $sanpham->maSP]) }}"><img
                                src="{{ asset($firstImage[0]) }}" alt="Image"></a>

                        @endif
                    </div>
                    @endforeach
                </div>

                <div class="swiper-pagination"></div>
            </div>




            <!-- <div style="padding-top: 50px;" class="content-name">
              </div> -->
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-app" data-tag="Quần Áo">Quần áo</li>
                        <li data-filter=".filter-card">Nón</li>
                        <li data-filter=".filter-web">Phụ kiện</li>
                    </ul>
                </div>
            </div>
            @if(count($sanphams) > 0)
            <div class="row portfolio-container">

                <!-- Code to display sanphams goes here -->



                @foreach ($sanphams as $sanpham)
                <!-- <div class="card-full"> -->

                @if ($sanpham->Tag->tagname == 'Quần áo')
                <div class="col-md-4 portfolio-item filter-app">
                    <div class="card-full">
                        <div class="card">
                            <div class="anhvamuangay">
                                <a href="{{ route('infosp.view', ['id' => $sanpham->maSP]) }}">
                                    @if(isset($sanpham->ImageSP[0]))
                                    @php
                                    $firstImage = explode('|', $sanpham->ImageSP[0]->image);
                                    @endphp
                                    <img src="{{ asset($firstImage[0]) }}" class="card-img-top" alt="...">
                                    @endif
                                    <!-- <img src=" {{asset('Picture/DoanCho/1.jpg')}}" class="card-img-top" alt="..."> -->
                                </a>
                                <a href="{{ route('infosp.view', ['id' => $sanpham->maSP]) }}" class="buy_now">Xem chi
                                    tiết</a>
                            </div>

                            <div class="card-body">
                                <a href="" class="product-cat">{{ $sanpham->Tag->tagname }}</a>
                                <h5 class="card-title">{{ $sanpham->tensp }}</h5>
                                <p class="card-text">{{ $sanpham->buyprice }}</p>
                            </div>
                        </div>
                    </div>

                </div>
                @elseif ($sanpham->Tag->tagname == 'Nón')
                <div class="col-md-4 portfolio-item filter-card">
                    <div class="card-full">
                        <div class="card">
                            <div class="anhvamuangay">
                                <a href="{{ route('infosp.view', ['id' => $sanpham->maSP]) }}">
                                    @if(isset($sanpham->ImageSP[0]))
                                    @php
                                    $firstImage = explode('|', $sanpham->ImageSP[0]->image);
                                    @endphp
                                    <img src="{{ asset($firstImage[0]) }}" class="card-img-top" alt="...">
                                    @endif
                                    <!-- <img src=" {{asset('Picture/DoanCho/1.jpg')}}" class="card-img-top" alt="..."> -->
                                </a>
                                <a href="{{ route('infosp.view', ['id' => $sanpham->maSP]) }}" class="buy_now">Xem chi
                                    tiết</a>
                            </div>

                            <div class="card-body">
                                <a href="" class="product-cat">{{ $sanpham->Tag->tagname }}</a>
                                <h5 class="card-title">{{ $sanpham->tensp }}</h5>
                                <p class="card-text">{{ $sanpham->buyprice }}</p>
                            </div>
                        </div>
                    </div>

                </div>
                @else
                <div class="col-md-4 portfolio-item filter-web">
                    <div class="card-full">
                        <div class="card">
                            <div class="anhvamuangay">
                                <a href="{{ route('infosp.view', ['id' => $sanpham->maSP]) }}">
                                    @if(isset($sanpham->ImageSP[0]))
                                    @php
                                    $firstImage = explode('|', $sanpham->ImageSP[0]->image);
                                    @endphp
                                    <img src="{{ asset($firstImage[0]) }}" class="card-img-top" alt="...">
                                    @endif
                                    <!-- <img src=" {{asset('Picture/DoanCho/1.jpg')}}" class="card-img-top" alt="..."> -->
                                </a>
                                <a href="{{ route('infosp.view', ['id' => $sanpham->maSP]) }}" class="buy_now">Xem chi
                                    tiết</a>
                            </div>

                            <div class="card-body">
                                <a href="" class="product-cat">{{ $sanpham->Tag->tagname }}</a>
                                <h5 class="card-title">{{ $sanpham->tensp }}</h5>
                                <p class="card-text">{{ $sanpham->buyprice }}</p>
                            </div>
                        </div>
                    </div>

                </div>
                @endif


                @endforeach


            </div>
            <div>{{ $sanphams->links() }}</div>
            @else
            <center style="padding-top: 50px; color: gray;">
                <h4><i>Không tìm thấy sản phẩm nào!</i></h4>
            </center>
            @endif

        </div>
    </section>



</main><!-- End #main -->
@endsection

<!-- Cái phần bố sung sau footer (có thể có hoặc không) -->
@section('custom_js')
<script>
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});
</script>
@endsection