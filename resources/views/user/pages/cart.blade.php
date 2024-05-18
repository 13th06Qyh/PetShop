<!-- Lấy phần header, footer, css -->
@extends('user.layout.main')

<!-- Tên trang -->
@section('title')
<title>Giỏ hàng</title>

@endsection

<!-- Nội dung của trang, phần thân -->
@section('main')
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ route('user.view') }}"><i class="bi bi-house-door-fill"></i>&nbsp;Trang chủ</a></li>
                @if (!auth()->check())
                <li><a href="{{ route('login.view') }}">Đăng nhập</a></li>
                @endif

            </ol>
            <center>
                <h2>Chần chờ gì nữa! Mua ngay đi nào!</h2>
            </center>

        </div>
    </section><!-- End Breadcrumbs -->



    <section class="property-grid grid">
        <div class="container">
            <form action="{{ route('buy.view') }}" class="muangaygiohang" method="POST" id="orderForm">
                @csrf
                <div class="row gy-4">
                    <div class="col-lg-8">

                        <!-- <form action="" method=""> -->
                        <input name="selectAll" type="checkbox" id="select-all-checkbox">
                        <Label>Chọn Tất Cả</Label>
                        <!-- </form> -->

                    </div>

                    <div class="col-lg-8">
                        <!-- <form action="" method="" id="form"> -->

                        <div class="col">
                            <div class="table-responsive">

                                <table class="babo">
                                    <tr>
                                        <th>Sản Phẩm </th>
                                        <th>Tên</th>
                                        <th>Giá/Sản phẩm</th>
                                        <th>Số lượng mua</th>
                                        <th>Chọn</th>
                                        <th>Xóa</th>
                                    </tr>
                                    <tbody>
                                        @if(count($carts) > 0)
                                        @php
                                        $totalAmount = 0;
                                        @endphp
                                        @foreach ($carts as $cart)
                                        <tr>
                                            <td>
                                                @if(isset($cart->ImageSP[0]))
                                                @php
                                                $firstImage = explode('|', $cart->ImageSP[0]->image);
                                                @endphp
                                                <img src="{{ asset($firstImage[0]) }}" alt="" width="100px">
                                                @endif
                                                <!-- <img src="Picture/Hamster/chuotcanh.jpg"> -->
                                            </td>
                                            <td>{{ $cart->tensp }}</td>
                                            <td>{{  $cart->buyprice }} VNĐ</td>
                                            <td>
                                                <div class="portfolio-info">
                                                    <input class="minus is-form" type="button" value="-">
                                                    <input id="quantity_{{ $cart->idsp }}"
                                                        name="carts[{{ $cart->idsp }}][quantity]" aria-label="quantity"
                                                        class="input-qty" max="{{ $cart->soluongkho }}" min="1"
                                                        type="number" value="1">
                                                    <input class="plus is-form" type="button" value="+">
                                                </div>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="carts[{{ $cart->idsp }}][check]" value="1"
                                                    class="form-checkbox">
                                                <input type="hidden" name="carts[{{ $cart->idsp }}][id]"
                                                    value="{{ $cart->idsp }}">
                                            </td>
                                            <td>
                                                <button value="{{ $cart->maCart }}"
                                                    style="background-color: #fff; border: none; font-size: 20px"
                                                    class="open-modal-btn" data-target="#ModalDE_{{ $cart->maCart }}"
                                                    type="button" title="Xóa" data-toggle="modal">
                                                    <i style="color: #FFA07A; background-color: #fff; font-size: 20px"
                                                        class="bi bi-trash3-fill"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @php
                                        $subtotal = $cart->buyprice * $cart['quantity'];
                                        $totalAmount += $subtotal;
                                        @endphp
                                        @endforeach
                                        @else
                                        <center style="padding-top: 50px; color: gray;">
                                            <h4><i>Không có sản phẩm nào trong giỏ hàng!</i></h4>
                                            <br>
                                        </center>
                                        @endif
                                    </tbody>
                                </table>


                            </div>
                        </div>
                        <!-- </form> -->
                    </div>


                    <div class="col-lg-4">
                        <div class="giohang-info">
                            <!-- <form action="{{ route('buy.view') }}" class="muangaygiohang" method="POST"> -->


                            <ul>
                                <center>
                                    <h3 style="color: brown;" class="donhang"><b>THÔNG TIN ĐƠN HÀNG</b></h3>
                                    <p class="donhang"><i class="fa-solid fa-location-dot"></i><b>Địa Điểm &nbsp;</b>
                                    </p>
                                </center>
                                <div class="form-group mt-3">
                                    <textarea id="address" class="form-control" name="address" rows="5"
                                        placeholder="Nhập địa chỉ chi tiết ở đây!" required></textarea>
                                </div>
                                <hr>
                                <li type="none"><strong>Tổng tiền</strong>: </li>

                                <input id="buyButton" type="submit" name="selectedItems" id="selectedItems"
                                    value="Mua ngay" class="form-submit">
                                <!-- <input type="submit" name="" id="" value="Mua ngay" class="form-submit"> -->
                            </ul>
                            <!-- </form> -->

                        </div>
                        <div class="form-outline mb-4">
                            @if (session('error'))
                            <div class="alert alert-danger" style="color: red; text-align: right">
                                <i><small>{{ session('error') }}</small></i>
                            </div>
                            @endif
                        </div>

                    </div>
                </div>

            </form>
        </div>
    </section>



