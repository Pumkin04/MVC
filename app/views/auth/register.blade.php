<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .auth-card { max-width: 450px; margin: 80px auto; border: none; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .card-header { border-radius: 15px 15px 0 0 !important; }
        .btn-dark { border-radius: 10px; padding: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card auth-card">
            <div class="card-header bg-dark text-white text-center py-4">
                <h3 class="mb-0">Đăng Ký Tài Khoản</h3>
            </div>
            <div class="card-body p-4">
                @if(isset($error))
                    <div class="alert alert-danger">{{ $error }}</div>
                @endif
                <form action="/auth/register" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Nhập họ tên" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-dark">
                            <strong>Đăng Ký</strong>
                        </button>
                    </div>
                    <div class="text-center mt-3">
                        <p class="small text-muted">Đã có tài khoản? <a href="/auth/login" class="text-dark">Đăng nhập</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
