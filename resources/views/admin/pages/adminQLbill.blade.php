@extends('admin.layout.bara')

@section('title')
<title>Quản lý đơn hàng</title>
@endsection

@section('main')
<div style="margin-left: 250px">
    <main class="">
        <div class="row-cols-1">
            <div class="tile">
                <div class="tile-body">
                    <div class="row element-button">
                        <center>
                            <h3>Quản Lý Đơn Hàng</h3>
                        </center>

                    </div>

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
                                <th width="10">ID</th>
                                <th width="30">Tên KH</th>
                                <th width="60">SĐT</th>
                                <th width="150">Địa chỉ</th>
                                <th width="70">Tổng tiền</th>
                                <th width="70">Trạng thái</th>
                                <th width="60">Ngày tạo</th>
                                <th width="60">Tính năng</th>
                                <th width="40">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bills as $bill)
                            <tr>
                                <td>{{ $bill->maBill }}</td>
                                <td>{{ $bill->User->username }}</td>
                                <td>{{ $bill->User->sdt }}</td>
                                <td>{{ $bill->diachi }}</td>
                                <td>{{ $billDArray[$bill->maBill] }} VNĐ</td>
                                <td>{{ $bill->status }}</td>
                                <td>{{ $bill->created_at->format('d-m-Y H:i:s') }}</td>
                                <td class="table-td-center">
                                    <center>
                                        <button value="{{ $bill->maBill }}" class="btn btn-primary btn-sm trash"
                                            type="button" title="Xóa" data-toggle="modal"
                                            data-target="#ModalDE_{{ $bill->maBill }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button value="{{ $bill->maBill }}" class="btn btn-primary btn-sm edit"
                                            type="button" title="Sửa" data-toggle="modal"
                                            data-target="#ModalUP_{{ $bill->maBill }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <a class="" style="color: blue"
                                            href="{{ route('admin.detail.bill', ['id' => $bill->maBill]) }}"
                                            title="Thêm"><i>Xem</i></a>
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
    @foreach ($bills as $bill)
    <div class="modal fade" id="ModalUP_{{ $bill->maBill }}" tabindex="-1" role="dialog" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.edit.updatestatus', ['id' => $bill->maBill]) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <span class="thong-tin-thanh-toan">
                                    <h5>Chỉnh sửa trạng thái đơn hàng</h5>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleSelect4" class="control-label">Sửa trạng thái</label>
                                <select name="status_tt" class="form-control" id="exampleSelect4"
                                    data-maSP="{{ $bill->maBill }}" required>
                                    <option value="{{ $bill->status }}">Chưa thanh toán</option>
                                    <option>Đã thanh toán</option>
                                </select>
                            </div>
                            <!-- <div class="form-group col-md-6">
                                <input name="id" class="form-control" type="hidden" value="{{ $bill->id }}" required>
                            </div> -->
                        </div>

                        <button class="btn btn-save" type="submit">Cập nhật</button>
                        <a class="btn btn-cancel" data-dismiss="modal" href="{{route('admin.bill')}}">Hủy bỏ</a>
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
    @foreach ($bills as $bill)
    <div class="modal fade" id="ModalDE_{{ $bill->maBill }}" tabindex="-1" role="dialog" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.delete.bill', ['id' => $bill->maBill]) }}">
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
                                <h4>Bạn chắc chắn muốn hủy đơn hàng này?</h4>
                            </center>
                        </div>
                        <div class="row">

                            <br>
                            <center>
                                <button class="btn btn-save" type="submit">Xác nhận</button>
                                <a class="btn btn-cancel" data-dismiss="modal" href="{{route('admin.bill')}}">Hủy
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