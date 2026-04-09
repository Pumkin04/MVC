<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .auth-card { max-width: 400px; margin: 100px auto; border: none; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .card-header { border-radius: 15px 15px 0 0 !important; }
        .btn-dark { border-radius: 10px; padding: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card auth-card">
            <div class="card-header bg-dark text-white text-center py-4">
                <h3 class="mb-0">Quên Mật Khẩu</h3>
            </div>
            <div class="card-body p-4">
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?php echo e($error); ?></div>
                <?php endif; ?>
                <p class="text-muted small mb-4">Nhập email của bạn để xác thực tài khoản.</p>
                <form action="/auth/forgotPassword" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email đã đăng ký" required>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-dark">
                            <strong>Tiếp Tục</strong>
                        </button>
                    </div>
                    <div class="text-center mt-3">
                        <a href="/auth/login" class="text-dark small text-decoration-none">Quay lại Đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\Xamppp\xampp moi\htdocs\php2-2026-main\app\views/auth/forgot.blade.php ENDPATH**/ ?>