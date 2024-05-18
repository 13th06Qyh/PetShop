<!-- Lấy phần header, footer, css -->
@extends('admin.layout.bara')

<!-- Tên trang -->
@section('title')
<title>Quản lý sản phẩm</title>
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
                            <h3>Quản Lý Sản Phẩm</h3>
                        </center>
                        <div class="col-sm-2">

                            <a class="btn btn-add btn-sm" href="{{ route('admin.add.sanpham') }}" title="Thêm"><i
                                    class="fas fa-plus"></i>
                                Tạo mới sản phẩm</a>
                        </div>

                    </div>


                    <table class="table table-hover table-bordered js-copytextarea" cellpadding="0" cellspacing="0"
                        border="0" id="sampleTable">
                        <thead>
                            <tr>

                                <th width="20">ID</th>
                                <th width="150">Tên</th>
                                <th width="150">Ảnh</th>
                                <th width="50">Số lượng</th>
                                <th width="90">Giá bán</th>
                                <th width="90">Giá gốc</th>
                                <th width="70">NCC</th>
                                <th width="50">Dạng</th>
                                <th width="70">Mặt hàng</th>
                                <th width="90">Mô tả</th>
                                <th width="50">Vật nuôi</th>
                                <th width="50">Tính năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sanphams as $sanpham)

                            <tr>

                                <td>{{ $sanpham->maSP }}</td>
                                <td>{{ $sanpham->tensp }}</td>
                                <td>
                                    @if(isset($sanpham->ImageSP[0]))
                                    @php
                                    $firstImage = explode('|', $sanpham->ImageSP[0]->image);
                                    @endphp
                                    <img src="{{ asset($firstImage[0]) }}" alt="" width="100px">
                                    @endif

                                </td>
                                <td>{{ $sanpham->soluongkho }}</td>
                                <td>{{ $sanpham->buyprice }}</td>
                                <td>{{ $sanpham->oldprice }}</td>
                                <td>{{ $sanpham->Provide->proname }}</td>
                                <td>{{ $sanpham->Tag->tagname }}</td>
                                <td>{{ $sanpham->Type->typename }}</td>
                                <td>
                                    <div class="an">{{ $sanpham->mota }}</div>
                                </td>
                                <td>{{ $sanpham->animal->animalname }}</td>
                                <td class="table-td-center">
                                    <center><button value="{{ $sanpham->maSP }}" class="btn btn-primary btn-sm trash"
                                            type="button" title="Xóa" data-toggle="modal"
                                            data-target="#ModalDE_{{ $sanpham->maSP }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button data-id="{{ $sanpham->maSP }}" class="btn btn-primary btn-sm edit"
                                            type="button" title="Sửa" id="show-emp" data-toggle="modal"
                                            data-target="#ModalUP_{{ $sanpham->maSP }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
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
    @foreach ($sanphams as $sanpham)
    <div class="modal fade" id="ModalUP_{{ $sanpham->maSP }}" tabindex="-1" role="dialog" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.edit.updatesanpham', $sanpham->maSP) }}"
                    enctype="multipart/form-data">

                    @csrf
                    <div class=" modal-body">

                        <div class="row">
                            <div class="form-group col-md-12">
                                <span class="thong-tin-thanh-toan">
                                    <h5>Chỉnh sửa thông tin sản phẩm</h5>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Tên sản phẩm</label>
                                <input name="namesp" class="form-control" type="text" value="{{ $sanpham->tensp }}"
                                    data-maSP="{{ $sanpham->maSP }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Ảnh sản phẩm</label>
                                <div id="myfileupload">
                                    <!-- <input type="file" id="uploadfile" name="imageSP[]" onchange="readURL(this);"
                                        accept="image/*" multiple required /> -->
                                    <input type="file" name="imageSP[]" id="dataImage" multiple
                                        data-maSP="{{ $sanpham->maSP }}" required />
                                </div>
                                <div id="thumbbox">
                                    <img height="100%" width="100%" alt="Thumb image" id="thumbimage"
                                        style="display: none" />
                                    <a class="removeimg" href="javascript:"></a>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Số lượng</label>
                                <input name="soluong" class="form-control" type="number" min="1"
                                    value="{{ $sanpham->soluongkho }}" data-maSP="{{ $sanpham->maSP }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Giá bán</label>
                                <input name="buyprice" class="form-control" type="text" value="{{ $sanpham->buyprice }}"
                                    data-maSP="{{ $sanpham->maSP }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Giá gốc</label>
                                <input name="oldprice" class="form-control" type="text" value="{{ $sanpham->oldprice }}"
                                    data-maSP="{{ $sanpham->maSP }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect1" class="control-label">Dạng</label>
                                <select name="tag_id" class="form-control" id="exampleSelect1"
                                    data-maSP="{{ $sanpham->maSP }}" required>
                                    <option value="{{ $sanpham->Tag->maTag }}" selected>{{ $sanpham->Tag->tagname }}
                                    </option>
                                    @foreach ($tags as $tag )
                                    <option value="{{$tag->maTag}}">{{$tag->tagname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleSelect2" class="control-label">Nhà cung cấp</label>
                                <select name="provide_id" class="form-control" id="exampleSelect2"
                                    data-maSP="{{ $sanpham->maSP }}" required>
                                    <option value="{{ $sanpham->Provide->maNCC }}" selected>
                                        {{ $sanpham->Provide->proname }}</option>
                                    @foreach ($provides as $provide )
                                    <option value="{{$provide->maNCC}}">{{$provide->proname}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label">Mô tả sản phẩm</label>
                                <textarea name="motasp" class="form-control" rows="5" id="mota"
                                    data-maSP="{{ $sanpham->maSP }}"
                                    required>{{ old('mota', $sanpham->mota) }}</textarea>
                            </div>
                        </div>

                        <button id="editsanpham" class="btn btn-save" type="submit">Cập nhật</button>
                        <a class="btn btn-cancel" data-dismiss="modal" href="{{ route('admin.sanpham') }}">Hủy bỏ</a>
                        <BR>
                    </div>
                </form>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- END MODAL -->

    <!-- MODAL -->
    @foreach ($sanphams as $sanpham)
    <div class="modal fade" id="ModalDE_{{ $sanpham->maSP }}" tabindex="-1" role="dialog" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.delete.sanpham', $sanpham->maSP) }}">
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
                                <h4>Bạn chắc chắn muốn xóa sản phẩm này?</h4>
                            </center>
                        </div>
                        <div class="row">

                            <br>
                            <center><button class="btn btn-save" type="submit">Đồng ý</button>
                                <a class="btn btn-cancel" data-dismiss="modal" href="{{ route('admin.sanpham') }}">Hủy
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
<!-- <script>
document.getElementById("editsanpham").addEventListener("click", function(event) {
    var requiredFields = document.querySelectorAll("[required]");

    for (var i = 0; i < requiredFields.length; i++) {
        var maSP = requiredFields[i].getAttribute("data-maSP");

        if (!requiredFields[i].value) {
            alert("Vui lòng điền đầy đủ thông tin cho sản phẩm có mã: " + maSP);
            event.preventDefault();
            return;
        }
    }
});
</script> -->
@endsection