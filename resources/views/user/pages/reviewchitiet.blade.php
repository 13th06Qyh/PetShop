<!-- Lấy phần header, footer, css -->
@extends('user.layout.main')

<!-- Tên trang -->
@section('title')
<title>{{ $blogIF->title }}</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endsection

<!-- Nội dung của trang, phần thân -->
@section('main')
<style>
/* .binhluan-container {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
} */

.show-more {
    cursor: pointer;
    color: blue;
}

.open-modal-btn i:hover {
    color: red;
}
</style>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ route('user.view') }}"><i class="bi bi-house-door-fill"></i>&nbsp;Trang chủ</a></li>
                <li><a href="javascript:history.back()">Trang trước</a></li>
            </ol>
            <h2>{{ $blogIF->title }}</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">

                    <article class="entry entry-single">

                        <div class="entry-img">
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper" style="padding-top: 0px; max-height: 400px">
                                    @if (isset($blogIF->ImageBlog) && count($blogIF->ImageBlog) > 0)
                                    @foreach ($blogIF->ImageBlog as $image)
                                    @php
                                    $imagePath = explode('|', $image->image);
                                    @endphp
                                    <div class="swiper-slide">
                                        <!-- <div class="entry-img"> -->
                                        <img src="{{ asset($imagePath[0]) }}" style="width: 100%" alt="Image"
                                            class="img-fluid">
                                        <!-- </div> -->
                                    </div>

                                    @endforeach
                                    @endif
                                    <!-- <img src="Picture/BlogCho/3.jpg" alt="" class="img-fluid"> -->
                                </div>

                                <div class="swiper-pagination"></div>
                            </div>
                        </div>

                        <h2 class="entry-title">
                            <a href="">{{ $blogIF->title }}</a>
                        </h2>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <time
                                        datetime="{{ $blogIF->created_at->format('d-m-Y H:i:s') }}">{{ $blogIF->created_at->format('d-m-Y H:i:s') }}</time>
                                </li>
                                <li class="d-flex align-items-center"><i
                                        class="bi bi-chat-dots"></i>{{ count($comments) }} Bình luận</li>
                            </ul>
                        </div>

                        <div class="entry-content">
                            {!! $blogIF->noidung !!}
                        </div>

                        <div class="entry-footer">
                            <i class="bi bi-globe-americas"></i>
                            <ul class="cats">
                                <li><a href="{{ route('user.view') }}">PetShop</a></li>
                            </ul>

                            <i class="bi bi-tags"></i>
                            <ul class="tags">
                                <li><a href="javascript:history.back()">{{ $blogIF->animal->animalname }}</a></li>
                            </ul>
                        </div>

                    </article><!-- End blog entry -->



                    <div class="blog-comments">

                        <h4 class="comments-count">{{ count($comments) }} Bình luận</h4>

                        <div class="reply-form">
                            <h4>Đăng bình luận</h4>
                            @if (!auth()->check())
                            <p>*<a href="{{ route('login.view') }}">Đăng nhập</a>/<a
                                    href="{{ route('sigin.view') }}">Đăng kí</a> để bình luận bài
                                viết.</p>
                            @else
                            <br>
                            @endif
                            <form action="{{ route('comment.view', ['id' => $blogIF->maBlog]) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col form-group">
                                        <textarea name="comment" class="form-control" placeholder="Viết bình luận ở đây"
                                            required></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Đăng</button>

                            </form>

                        </div>

                        <div id="comment-2" class="comment">

                            @if(count($commentD) > 0)
                            @foreach ($commentD as $comment)
                            <div class="d-flex">
                                <div class="comment-img"><img src="{{ asset('Picture/logo.png') }}" alt=""></div>
                                <div>
                                    <h5>
                                        <a href="">{{ $comment->User->username }}</a>&nbsp;
                                        @if (auth()->check())
                                        @if ($comment->User->id == auth()->user()->id || auth()->user()->role ==
                                        'admin')
                                        <button value="{{ $comment->maBL }}" class="open1"
                                            data-target="#ModalDE_{{ $comment->maBL }}" type="button" title="Xóa"
                                            data-toggle="modal"
                                            style="background-color: #fff; border: none;font-size: 11px;"><i
                                                class="bi bi-trash-fill" style="font-size: 1.1em;"></i>
                                        </button>
                                        @endif
                                        @if ($comment->User->id == auth()->user()->id)
                                        <button value="{{ $comment->maBL }}" class="open2"
                                            data-target="#ModalDU_{{ $comment->maBL }}" type="button" title="Sửa"
                                            data-toggle="modal"
                                            style="background-color: #fff; border: none;font-size: 11px;"><i
                                                class="bi bi-pencil-fill" style="font-size: 1.1em;"></i>
                                        </button>
                                        @endif
                                        @endif

                                    </h5>
                                    <time datetime="{{ $comment->created_at->format('d-m-Y') }}">
                                        {{ $comment->created_at->format('d-m-Y') }}
                                    </time>
                                    <div class="binhluan-container" id="binhluan_{{ $comment->maBL }}">
                                        {{ $comment->noidungbl }}
                                    </div>
                                    <!-- <i class="show-more" onclick="showMore('binhluan_{{ $comment->maBL }}')">More</i> -->



                                </div>
                            </div>
                            <br>
                            @endforeach
                            <div>{{ $commentD->links() }}</div>
                            @else
                            <center style="padding-top: 0px; color: gray; font-size: 17px;">
                                <i>Chưa có bình luận.</i>
                                <br>
                            </center>
                            @endif

                        </div><!-- End comment #2-->

                    </div><!-- End blog comments -->

                </div><!-- End blog entries list -->

                <div class="col-lg-4">

                    <div class="sidebar">

                        <h3 class="sidebar-title">Chủ đề</h3>
                        <div class="sidebar-item categories">
                            <ul>
                                <li><a href="{{ route('blogmeo.view') }}">Mèo
                                        Cưng<span>({{ count($all->where('idanimal', '2')) }})</span></a></li>
                                <li><a href="{{ route('blogcho.view') }}">Cún
                                        Cưng<span>({{ count($all->where('idanimal', '1')) }})</span></a></li>
                                <li><a href="{{ route('blogchim.view') }}">Chim
                                        Cảnh<span>({{ count($all->where('idanimal', '3')) }})</span></a></li>
                                <li><a href="{{ route('blogchuot.view') }}">Chuột
                                        Cảnh<span>({{ count($all->where('idanimal', '4')) }})</span></a></li>
                                <li><a href="{{ route('blogca.view') }}">Cá
                                        Cảnh<span>({{ count($all->where('idanimal', '5')) }})</span></a></li>
                            </ul>
                        </div><!-- End sidebar categories-->

                        <h3 class="sidebar-title">Gần đây</h3>
                        <div class="sidebar-item recent-posts">
                            @foreach ($blogW as $blog)
                            <div class="post-item clearfix">
                                @if(isset($blog->ImageBlog[0]))
                                @php
                                $firstImage = explode('|', $blog->ImageBlog[0]->image);
                                @endphp
                                <!-- <img src="{{ asset($firstImage[0]) }}" alt="..."> -->
                                <a href="{{ route('reviewchitiet.view', ['id' => $blog->maBlog]) }}"><img
                                        src="{{ asset($firstImage[0]) }}" alt="Image"></a>
                                @endif
                                <!-- <img src="Picture/BlogCho/3.jpg" alt=""> -->
                                <h4><a
                                        href="{{ route('reviewchitiet.view', ['id' => $blog->maBlog]) }}">{{ $blog->title }}</a>
                                </h4>
                                <time
                                    datetime="{{ $blog->created_at->format('d-m-Y H:i:s') }}">{{ $blog->created_at->format('d-m-Y H:i:s') }}</time>
                            </div>
                            @endforeach




                        </div><!-- End sidebar recent posts-->

                        <h3 class="sidebar-title">Tags</h3>
                        <div class="sidebar-item tags">
                            <ul>
                                <li><a href="{{ route('blogmeo.view') }}">Mèo</a></li>
                                <li><a href="{{ route('blogcho.view') }}">Cún</a></li>
                                <li><a href="{{ route('blogchim.view') }}">Chim</a></li>
                                <li><a href="{{ route('blogchuot.view') }}">Chuột</a></li>
                                <li><a href="{{ route('blogca.view') }}">Cá</a></li>
                            </ul>
                        </div><!-- End sidebar tags-->

                    </div><!-- End sidebar -->

                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section><!-- End Blog Single Section -->

