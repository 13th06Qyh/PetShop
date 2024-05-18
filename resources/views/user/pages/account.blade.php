<!-- Lấy phần header, footer, css -->
@extends('user.layout.main')

<!-- Tên trang -->
@section('title')
<title>Tài khoản</title>
@endsection

<!-- Nội dung của trang, phần thân -->
@section('main')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs" style="background-color: #F1E8E2">
        <div class="container">
            <ol>
                <li><a href="{{ route('user.view') }}"><i class="bi bi-house-door-fill"></i>&nbsp;Trang chủ</a></li>
            </ol>
            <h2>Thông tin tài khoản</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <section style="background-image: url('Picture/acount.png'); background-size: 100%">
        <div class="container py-5">

            <div class="row">
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="Picture/user.png" alt="avatar" class="rounded-circle img-fluid"
                                style="width: 150px;">
                            <h5 class="my-3"><b>Hello</b> <b
                                    style="color: #e56;">{{auth()->user()->username}}</b><b>!</b>
                            </h5>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-outline-primary ms-1"><a
                                        href="{{ route('changepass.view') }}">Đổi
                                        mật khẩu</a>
                                </button>
                                <button type="button" class="btn btn-outline-secondary ms-1">
                                    <a href="{{ route('editprofile.view') }}">Sửa thông tin</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0"><b>Tài khoản: </b></p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><i>{{auth()->user()->username}}</i></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0"><b>Email:</b></p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><i>{{auth()->user()->email}}</i></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0"><b>SĐT:</b></p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><i>0{{auth()->user()->sdt}}</i></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0"><b>Mật khẩu:</b></p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><i>********</i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
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