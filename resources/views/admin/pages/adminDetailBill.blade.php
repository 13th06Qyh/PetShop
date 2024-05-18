@extends('admin.layout.bara')

@section('title')
<title>Chi tiết đơn hàng {{ $bills->maBill }}</title>
@endsection

@section('main')
<div style="margin-left: 250px">
    <main class="">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.bill')}}">Danh sách đơn hàng</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.detail.bill', ['id' => $bills->maBill])}}">Đơn hàng
                        mã
                        {{ $bills->maBill }}</a></li>
            </ul>
        </div>
        <div class="row-cols-1">
            <div class="tile">
                <h3 class="tile-title">Đơn Hàng Mã {{ $bills->maBill }}</h3>
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
                                <th style="text-align: center;" width="50">Mã BSP</th>
                                <th style="text-align: center;" width="150">Ảnh</th>
                                <th style="text-align: center;" width="100">Tên sản phẩm</th>
                                <th style="text-align: center;" width="100">Giá/SP</th>
                                <th style="text-align: center;" width="100">Số lượng đã mua</th>
                                <th style="text-align: center;" width="100">Tính năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (is_array($billD) || is_object($billD))
                            @foreach ($billD as $billd)
                            <tr>
                                <td>
                                    <center>{{ $billd->maBillSP }}</center>
                                </td>
                                <td>
                                    <center>
                                        @if(isset($billd->SanPham->ImageSP[0]))
                                        @php
                                        $firstImage = explode('|', $billd->SanPham->ImageSP[0]->image);
                                        @endphp
                                        <img src="{{ asset($firstImage[0]) }}" alt="" width="100px">
                                        @endif
                                    </center>
                                </td>
                                <td>
                                    <center>{{ $billd->SanPham->tensp }}</center>
                                </td>
                                <td>
                                    <center>{{ $billd->SanPham->buyprice }}</center>
                                </td>
                                <td>
                                    <center>{{ $billd->soluong }}</center>
                                </td>
                                <td class="table-td-center">
                                    <center>
                                        <button value="{{ $billd->maBillSP }}" class="btn btn-primary btn-sm trash"
                                            type="button" title="Xóa" data-toggle="modal"
                                            data-target="#ModalDE_{{ $billd->maBillSP }}">
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
    @foreach ($billD as $billd)
    <div class="modal fade" id="ModalDE_{{ $billd->maBillSP }}" tabindex="-1" role="dialog" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.deleteDetail.bill', ['id' => $billd->maBillSP]) }}">
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
                                <h4>Bạn chắc chắn muốn hủy sản phẩm này khỏi đơn hàng?</h4>
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