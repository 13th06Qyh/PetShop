@extends('admin.layout.bara')

@section('title')
<title>Bình luận bài viết {{ $blogs->title }}</title>
@endsection

@section('main')
<style>
.an {
    display: block;
    display: -webkit-box;
    height: 16px*1.3*3;
    font-size: 16px;
    line-height: 1.3;
    -webkit-line-clamp: 2;
    /* số dòng hiển thị */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-top: 10px;
}
</style>
<div style="margin-left: 250px">
    <main class="">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.blog')}}">Danh sách bài viết</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.detail.comment', ['id' => $blogs->maBlog])}}">Bình
                        luận của {{ $blogs->title }}</a></li>
            </ul>
        </div>
        <div class="row-cols-1">
            <div class="tile">
                <h3 class="tile-title">Bình luận của {{ $blogs->title }}</h3>
                <div class="tile-body">

                    <table class="table table-hover table-bordered js-copytextarea" cellspacing="0" id="sampleTable">
                        <thead>
                            <tr>
                                <th style="text-align: center;" width="20">Mã BL</th>
                                <th style="text-align: center;" width="70">Người bình luận</th>
                                <th style="text-align: center;" width="250">Nội dung</th>
                                <th style="text-align: center;" width="100">Ngày bình luận</th>
                                <th style="text-align: center;" width="60">Tính năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (is_array($commentD) || is_object($commentD))
                            @foreach ($commentD as $commentd)
                            <tr>
                                <td>
                                    <center>{{ $commentd->maBL }}</center>
                                </td>
                                <td>
                                    <center>{{ $commentd->User->username }}</center>
                                </td>
                                <td>
                                    <div class="an">{{ $commentd->noidungbl }}</div>
                                </td>
                                <td>
                                    <center>{{ $commentd->created_at->format('d-m-Y H:i') }}</center>
                                </td>
                                <td class="table-td-center">
                                    <center>
                                        <button value="{{ $commentd->maBL }}" class="btn btn-primary btn-sm trash"
                                            type="button" title="Xóa" data-toggle="modal"
                                            data-target="#ModalDE_{{ $commentd->maBL }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </center>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </main>


    <!-- MODAL -->
    @foreach ($commentD as $commentd)
    <div class="modal fade" id="ModalDE_{{ $commentd->maBL }}" tabindex="-1" role="dialog" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.delete.comment', ['id' => $commentd->maBL]) }}">
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
                                <h4>Bạn chắc chắn muốn xóa bình luận này khỏi bài viết?</h4>
                            </center>
                        </div>
                        <div class="row">

                            <br>
                            <center>
                                <button class="btn btn-save" type="submit">Xác nhận</button>
                                <a class="btn btn-cancel" data-dismiss="modal"
                                    href="{{route('admin.detail.comment', ['id' => $blogs->maBlog])}}">Hủy
                                    bỏ</a>
                            </center>
                        </div>


                    </div>
                </form>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- END MODAL -->
</div>
@endsection

@section('custom_js')

@endsection