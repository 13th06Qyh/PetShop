<script src='{{asset("assets/vendor/purecounter/purecounter_vanilla.js")}}'></script>
<script src='{{asset("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")}}'></script>
<script src='{{asset("assets/vendor/glightbox/js/glightbox.min.js")}}'></script>
<script src='{{asset("assets/vendor/isotope-layout/isotope.pkgd.min.js")}}'></script>
<script src='{{asset("assets/vendor/swiper/swiper-bundle.min.js")}}'></script>
<script src='{{asset("assets/vendor/waypoints/noframework.waypoints.js")}}'></script>
<script src='{{asset("assets/vendor/php-email-form/validate.js")}}'></script>


<!-- <script src='{{asset("assets/js/main.js")}}'></script> -->


<script src='{{ asset("assets/js/pagination.js")}}'></script>



<!-- Essential javascripts for application to work-->
<script src='{{asset("assets/js/jquery-3.2.1.min.js")}}'></script>
<script src='{{asset("assets/js/popper.min.js")}}'></script>
<script src='{{asset("assets/js/bootstrap.min.js")}}'></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script src='{{asset("assets/js/main2.js")}}'></script>



<script src='{{asset("assets/js/plugins/pace.min.js")}}'></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
    integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<!-- The javascript plugin to display page loading on top-->
<script src='{{asset("assets/js/plugins/pace.min.js")}}'></script>
<!-- Page specific javascripts-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<!-- Data table plugin-->
<script type="text/javascript" src='{{asset("assets/js/plugins/jquery.dataTables.min.js")}}'></script>
<script type="text/javascript" src='{{asset("assets/js/plugins/dataTables.bootstrap.min.js")}}'></script>
<script type="text/javascript">
$('#sampleTable').DataTable();
//Thời Gian
function time() {
    var today = new Date();
    var weekday = new Array(7);
    weekday[0] = "Chủ Nhật";
    weekday[1] = "Thứ Hai";
    weekday[2] = "Thứ Ba";
    weekday[3] = "Thứ Tư";
    weekday[4] = "Thứ Năm";
    weekday[5] = "Thứ Sáu";
    weekday[6] = "Thứ Bảy";
    var day = weekday[today.getDay()];
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    nowTime = h + " giờ " + m + " phút " + s + " giây";
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    today = day + ', ' + dd + '/' + mm + '/' + yyyy;
    tmp = '<span class="date"> ' + today + ' - ' + nowTime +
        '</span>';
    document.getElementById("clock").innerHTML = tmp;
    clocktime = setTimeout("time()", "1000", "Javascript");

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
}
</script>
<!-- <script>
function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("myTable").deleteRow(i);
}
jQuery(function() {
    jQuery(".trash").click(function() {
        swal({
                title: "Cảnh báo",
                text: "Bạn có chắc chắn là muốn xóa sản phẩm này?",
                buttons: ["Hủy bỏ", "Đồng ý"],
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Đã xóa thành công.!", {

                    });
                }
            });
    });
});
oTable = $('#sampleTable').dataTable();
$('#all').click(function(e) {
    $('#sampleTable tbody :checkbox').prop('checked', $(this).is(':checked'));
    e.stopImmediatePropagation();
});
</script> -->