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
    <link rel="stylesheet" href="{{ asset('/assets/vendor/bootstrap/js/bootstrap.js')}}">
    <!-- <link rel="stylesheet" href="../bootstrap-5.3.0-alpha3-dist/css/bootstrap.css"> -->
    <title>Đổi mật khẩu</title>
</head>

<body>
    <div id="wrapper">
        <div id="left">
            <a href="{{route('account.view')}}" id="logo">
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
            <form method="POST" action="{{ route('user.changePass', ['id' => auth()->user()->id]) }}" id="form-signup">
                @csrf
                <h1 class="form-heading">Thay đổi mật khẩu tài khoản của bạn!</h1>

                <div class="form-group">
                    Mật khẩu cũ: &nbsp;
                    <!-- <label for="fullname">Họ và tên</label><br> -->
                    <input name="current_password" id="current_password" type="password" class="form-input"
                        placeholder="" required>
                </div>

                <div class="form-group">
                    Mật khẩu mới: &nbsp;
                    <!-- <label for="fullname">Email</label><br> -->
                    <input name="password1" id="password1" type="password" class="form-input" placeholder="" required>
                </div>

                <div class="form-group">
                    Nhập lại mật khẩu mới: &nbsp;
                    <input name="password2" id="password2" type="password" class="form-input" placeholder="" required>
                </div>

                <input type="submit" value="Lưu thay đổi" class="form-submit">

                <br>
                <div class="form-outline mb-4">
                    @if (session('error'))
                    <div class="alert alert-danger" style="color: red; text-align: right">
                        <i><small>{{ session('error') }}</small></i>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>


</body>
<script src='{{asset("assets/js/signup.js")}}'></script>

</html>