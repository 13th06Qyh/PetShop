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
    <title>Quên mật khẩu</title>
</head>

<body>
    <div id="wrapper">
        <div id="left">
            <a href="{{route('login.view')}}" id="logo">
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
            <form method="POST" action="{{ route('forgot.password.send') }}" id="form-signup">
                @csrf
                <h1 class="form-heading">Quên Mật Khẩu</h1>

                <div class="form-group">
                    Email:
                    <input name="email" id="mail" type="email" class="form-input" placeholder="" required>
                    @error('mail')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <input type="submit" value="Gửi" class="form-submit">
            </form>
        </div>
    </div>


</body>
<script src='{{asset("assets/js/signup.js")}}'></script>

</html>