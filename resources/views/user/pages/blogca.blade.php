<!-- Lấy phần header, footer, css -->
@extends('user.layout.main')

<!-- Tên trang -->
@section('title')
<title>Review một số loài cá</title>
@endsection

<!-- Nội dung của trang, phần thân -->
@section('main')
<style>
.an {
    display: block;
    display: -webkit-box;
    height: 16px*1.3*3;
    font-size: 16px;
    line-height: 1.3;
    -webkit-line-clamp: 4;
    /* số dòng hiển thị */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-top: 10px;
}
</style>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ route('user.view') }}"><i class="bi bi-house-door-fill"></i>&nbsp;Trang chủ</a></li>
                <li><a href="{{ route('blogca.view') }}">Blog Cá</a></li>
            </ol>
            <h2>Một Số Kiến Thức Về Những Chú Cá </h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">
                @if(count($blogs) > 0)
                <div class="col-lg-8 entries">
                    @foreach ($blogs as $blog)
                    <article class="entry">

                        <div class="entry-img">
                            @if(isset($blog->ImageBlog[0]))
                            @php
                            $firstImage = explode('|', $blog->ImageBlog[0]->image);
                            @endphp
                            <!-- <img src="{{ asset($firstImage[0]) }}" class="img-fluid" alt="..."> -->
                            <a href="{{ route('reviewchitiet.view', ['id' => $blog->maBlog]) }}"><img
                                    src="{{ asset($firstImage[0]) }}" alt="Image" style="width: 100%;"></a>
                            @endif
                            <!-- <img src="Picture/BlogCho/3.jpg" alt="" class="img-fluid"> -->
                        </div>

                        <h2 class="entry-title">
                            <a href="{{ route('reviewchitiet.view', ['id' => $blog->maBlog]) }}">{{ $blog->title }}</a>
                        </h2>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i><time
                                        datetime="{{ $blog->created_at->format('d-m-Y H:i:s') }}">{{ $blog->created_at->format('d-m-Y H:i:s') }}</time>
                                </li>
                                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a
                                        href="{{ route('reviewchitiet.view', ['id' => $blog->maBlog]) }}">{{ count($blog->Comment) }}
                                        Bình
                                        luận</a></li>
                            </ul>
                        </div>

                        <div class="entry-content">
                            <div class="an">
                                <p>
                                    {!! $blog->noidung !!}
                                </p>
                                <br>
                            </div>

                            <div class="read-more">
                                <br>
                                <a href="{{ route('reviewchitiet.view', ['id' => $blog->maBlog]) }}">Chi Tiết</a>
                            </div>
                        </div>

                    </article><!-- End blog entry -->
                    @endforeach



                </div><!-- End blog entries list -->

                <div class="col-lg-4">

                    <div class="sidebar">

                        <h3 class="sidebar-title">Tìm kiếm tại đây</h3>
                        <div class="sidebar-item search-form">
                            <form action="{{ route('searchBCA.view') }}" method="GET">
                                <input style="border: 0" type="search" name="search">
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End sidebar search formn-->

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
            <div>{{ $blogs->links() }}</div>
            @else
            <center style="color: gray;">
                <h4><i>Không tìm thấy bài viết nào!</i></h4>
                <br>
                <br>
            </center>
            @endif
        </div>
    </section><!-- End Blog Section -->

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