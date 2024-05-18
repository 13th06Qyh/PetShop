<!-- Lấy phần header, footer, css -->
@extends('admin.layout.bara')

<!-- Tên trang -->
@section('title')
<title>Quản lý bài viết</title>
<!-- Font-icon css-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
<!-- or -->
<link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
<!-- Script cho việc xem trước ảnh -->
<script>
const inpFile = document.getElementById("uploadfile");
const thumbbox = document.getElementById("thumbbox");

inpFile.addEventListener("change", function() {
    readURL(this, thumbbox);
});
</script>

<script>
function readURL(input, thumbimage) {
    // Xóa hết các ảnh đã chọn trước đó
    // Xóa hết các ảnh đã chọn trước đó
    $("#thumbbox").empty();
    if (input.files && input.files.length > 0) {
        for (let i = 0; i < input.files.length; i++) {
            const reader = new FileReader();
            // save file data in reader as binary data to input id dataImage[]

            reader.onload = function(e) {
                document.getElementById('dataImage').value = e.target.result;
                // Tạo thẻ img và đặt src là ảnh đã chọn

                const imgElement = document.createElement("img");
                imgElement.src = e.target.result;

                // Thêm img vào div thumbbox để hiển thị
                $("#thumbbox").append(imgElement);
            }

            // Đọc từng file trong danh sách
            reader.readAsDataURL(input.files[i]);
        }

        // Hiển thị div thumbbox
        $("#thumbbox").show();
    } else {
        // Nếu không có ảnh nào được chọn, ẩn div thumbbox
        $("#thumbbox").hide();
    }
}
$(document).ready(function() {
    $(".Choicefile").bind('click', function() {
        $("#uploadfile").click();

    });
    $(".removeimg").click(function() {
        $("#thumbimage").attr('src', '').hide();
        $("#myfileupload").html(
            '<input type="file" id="uploadfile"  onchange="readURL(this);" multiple />');
        $(".removeimg").hide();
        $(".Choicefile").bind('click', function() {
            $("#uploadfile").click();
        });
        $('.Choicefile').css('background', '#14142B');
        $('.Choicefile').css('cursor', 'pointer');
        $(".filename").text("");
    });
})
</script>
@endsection

<!-- Nội dung của trang, phần thân -->
@section('main')
<style>
.Choicefile {
    display: block;
    background: #14142B;
    border: 1px solid #fff;
    color: #fff;
    width: 150px;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    padding: 5px 0px;
    border-radius: 5px;
    font-weight: 500;
    align-items: center;
    justify-content: center;
}

.Choicefile:hover {
    text-decoration: none;
    color: white;
}

#uploadfile,
.removeimg {
    display: none;
}

/* #thumbbox {
    position: relative;
    width: 100%;
    margin-bottom: 20px;
} */




.removeimg {
    height: 25px;
    position: absolute;
    background-repeat: no-repeat;
    top: 5px;
    left: 5px;
    background-size: 25px;
    width: 25px;
    /* border: 3px solid red; */
    border-radius: 50%;

}

.removeimg::before {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    content: '';
    border: 1px solid red;
    background: red;
    text-align: center;
    display: block;
    margin-top: 11px;
    transform: rotate(45deg);
}

.removeimg::after {
    /* color: #FFF; */
    /* background-color: #DC403B; */
    content: '';
    background: red;
    border: 1px solid red;
    text-align: center;
    display: block;
    transform: rotate(-45deg);
    margin-top: -2px;
}

/* CSS thẻ bao đoạn text cần ẩn */
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
<!-- Page Content -->
<div style="margin-left: 250px">
    <main class="">
        <div class="row-cols-1">
            <div class="tile">
                <div class="tile-body">
                    <div class="row element-button">
                        <center>
                            <h3>Quản Lý Bài Viết</h3>
                        </center>
                        <div class="col-sm-2">

                            <a class="btn btn-add btn-sm" href="{{ route('admin.add.blog') }}" title="Thêm"><i
                                    class="fas fa-plus"></i>
                                Thêm mới bài viết</a>
                        </div>

                    </div>


                    <table class="table table-hover table-bordered js-copytextarea" cellpadding="0" cellspacing="0"
                        border="0" id="sampleTable" enctype="multipart/form-data">
                        <thead>
                            <tr>

                                <th width="20">ID</th>
                                <th width="100">Tiêu đề</th>
                                <th width="90">Ảnh</th>
                                <th width="200">Nội dung</th>
                                <th width="70">Vật nuôi</th>
                                <th width="60">Bình luận</th>
                                <th width="60">Tính năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $blog)

                            <tr>

                                <td>{{ $blog->maBlog }}</td>
                                <td>{{ $blog->title }}</td>
                                <td style="text-align: center;">
                                    @if(isset($blog->ImageBlog[0]))
                                    @php
                                    $firstImage = explode('|', $blog->ImageBlog[0]->image);
                                    @endphp
                                    <img src="{{ asset($firstImage[0]) }}" alt="" width="100px">
                                    @endif

                                </td>
                                <td>
                                    <div class="an">
                                        {{ html_entity_decode(strip_tags($blog->noidung)) }}
                                    </div>
                                </td>
                                <td style="text-align: center;">{{ $blog->animal->animalname }}</td>
                                <td>
                                    <center>
                                        <a class="" style="color: blue"
                                            href="{{ route('admin.detail.comment', ['id' => $blog->maBlog]) }}"
                                            title="Xem"><i>Xem</i></a>
                                        {{ count($blog->Comment) }} bình luận
                                    </center>
                                </td>
                                <td class="table-td-center">
                                    <center><button value="{{ $blog->maBlog }}" class="btn btn-primary btn-sm trash"
                                            type="button" title="Xóa" data-toggle="modal"
                                            data-target="#ModalDE_{{ $blog->maBlog }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <a href="{{ route('admin.edit.blog', ['id' => $blog->maBlog]) }}">
                                            <button data-id="{{ $blog->maBlog }}" class="btn btn-primary btn-sm edit"
                                                type="button" title="Sửa" id="show-emp" data-toggle="modal"
                                                data-target="#ModalUP">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                    </center>
                                </td>
                                @endforeach




                        </tbody>
                    </table>


                </div>
            </div>

        </div>
    </main>

    <!-- MODAL -->
    @foreach ($blogs as $blog)
    <div class="modal fade" id="ModalDE_{{ $blog->maBlog }}" tabindex="-1" role="dialog" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.delete.blog', $blog->maBlog) }}">
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
                                <h4>Bạn chắc chắn muốn xóa bài viết này?</h4>
                            </center>
                        </div>
                        <div class="row">

                            <br>
                            <center><button class="btn btn-save" type="submit">Đồng ý</button>
                                <a class="btn btn-cancel" data-dismiss="modal" href="{{ route('admin.blog') }}">Hủy
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
<script>
const inpFile = document.getElementById("inpFile");
const loadFile = document.getElementById("loadFile");
const previewContainer = document.getElementById("imagePreview");
const previewContainer = document.getElementById("imagePreview");
const previewImage = previewContainer.querySelector(".image-preview__image");
const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");
inpFile.addEventListener("change", function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        previewDefaultText.style.display = "none";
        previewImage.style.display = "block";
        reader.addEventListener("load", function() {
            previewImage.setAttribute("src", this.result);
        });
        reader.readAsDataURL(file);
    }
});
</script>

@endsection