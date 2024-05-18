 <!-- Lấy phần header, footer, css -->
 @extends('user.layout.main')

 <!-- Tên trang -->
 @section('title')
 <title>Chi tiết mặt hàng {{ $sanphamIF->tensp }}</title>
 @endsection

 <!-- Nội dung của trang, phần thân -->
 @section('main')
 <main id="main">

     <!-- ======= Breadcrumbs ======= -->
     <section id="breadcrumbs" class="breadcrumbs">
         <div class="container">

             <ol>
                 <li><a href="{{ route('user.view') }}"><i class="bi bi-house-door-fill"></i>&nbsp;Trang chủ</a></li>
                 <li><a href="javascript:history.back()">Trang trước</a></li>
             </ol>
             <h2>{{ $sanphamIF->tensp }}</h2>

         </div>
     </section><!-- End Breadcrumbs -->

     <!-- ======= Portfolio Details Section ======= -->
     <section id="portfolio-details" class="portfolio-details">
         <div class="container">

             <div class="row gy-4">

                 <div class="col-lg-8">

                     <div class="portfolio-details-slider swiper">
                         <div class="swiper-wrapper align-items-center">
                             @if (isset($sanphamIF->ImageSP) && count($sanphamIF->ImageSP) > 0)
                             @foreach ($sanphamIF->ImageSP as $image)
                             @php
                             $imagePath = explode('|', $image->image);
                             @endphp
                             <div class="swiper-slide">
                                 <div class="portfolio-wrap">
                                     <img src="{{ asset($imagePath[0]) }}" alt="Image">
                                     <div class="portfolio-info">
                                         <div class="portfolio-links">
                                             <a href="{{ asset($imagePath[0]) }}" data-gallery="portfolioGallery"
                                                 class="portfolio-lightbox" title=""><i class="bx bx-plus"></i></a>

                                         </div>
                                     </div>

                                 </div>
                             </div>

                             @endforeach
                             @endif
                         </div>
                         <div class="swiper-pagination"></div>
                     </div>
                 </div>

                 <div class="col-lg-4">
                     <div class="portfolio-info">
                         <h3>Thông Tin Cơ Bản</h3>
                         <ul>
                             <li><strong>Tên sản phẩm</strong>: {{ $sanphamIF->tensp }}</li>
                             <li><strong>Chất liệu</strong>: {{ $sanphamIF->Tag->tagname }}</li>
                             <li><strong>Kho</strong>: {{ $sanphamIF->soluongkho }}</li>
                             <li><strong>Giá bán</strong>: {{ $sanphamIF->buyprice }} VNĐ</li>
                             <li><strong>Nguồn hàng</strong>: {{ $sanphamIF->Provide->proname }}</li>
                             <li>
                                 @if (auth()->check())
                                 @if (auth()->user()->role == 'user')
                                 <a href="{{ route('addsptocart.view', ['id' => $sanphamIF->maSP]) }}"><input
                                         type="submit" value="Thêm vào giỏ hàng" class="form-submit"></a>
                                 @endif
                                 @else
                                 <a href="{{ route('login.view') }}"><input type="submit" value="Thêm vào giỏ hàng"
                                         class="form-submit"></a>
                                 @endif

                             </li>
                         </ul>
                     </div>
                     <div class="form-outline mb-4">
                         @if (session('error'))
                         <div class="alert alert-danger" style="color: red; text-align: right">
                             <i><small>{{ session('error') }}</small></i>
                         </div>
                         @endif
                     </div>
                 </div>
                 <div class="portfolio-description">
                     <h2>Tổng quan</h2>
                     <p>
                         {{ $sanphamIF->mota }}<br><br>
                     </p>
                 </div>

             </div>

         </div>
     </section><!-- End Portfolio Details Section -->

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