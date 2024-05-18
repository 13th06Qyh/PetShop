<!-- Lấy phần header, footer, css -->
@extends('admin.layout.bara')

<!-- Tên trang -->
@section('title')
<title>Thêm mới bài viết</title>
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
<!-- <script>
$(document).ready(function() {
    $(".btn-save").click(function() {
        // Lấy dữ liệu từ các trường input, textarea, select
        var formData = new FormData($('form')[0]);
        // print console log formData
        console.log(formData);

        // Gửi dữ liệu lên server bằng Ajax
        $.ajax({
            url: "{{ route('admin.add.storesanpham') }}",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Xử lý kết quả từ server, ví dụ: hiển thị thông báo
                alert("Sản phẩm đã được thêm thành công!");
                // Chuyển hướng hoặc làm gì đó sau khi thêm sản phẩm thành công
                window.location.href = "{{ route('admin.sanpham') }}";
            },
            error: function(error) {
                // Xử lý lỗi, ví dụ: hiển thị thông báo lỗi
                alert("Đã xảy ra lỗi khi thêm sản phẩm");
                console.error(error);
            }
        });
    });
});
</script> -->

@endsection

<!-- Nội dung của trang, phần thân -->
@section('main')
<!-- Page Content -->



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
</style>

<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.blog')}}">Danh sách bài viết</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.add.blog')}}">Thêm bài viết</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Tạo mới bài viết</h3>
                <div class="tile-body">
                    <form class="row" action="{{route('admin.add.storeblog')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-3">
                            <label class="control-label">Tiêu đề</label>
                            <input name="titleblog" class="form-control" type="text" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">Ảnh bài viết</label>
                            <div id="myfileupload">
                                <input type="file" id="uploadfile" name="imageBlog[]" onchange="readURL(this);"
                                    accept="image/*" multiple required />
                                <input type="hidden" name="dataImage[]" id="dataImage" multiple />
                            </div>
                            <div id="thumbbox">
                                <img alt="Thumb image" id="thumbimage"
                                    style="display: none; height:100px; width:100px" />
                                <a class="removeimg" href="javascript:"></a>
                            </div>
                            <div id="boxchoice">
                                <a href="javascript:" class="Choicefile"><i class="fas fa-cloud-upload-alt"></i>
                                    Chọn ảnh</a>
                                <p style="clear:both"></p>
                            </div>

                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">Nội dung bài viết</label>
                            <textarea style="font-size: 14px; font-family: Open Sans, sans-serif;" name="content"
                                class="form-control" rows="5" id="content" required></textarea>
                            <script>
                            CKEDITOR.replace('content', {
                                removePlugins: 'autogrow',
                                enterMode: CKEDITOR.ENTER_BR
                            });
                            </script>
                        </div>
                        <div class="form-group col-md-3 ">
                            <label for="exampleSelect4" class="control-label">Vật nuôi</label>
                            <select name="animal_id" class="form-control" id="exampleSelect4" required>
                                <option>-- Chọn loại vật nuôi --</option>
                                @foreach ($animals as $animal )
                                <option value="{{$animal->maAnimal}}">{{$animal->animalname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button id="addblog" class="btn btn-save" type="submit">Lưu</button>
                            <a class="btn btn-cancel" href="{{ route('admin.blog') }}">Hủy bỏ</a>
                        </div>

                    </form>

                </div>

            </div>
</main>

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

<script>
$(document).ready(function() {
    $('#addblog').on('click', function() {
        // Kiểm tra xem các trường select đã được chọn chưa
        if ($('#exampleSelect4').val() == '-- Chọn loại vật nuôi --') {
            alert('Vui lòng chọn đầy đủ thông tin');
            return false; // Ngăn chặn việc gửi biểu mẫu nếu thông tin không đầy đủ
        }
    });
});
</script>


@endsection