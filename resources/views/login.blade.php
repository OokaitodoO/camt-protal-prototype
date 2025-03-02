<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <h1>Login page</h1>
        <div class="login-card">
            <div class="login-action">
                <a href="{{route('department')}}" class="btn">เข้าสู่ระบบ</a>
            </div>
        </div>
    </div>
</body>
</html>