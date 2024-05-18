@extends('admin.layout.bara')

@section('title')
<title>Doanh thu</title>
@endsection

@section('main')
<div style="margin-left: 250px">
    <main class="">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.revenue')}}">Thống kê doanh thu</a></li>
            </ul>
        </div>
        <div class="row-cols-1">
            <div class="tile">
                <h3 class="tile-title">Thống kê doanh thu</h3>
                <!-- Thay thế mã HTML dropdown cho tháng và năm -->
                <form action="{{ route('admin.revenue') }}" method="get">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="month">Chọn tháng:</label>
                                <select class="form-control" id="month" name="month">
                                    @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">
                                        {{ __('Tháng :month', ['month' => $i]) }}
                                        </option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="year">Chọn năm:</label>
                                <select class="form-control" id="year" name="year">
                                    @php
                                    $currentYear = date('Y');
                                    $startYear = $currentYear - 2; // Điều chỉnh số năm ở đây nếu cần
                                    $endYear = $currentYear + 5;
                                    @endphp
                                    @for ($year = $startYear; $year <= $endYear; $year++) <option value="{{ $year }}">
                                        {{ $year }}
                                        </option>
                                        @endfor
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label type="" for=""></label>
                                <button type="submit" class="btn btn-primary" style="margin-top: 35px;">Chọn</button>
                            </div>
                        </div>
                    </div>

                </form>
                <!-- Kết thúc dropdown -->

                <div class="tile-body">
                    <table class="table table-hover table-bordered js-copytextarea" cellspacing="0" id="sampleTable">
                        <thead>
                            <tr>
                                <th style="text-align: center;" width="50">Mã Đơn Hàng</th>
                                <th style="text-align: center;" width="150">Tổng bill</th>
                                <th style="text-align: center;" width="100">Ngày thanh toán</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totalRevenue = 0;
                            @endphp
                            @foreach ($revenues as $revenue)
                            <tr>
                                <td>
                                    <center>{{ $revenue->maBill }}</center>
                                </td>
                                <td>
                                    <center>{{ number_format($billDArray[$revenue->maBill]) }} VNĐ</center>
                                </td>
                                <td>
                                    <center>{{ $revenue->updated_at->format('d-m-Y H:i:s') }}</center>
                                </td>
                            </tr>
                            @php
                            $totalRevenue += $billDArray[$revenue->maBill];
                            @endphp
                            @endforeach
                        </tbody>
                        <tr>
                            <td colspan="3" style="text-align: right; font-weight: bold;">
                                <i class="bi bi-coin" style="font-size: 1.5em;"></i>&nbsp;&nbsp; Tổng doanh thu: <b
                                    style="color: red">{{number_format( $totalRevenue) }} VNĐ</b>
                            </td>
                        </tr>

                    </table>

                    <br>
                    <hr>

                    <table class="table table-hover table-bordered js-copytextarea" cellspacing="0" id="sampleTable">
                        <thead>
                            <tr>
                                <th style="text-align: center; font-weight: bold;">
                                    <i class="bi bi-cash-coin"> Doanh thu cún
                                </th>
                                <th style="text-align: center; font-weight: bold;">
                                    <i class="bi bi-cash-coin"> Doanh thu mèo
                                </th>
                                <th style="text-align: center; font-weight: bold;">
                                    <i class="bi bi-cash-coin"> Doanh thu chim
                                </th>
                                <th style="text-align: center; font-weight: bold;">
                                    <i class="bi bi-cash-coin"> Doanh thu chuột
                                </th>
                                <th style="text-align: center; font-weight: bold;">
                                    <i class="bi bi-cash-coin"> Doanh thu cá
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="color: blue; text-align: center; font-weight: bold;">
                                    {{ number_format($billDAC) }} VNĐ</td>
                                <td style="color: blue; text-align: center; font-weight: bold;">
                                    {{ number_format($billDAM) }} VNĐ</td>
                                <td style="color: blue; text-align: center; font-weight: bold;">
                                    {{ number_format($billDACI) }} VNĐ</td>
                                <td style="color: blue; text-align: center; font-weight: bold;">
                                    {{ number_format($billDACU) }} VNĐ</td>
                                <td style="color: blue; text-align: center; font-weight: bold;">
                                    {{ number_format($billDACA) }} VNĐ</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@section('custom_js')
<!-- Thêm vào section 'custom_js' -->
@section('custom_js')

@endsection

@endsection