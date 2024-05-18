@extends('admin.layout.bara')

@section('title')
<title>Quản lý khách hàng</title>
@endsection

@section('main')
<div style="margin-left: 250px">
    <main class="">
        <div class="row-cols-1">
            <div class="tile">
                <div class="tile-body">
                    <div class="row element-button">
                        <center>
                            <h3>Quản Lý Tài Khoản Khách Hàng</h3>
                        </center>
                        <div class="col-sm-2">
                            <a class="btn btn-add btn-sm" href="{{ route('admin.add.user') }}" title="Thêm"><i
                                    class="fas fa-plus"></i>Tạo mới tài khoản</a>
                        </div>
                        <div class="col-sm-2">
                            <a class="btn btn-add btn-sm" href="{{ route('admin.blacklist.user') }}"
                                title="Black List"><i class="fa fa-th-list"></i> Danh sách đen</a>
                        </div>
                    </div>


                    <table class="table table-hover table-bordered js-copytextarea" cellspacing="0" id="sampleTable">
                        <thead>
                            <tr>
                                <th width="20">ID</th>
                                <th width="100">Tên tài khoản</th>
                                <th width="100">Email</th>
                                <th width="100">SĐT</th>
                                <th width="50">Tính năng</th>
                                <th width="50">Black List</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            @if ($user->role == 'user')
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>0{{ $user->sdt }}</td>
                                <td class="table-td-center">
                                    <!-- <button data-action="{{ $user->id }}" class="btn btn-primary btn-sm trash"
                                        title="Xóa" id="btn-delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button> -->
                                    <center><button value="{{ $user->id }}" class="btn btn-primary btn-sm trash"
                                            type="button" title="Xóa" data-toggle="modal"
                                            data-target="#ModalDE_{{ $user->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button value="{{ $user->id }}" class="btn btn-primary btn-sm edit"
                                            type="button" title="Sửa" data-toggle="modal"
                                            data-target="#ModalUP_{{ $user->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        @if ($user->blacklist == null)
                                        <button value="{{ $user->id }}" style="color: black; border: 0" class=""
                                            type="button" title="Khóa" data-toggle="modal"
                                            data-target="#ModalLO_{{ $user->id }}">
                                            <i class="bi bi-unlock-fill"></i>
                                        </button>
                                        @else
                                        <button value="{{ $user->id }}" style="color: black; border: 0" class=""
                                            type="button" title="Mở khóa" data-toggle="modal"
                                            data-target="#ModalLO_{{ $user->id }}">
                                            <i class="bi bi-lock-fill"></i>
                                        </button>
                                        @endif

                                    </center>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- MODAL -->
    @foreach ($users as $user)
    @if ($user->role == 'user')
    <div class="modal fade" id="ModalUP_{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.edit.user', $user->id) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <span class="thong-tin-thanh-toan">
                                    <h5>Chỉnh sửa thông tin tài khoản cơ bản</h5>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Tên tài khoản</label>
                                <input name="tentk" class="form-control" type="text" value="{{ $user->username }}"
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Email</label>
                                <input name="mail" class="form-control" type="email" value="{{ $user->email }}"
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">SĐT</label>
                                <input id="sdtInput" name="sdt" class="form-control" type="number"
                                    value="{{ $user->sdt }}" required>
                            </div>
                            <!-- <div class="form-group col-md-6">
                                <input name="id" class="form-control" type="hidden" value="{{ $user->id }}" required>
                            </div> -->
                        </div>

                        <button class="btn btn-save" type="submit">Cập nhật</button>
                        <a class="btn btn-cancel" data-dismiss="modal" href="{{route('admin.customer')}}">Hủy bỏ</a>
                        <BR>
                    </div>
                </form>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    <!-- END MODAL -->


    <!-- MODAL -->
    @foreach ($users as $user)
    @if ($user->role == 'user')
    <div class="modal fade" id="ModalDE_{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.delete.user', $user->id) }}">
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
                                <h4>Bạn chắc chắn muốn xóa người dùng này?</h4>
                            </center>
                        </div>
                        <div class="row">

                            <br>
                            <center><button class="btn btn-save" type="submit">Đồng ý</button>
                                <a class="btn btn-cancel" data-dismiss="modal" href="{{route('admin.customer')}}">Hủy
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
    @endif
    @endforeach
    <!-- END MODAL -->

    <!-- MODAL -->
    @foreach ($users as $user)
    @if ($user->role == 'user')
    <div class="modal fade" id="ModalLO_{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.lock.user', $user->id) }}">
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
                                @if ($user->blacklist == null)
                                <h4>Bạn muốn đưa người này vào danh sách đen?</h4>
                                <hr>
                                <div class="form-group col-md-12">
                                    <label class="control-label">Lí do</label>
                                    <textarea name="note" class="form-control" rows="3" required></textarea>
                                </div>
                                @else
                                <h4>Bạn chắc chắn muốn mở khóa tài khoản cho người dùng này?</h4>
                                @endif

                            </center>
                        </div>
                        <div class="row">

                            <br>
                            <center><button class="btn btn-save" type="submit">Đồng ý</button>
                                <a class="btn btn-cancel" data-dismiss="modal" href="{{route('admin.customer')}}">Hủy
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
    @endif
    @endforeach
    <!-- END MODAL -->
</div>
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