<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-user-circle"></i> Login page</h1>
        <div class="login-card">
            <div class="login-icon">
                <i class="fas fa-user fa-4x"></i>
            </div>
            <div class="login-action">
                <a href="{{route('department')}}" class="btn">
                    <i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ
                </a>
            </div>
        </div>
    </div>
</body>
</html>