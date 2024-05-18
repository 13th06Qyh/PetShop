<!-- Lấy phần header, footer, css -->
@extends('user.layout.main')

<!-- Tên trang -->
@section('title')
<title>Liên hệ</title>
@endsection

<!-- Nội dung của trang, phần thân -->
@section('main')
<style>
.contact .lienhe {
    box-shadow: 0 0 30px rgba(214, 215, 216, 0.6);
    padding: 30px;
}

.contact .lienhe button[type="submit"] {
    background: #e96b56;
    border: 0;
    border-radius: 50px;
    padding: 10px 24px;
    color: #fff;
    transition: 0.4s;
}

.contact .lienhe button[type="submit"]:hover {
    background: #e6573f;
}
</style>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{route('user.view')}}"><i class="bi bi-house-door-fill"></i>&nbsp;Trang chủ</a></li>
            </ol>
            <h2>Liên hệ</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <div class="info-box mb-4">
                        <i class="bx bx-map"></i>
                        <h3>Địa chỉ</h3>
                        <p>Khu đô thị Đại học Đà Nẵng, 470 Đường Trần Đại Nghĩa, phường Hòa Quý, quận Ngũ Hành Sơn, Đà
                            Nẵng</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-box  mb-4">
                        <i class="bx bx-envelope"></i>
                        <h3>Email</h3>
                        <p>quynhpn.22it@vku.udn.vn <br>
                            thuna.22it@vku.dn.vn</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="info-box  mb-4">
                        <i class="bx bx-phone-call"></i>
                        <h3>Điện thoại</h3>
                        <p>0147.8.443.677 <br> 2354.7778.567</p>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-lg-6 ">
                    <iframe class="mb-4 mb-lg-0"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.733298307637!2d108.24748407466467!3d15.9752982024988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5nIFZp4buHdCAtIEjDoG4!5e0!3m2!1svi!2s!4v1687320475890!5m2!1svi!2s"
                        frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
                </div>

                <div class="col-lg-6">
                    <form action="" method="POST" class="lienhe">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="*Họ và tên"
                                    required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" name="email" class="form-control" id="email" placeholder="*Email"
                                    required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Chủ đề"
                                required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="5" placeholder="Viết tin nhắn ở đây"
                                required></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <br>
                            <center>
                                <button type="submit">Gửi</button>
                            </center>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

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