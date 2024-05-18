@extends('admin.layout.bara')

@section('title')
<title>Danh sách tài khoản bị khóa</title>
@endsection

@section('main')
<div style="margin-left: 250px">
    <main class="">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.customer')}}">Danh sách tài khoản</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.blacklist.user')}}">Danh sách
                        đen</a></li>
            </ul>
        </div>
        <div class="row-cols-1">
            <div class="tile">
                <h3 class="tile-title">Danh Sách Tài khoản Bị Khóa</h3>
                <div class="tile-body">


                    <div class="form-outline mb-4">
                        @if (session('error'))
                        <div class="alert alert-danger" style="color: red; text-align: right">
                            <i><small>{{ session('error') }}</small></i>
                        </div>
                        @endif
                    </div>
                    <table class="table table-hover table-bordered js-copytextarea" cellspacing="0" id="sampleTable">
                        <thead>
                            <tr>
                                <th style="text-align: center;" width="50">ID</th>
                                <th style="text-align: center;" width="100">Tên tài khoản</th>
                                <th style="text-align: center;" width="150">Email</th>
                                <th style="text-align: center;" width="100">SĐT</th>
                                <th style="text-align: center;" width="100">Ghi chú</th>
                                <th style="text-align: center;" width="100">Tính năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>
                                    <center>{{ $user->id }}</center>
                                </td>
                                <td>
                                    <center>{{ $user->username }}</center>
                                </td>
                                <td>
                                    <center>{{ $user->email }}</center>
                                </td>
                                <td>
                                    <center>0{{ $user->sdt }}</center>
                                </td>
                                <td>
                                    <center>{{ $user->note }}</center>
                                </td>
                                <td class="table-td-center">
                                    <center>
                                        <button value="{{ $user->id }}" style="color: black; border: 0" class=""
                                            type="button" title="Mở khóa" data-toggle="modal"
                                            data-target="#ModalLO_{{ $user->id }}">
                                            <i class="bi bi-unlock-fill"></i>
                                        </button>
                                    </center>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </main>


    <!-- MODAL -->
    @foreach ($users as $user)
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
                                <h4>Bạn chắc chắn muốn mở khóa tài khoản cho người dùng này?</h4>
                            </center>
                        </div>
                        <div class="row">

                            <br>
                            <center>
                                <button class="btn btn-save" type="submit">Xác nhận</button>
                                <a class="btn btn-cancel" data-dismiss="modal"
                                    href="{{route('admin.blacklist.user')}}">Hủy
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