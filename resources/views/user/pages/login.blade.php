<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../css/reset.css"> -->
    <link href="{{ asset('/assets/css/login.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <!-- <link rel="stylesheet" href="../bootstrap-5.3.0-alpha3-dist/css/bootstrap.css"> -->
    <title>Login</title>
</head>

<body>
    <div id="wrapper">
        <div id="left">
            <a href="{{route('user.view')}}" id="logo">
                <img src="Picture/logo.png" alt="Petshop">
            </a>
            <center>
                <p>Pet Shop đảm bảo 100% về chất lượng và độ an toàn !</p>
        </div>
        </center>
        <div id="right">
            <form action="{{route('getLogin')}}" method="POST" id="form-login">
                @csrf
                <h1 class="form-heading">Bạn đã có tài khoản?</h1>

                <div class="form-group">
                    <i class="far fa-user"></i>
                    <input name="username" id="username" type="text" class="form-input" placeholder="Tên đăng nhập">
                </div>

                <div class="form-group">
                    <i class="fas fa-key"></i>
                    <input name="password" id="password" type="password" class="form-input" placeholder="Mật khẩu">


                </div>

                <input type="submit" value="Đăng nhập" class="form-submit">
                <!-- <small><i><a href="" class=""
                            style="color: #007BFF;font-size: 14px;text-decoration: none;display: block;margin-top: 10px;text-align: right;"><b>Quên
                                mật khẩu?</b>
                        </a></i></small> -->
                <br>
                <div class="form-outline mb-4">
                    @if (session('error'))
                    <div class="alert alert-danger" style="color: red; text-align: right">
                        <i><small>{{ session('error') }}</small></i>
                    </div>
                    @endif
                </div>
                <br>
                <small>Nếu bạn chưa có tài khoản, hãy đi đến => </small>
                <a href="{{route('sigin.view')}}" class="sp"><u>Đăng kí</u> </a>

            </form>
        </div>

    </div>
</body>
<script src='{{asset("assets/js/login.js")}}'></script>

</html>