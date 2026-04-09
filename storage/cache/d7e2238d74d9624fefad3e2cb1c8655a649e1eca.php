<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Admin'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            padding-top: 80px;
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top mb-4">
        <div class="container">
            <h1 class="navbar-brand">Admin Page</h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/Admin">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/brand/Brand">Brands</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/product/Product">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/size/Size">Size</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/color/Color">Colors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/coupon/index">Coupons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/User">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/danhmuc/Danhmuc">Danh mục</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact/admin_list">Liên hệ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Admin/orders">Đơn hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">View Site</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php if(isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/auth/logout">Đăng xuất</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/auth/login">Đăng nhập</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH D:\Xamppp\xampp moi\htdocs\php2-2026-main\app\views/admin/layout.blade.php ENDPATH**/ ?>