</main><!-- End #main -->
<!-- MODAL -->
@foreach ($commentD as $comment)
@if (auth()->check())
@if ($comment->User->id == (auth()->user()->id || auth()->user()->role =='admin'))
<div class="modal fade" id="ModalDE_{{ $comment->maBL }}" tabindex="-1" role="dialog" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('delete.comment.view', ['id' => $comment->maBL]) }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="thong-tin-thanh-toan">
                                <!-- <h6></h6> -->
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <br>
                        <center>
                            <h4><b>Bạn chắc chắn muốn xóa bình luận?<b></h4>
                        </center>
                    </div>
                    <div class="row">

                        <br>
                        <hr>
                        <center><button class="btn btn-save" type="submit" style="background-color: #FFA07A;">Xác
                                nhận</button>
                            <a class="btn btn-cancel" data-dismiss="modal"
                                href="{{ route('reviewchitiet.view', ['id' => $comment->idblog]) }}"
                                style="background-color: grey;">Hủy</a>
                        </center>
                    </div>


                </div>
            </form>
            <!-- <div class="modal-footer"></div> -->
        </div>
    </div>
</div>
@endif
@endif
@endforeach

<!-- END MODAL -->

<!-- MODAL -->
@foreach ($commentD as $comment)
@if (auth()->check())
@if ($comment->User->id == auth()->user()->id)
<div class="modal fade" id="ModalDU_{{ $comment->maBL }}" tabindex="-1" role="dialog" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('update.comment.view', ['id' => $comment->maBL]) }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <span class="thong-tin-thanh-toan">
                                <center>
                                    <h5><b>Sửa bình luận<b></h5>
                                </center>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="control-label"><i>Nội dung bình luận</i></label>
                            <textarea name="commentt" class="form-control" rows="5" id="commentt"
                                required>{{ old('commentt', $comment->noidungbl) }}</textarea>
                        </div>


                    </div>
                    <div class="row">
                        <center>
                            <button class="btn btn-save" type="submit" style="background-color: #FFA07A;">Cập
                                nhật</button>
                            <a class="btn btn-cancel" data-dismiss="modal"
                                href="{{route('reviewchitiet.view', ['id' => $comment->idblog])}}"
                                style="background-color: grey;">Hủy bỏ</a>
                            <BR>
                        </center>
                    </div>
            </form>
            <!-- <div class="modal-footer"></div> -->
        </div>
    </div>
</div>
@endif
@endif
@endforeach
<!-- END MODAL -->






@endsection

<!-- Cái phần bố sung sau footer (có thể có hoặc không) -->
@section('custom_js')

<script>
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 0, // hoặc giá trị bạn muốn
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
});
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function() {
    $(".open1").click(function() {
        var targetModal = $(this).attr("data-target");
        $(targetModal).modal("show");
        console.log(targetModal);
    });
});
$(document).ready(function() {
    $(".open2").click(function() {
        var targetModal = $(this).attr("data-target");
        $(targetModal).modal("show");
        console.log(targetModal);
    });
});
</script>


@endsection