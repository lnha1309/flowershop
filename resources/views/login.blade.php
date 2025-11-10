<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://fonts.cdnfonts.com/css/mango-vintage-personal-use-only" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/alice-2" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css.map') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('images/icon.png') }}">
</head>
<body class="background-img">
    <div class="logo text-center mt-2">
        <h2 class="mb-0" style="font-family: 'Uncial Antiqua', cursive !important;">Florencia</h2>
    </div>

    <div class="formbox animation text-center mt-4">
        <div class="container">
            <div class="row col-md-8 mb-md-3 mt-sm-0 mt-4">
                <h1 class="mb-5">Đăng nhập</h1>

                @if(session('status'))
                    <div class="alert alert-success w-100">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger w-100">{{ $errors->first() }}</div>
                @endif

                <form action="{{ route('login.submit') }}" method="POST" class="w-100">
                    @csrf
                    <div class="form-floating mb-2 mb-md-3">
                        <input type="email" class="form-control" id="emailInput" name="email" value="{{ old('email') }}" placeholder="Email" required>
                        <label for="emailInput">Email</label>
                    </div>
                    <div class="form-floating mb-2 mb-md-3">
                        <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Mật khẩu" required>
                        <label for="passwordInput">Mật khẩu</label>
                    </div>
                    <button type="submit" class="btn">Đăng nhập</button>
                </form>

                <p class="mt-4">Bạn chưa có tài khoản? <a class="ms-1" href="{{ route('register') }}">Đăng ký ngay</a></p>
            </div>
        </div>
    </div>
</body>
</html>
