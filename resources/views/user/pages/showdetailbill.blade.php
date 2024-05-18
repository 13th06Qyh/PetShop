<!-- Lấy phần header, footer, css -->
@extends('user.layout.main')

<!-- Tên trang -->
@section('title')
<title>Chi tiết đơn hàng {{ $bills->maBill }}</title>

@endsection

<!-- Nội dung của trang, phần thân -->
@section('main')
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ route('user.view') }}"><i class="bi bi-house-door-fill"></i>&nbsp;Trang chủ</a></li>
                <li><a href="{{ route('order.view') }}">Danh sách đơn hàng</a></li>
                @if (!auth()->check())
                <li><a href="{{ route('login.view') }}">Đăng nhập</a></li>
                @endif

            </ol>
            <center>
                <h2>Đơn hàng mã {{ $bills->maBill }}</h2>
            </center>

        </div>
    </section><!-- End Breadcrumbs -->



    <section class="property-grid grid">
        <div class="container">

            <div class="row gy-4">
                <div class="search-container" style="text-align: right; border-radius: 5px;">
                    <label for="searchInput"><b>Tìm kiếm:</b></label>
                    <input type="text" id="searchInput" placeholder="Nhập từ khóa...">
                </div>


                <div class="col">

                    <div class="table-responsive">

                        <table class="babo">
                            <tr>
                                <th>Mã BSP</th>
                                <th>Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá/SP</th>
                                <th>Số lượng đã mua</th>
                            </tr>
                            <tbody>

                                @if (is_array($billD) || is_object($billD))
                                @foreach ($billD as $billd)
                                <tr>
                                    <td>{{ $billd->maBillSP }}</td>
                                    <td>
                                        @if(isset($billd->SanPham->ImageSP[0]))
                                        @php
                                        $firstImage = explode('|', $billd->SanPham->ImageSP[0]->image);
                                        @endphp
                                        <img src="{{ asset($firstImage[0]) }}" alt="" width="100px">
                                        @endif
                                    </td>
                                    <td>{{ $billd->SanPham->tensp }}</td>
                                    <td>{{ $billd->SanPham->buyprice }}</td>
                                    <td>{{ $billd->soluong }}</td>
                                </tr>
                                @endforeach
                                @endif


                            </tbody>

                        </table>


                    </div>
                </div>


            </div>

        </div>
    </section>



</main><!-- End #main -->


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
        // Dừng xử lý tiếp theo (nếu có) khi người dùng chưa nhập địa chỉ
        return;
    }

    // Tiếp tục xử lý mua hàng nếu địa chỉ đã được nhập
    // ...
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
$(document).ready(function() {
    // Lấy tham chiếu đến ô input tìm kiếm
    var searchInput = $('#searchInput');

    // Lấy tham chiếu đến bảng
    var table = $('.babo');

    // Thiết lập sự kiện khi người dùng nhập liệu vào ô tìm kiếm
    searchInput.on('keyup', function() {
        var searchText = $(this).val().toLowerCase();

        // Lặp qua từng dòng trong bảng
        table.find('tbody tr').each(function(index, row) {
            var rowData = $(row).text().toLowerCase();

            // Ẩn hoặc hiển thị dòng dựa trên sự khớp với từ khóa tìm kiếm
            if (rowData.indexOf(searchText) === -1) {
                $(row).hide();
            } else {
                $(row).show();
            }
        });
    });
});
</script>
@endsection