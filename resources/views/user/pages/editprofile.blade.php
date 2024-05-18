<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../css/reset.css"> -->
    <link href="{{ asset('/assets/css/signup.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="{{ asset('/assets/vendor/bootstrap/js/bootstrap.js') }}">
    <!-- <link rel="stylesheet" href="../bootstrap-5.3.0-alpha3-dist/css/bootstrap.css"> -->
    <title>Chỉnh sửa thông tin cá nhân</title>
</head>

<body>
    <div id="wrapper">
        <div id="left">
            <a href="{{ route('account.view') }}" id="logo">
                <img src="Picture/logo.png" alt="Petshop">
            </a>
            <center>
                <p>
                    <small style="color: #e56"><i>Click vào hình trên để quay lại trang trước!</i></small><br>Pet Shop
                    là thiên đường thú cưng , nơi cung cấp toàn bộ những thứ liên quan đến đời sống của pet.
                </p>
            </center>

        </div>
        <div id="right">
            <form method="POST" action="{{ route('user.updateuser', ['id' => auth()->user()->id]) }}" id="form-signup">
                @csrf
                <h1 class="form-heading">Chỉnh sửa thông tin cá nhân</h1>

                <div class="form-group">
                    Tên tài khoản: &nbsp;
                    <!-- <label for="fullname">Họ và tên</label><br> -->
                    <input name="tentk" id="tentk" type="text" value="{{ auth()->user()->username }}" class="form-input"
                        placeholder="" required>
                </div>

                <div class="form-group">
                    SĐT: &nbsp;
                    <!-- <label for="fullname">SĐT</label><br> -->
                    <input name="sdt" id="sdtInput" type="text" value="{{ auth()->user()->sdt }}" class="form-input"
                        placeholder="" required>
                </div>

                <div class="form-group">
                    Email: &nbsp;
                    <!-- <label for="fullname">Email</label><br> -->
                    <input name="mail" id="mail" type="email" value="{{ auth()->user()->email }}" class="form-input"
                        placeholder="" required>
                </div>

                <input type="submit" value="Lưu chỉnh sửa" class="form-submit">

                <br>

            </form>
        </div>
    </div>


</body>
<script src='{{ asset("assets/js/signup.js") }}'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var sdtInput = document.getElementById('sdtInput');

    sdtInput.addEventListener('input', function() {
        // Loại bỏ số 0 ở đầu nếu có
        this.value = this.value.replace(/^0+/, '');
    });
});
</script>

</html>