<!-- Lấy phần header, footer, css -->
@extends('admin.layout.bara')

<!-- Tên trang -->
@section('title')
<title>Quản lý khách hàng</title>
@endsection

<!-- Nội dung của trang, phần thân -->
@section('main')
<!-- Page Content -->
<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.customer')}}">Danh sách tài khoản</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.add.user')}}">Thêm tài khoản</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Tạo mới tài khoản</h3>
                <div class="tile-body">

                    <form action="{{ route('admin.add.storeadmin') }}" method="POST" class="row">
                        @csrf
                        <div class="form-group col-md-3">
                            <label class="control-label">Tên tài khoản</label>
                            <input name="name" class="form-control" type="text" required>
                        </div>

                        <div class="form-group  col-md-3">
                            <label class="control-label">Email</label>
                            <input name="email" class="form-control" type="email" required>
                        </div>

                        <div class="form-group  col-md-3">
                            <label class="control-label">SĐT</label>
                            <input id="sdtInput" name="sdt" class="form-control" type="number" required>
                        </div>

                        <div class="form-group  col-md-3">
                            <label class="control-label">Mật khẩu</label>
                            <input name="password" class="form-control" type="password" required>
                        </div>

                        <div class="form-group">
                            <button id="adduser" class=" btn btn-save" type="submit">Lưu lại</button>
                            <a class="btn btn-cancel" href="{{route('admin.customer')}}">Hủy bỏ</a>
                        </div>
                    </form>
                    <div class="form-outline mb-4">
                        @if (session('error'))
                        <div class="alert alert-danger" style="color: red; text-align: right">
                            <i><small>{{ session('error') }}</small></i>
                        </div>
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>

</main>
@endsection

@section('custom_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var sdtInput = document.getElementById('sdtInput');

    sdtInput.addEventListener('input', function() {
        // Loại bỏ số 0 ở đầu nếu có
        this.value = this.value.replace(/^0+/, '');
    });
});
</script>
@endsection