</main><!-- End #main -->

<!-- MODAL -->
@foreach ($carts as $cart)
<div class="modal fade" id="ModalDE_{{ $cart->maCart }}" tabindex="-1" role="dialog" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('deletesptocart.view', $cart->maCart) }}">
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
                            <h4><b>Bạn chắc chắn muốn loại bỏ sản phẩm này khỏi giỏ hàng?<b></h4>
                        </center>
                    </div>
                    <div class="row">

                        <br>
                        <hr>
                        <center><button class="btn btn-save" type="submit" style="background-color: #FFA07A;">Xác
                                nhận</button>
                            <a class="btn btn-cancel" data-dismiss="modal" href="{{ route('cart.view') }}"
                                style="background-color: grey;">Hủy</a>
                        </center>
                    </div>


                </div>
            </form>
            <!-- <div class="modal-footer"></div> -->
        </div>
    </div>
</div>
@endforeach
<!-- END MODAL -->
@endsection

<!-- Cái phần bố sung sau footer (có thể có hoặc không) -->
@section('custom_js')
<script>
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});
</script>
<script>
// Lấy tham chiếu đến checkbox "Chọn tất cả"
const selectAllCheckbox = document.getElementById('select-all-checkbox');

// Lấy danh sách tất cả các checkbox trong form
const formCheckboxes = document.querySelectorAll('.form-checkbox');

// Đặt sự kiện "change" cho checkbox "Chọn tất cả"
selectAllCheckbox.addEventListener('change', function() {
    // Lặp qua danh sách các checkbox trong form và đặt trạng thái của chúng bằng trạng thái của checkbox "Chọn tất cả"
    formCheckboxes.forEach(function(checkbox) {
        checkbox.checked = selectAllCheckbox.checked;
    });
});
</script>

<script>
var buyButton = document.getElementById("buyButton");

buyButton.addEventListener("click", function() {
    var addressTextarea = document.getElementById("address");
    var addressValue = addressTextarea.value.trim();

    if (addressValue === "") {
        alert("Vui lòng nhập địa chỉ trước khi mua hàng.");
        return;
    }
});
</script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function() {
    $(".open-modal-btn").click(function() {
        var targetModal = $(this).attr("data-target");
        $(targetModal).modal("show");
    });
});
</script>

<script>
function updateTotalAmount() {
    var totalAmount = 0;
    $('.babo tbody tr').each(function() {
        var checkbox = $(this).find('.form-checkbox');
        var quantityInput = $(this).find('.input-qty');
        var price = parseFloat($(this).find('td:eq(2)').text().replace(' VNĐ', ''));
        if (checkbox.prop('checked')) {
            totalAmount += quantityInput.val() * price;
        }
    });
    $('li strong').text('Tổng tiền: ' + totalAmount.toFixed(2) + ' VNĐ');
}

$('.form-checkbox').on('change', function() {
    updateTotalAmount();
});
$('.input-qty').on('input', function() {
    updateTotalAmount();
});
$('.plus.is-form, .minus.is-form').on('click', function() {
    updateTotalAmount();
});

$('#buyButton').on('click', function() {
    // Add your logic for handling the form submission
    // ...
});
</script>

@endsection