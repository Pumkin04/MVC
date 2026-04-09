<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
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
                <h3 class="mb-0">Đổi Mật Khẩu</h3>
            </div>
            <div class="card-body p-4">
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?php echo e($error); ?></div>
                <?php endif; ?>
                <p class="text-muted small mb-4">Nhập mật khẩu mới cho email: <strong><?php echo e($email); ?></strong></p>
                <form action="/auth/resetPassword" method="POST">
                    <input type="hidden" name="email" value="<?php echo e($email); ?>">
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu mới</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu mới" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Xác nhận mật khẩu mới" required>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-dark">
                            <strong>Đổi Mật Khẩu</strong>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\Xamppp\xampp moi\htdocs\php2-2026-main\app\views/auth/reset.blade.php ENDPATH**/ ?>