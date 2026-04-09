<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo e($title); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #0d6efd;
      --secondary-color: #6c757d;
      --bg-light: #f8f9fa;
      --text-dark: #212529;
      --text-muted: #6c757d;
    }

    body {
      background-color: #ffffff;
      color: var(--text-dark);
      font-family: 'Inter', sans-serif;
      line-height: 1.6;
    }

    /* Navbar */
    .navbar {
      background: #ffffff !important;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      padding: 0.8rem 0;
    }
    .navbar-brand {
      font-weight: 700;
      font-size: 1.5rem;
      color: var(--primary-color) !important;
    }
    .nav-link {
        font-weight: 500;
        color: var(--text-dark) !important;
        margin: 0 0.5rem;
    }
    .nav-link:hover {
        color: var(--primary-color) !important;
    }

    /* Product Detail */
    .detail-container {
        padding: 4rem 0;
    }
    .product-image-container {
        background: var(--bg-light);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        overflow: hidden;
    }
    .product-image-container img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        transition: transform 0.3s ease;
    }
    .product-image-container img:hover {
        transform: scale(1.05);
    }
    .product-info {
        padding-left: 2rem;
    }
    .product-category {
        text-transform: uppercase;
        font-weight: 700;
        font-size: 0.8rem;
        color: var(--primary-color);
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
        display: block;
    }
    .product-title {
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
        color: var(--text-dark);
    }
    .product-price {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 2rem;
    }
    .product-meta {
        margin-bottom: 2.5rem;
        padding: 1.5rem;
        background: var(--bg-light);
        border-radius: 12px;
    }
    .meta-item {
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
    }
    .meta-label {
        font-weight: 600;
        width: 120px;
        color: var(--text-muted);
    }
    .meta-value {
        font-weight: 600;
        color: var(--text-dark);
    }
    .product-description {
        color: var(--text-muted);
        margin-bottom: 2.5rem;
        font-size: 1.1rem;
    }

    /* Quantity & Buttons */
    .quantity-input {
        max-width: 100px;
        border-radius: 8px;
        text-align: center;
        border: 1px solid #ddd;
    }
    .btn-buy {
        padding: 1rem 3rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1.1rem;
    }
    .btn-add-cart {
        padding: 1rem 2rem;
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-wishlist {
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .btn-wishlist:hover {
        transform: scale(1.1);
        background-color: #fff5f5;
        color: #ff4757 !important;
        border-color: #ff4757;
    }
    .btn-wishlist:hover i {
        animation: heartBeat 0.8s infinite;
    }
    .btn-wishlist.active {
        background-color: #ff4757;
        color: white !important;
        border-color: #ff4757;
    }
    @keyframes  heartBeat {
        0% { transform: scale(1); }
        14% { transform: scale(1.3); }
        28% { transform: scale(1); }
        42% { transform: scale(1.3); }
        70% { transform: scale(1); }
    }

    /* Footer */
    .footer {
      background: var(--bg-light);
      padding: 3rem 0;
      margin-top: 5rem;
      border-top: 1px solid #eee;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
      <a class="navbar-brand" href="/">MYSTORE</a>

      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div id="nav" class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link" href="/">Trang chủ</a></li>
          <li class="nav-item"><a class="nav-link" href="/home/shop">Cửa hàng</a></li>
          <li class="nav-item"><a class="nav-link" href="/order/history">Đơn hàng</a></li>
          <li class="nav-item"><a class="nav-link" href="/contact/index">Liên hệ</a></li>
        </ul>

        <div class="d-flex gap-2 align-items-center">
            <div class="ms-2">
                <?php if(isset($_SESSION['user'])): ?>
                    <div class="dropdown d-inline-block">
                        <a href="#" class="text-dark text-decoration-none small dropdown-toggle" data-bs-toggle="dropdown">
                            Chào, <?php echo e($_SESSION['user']['username']); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-3 mt-2">
                            <li><a class="dropdown-item py-2" href="/profile/index"><i class="fas fa-user-circle me-2"></i> Tài khoản</a></li>
                            <?php if($_SESSION['user']['role'] == 'admin'): ?>
                                <li><a class="dropdown-item py-2" href="/admin/Admin"><i class="fas fa-user-shield me-2"></i> Admin</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider opacity-5"></li>
                            <li><a class="dropdown-item py-2 text-danger" href="/auth/logout"><i class="fas fa-sign-out-alt me-2"></i> Đăng xuất</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="/auth/login" class="btn btn-link text-dark text-decoration-none fw-500">Đăng nhập</a>
                <?php endif; ?>
            </div>

            <a href="/wishlist/index" class="btn btn-outline-primary position-relative ms-2">
                <i class="fas fa-heart"></i>
            </a>

            <a href="/cart/index" class="btn btn-outline-dark position-relative ms-2">
                <i class="fas fa-shopping-basket"></i>
                <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?php echo e(count($_SESSION['cart'])); ?>

                </span>
                <?php endif; ?>
            </a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Detail Content -->
  <main class="container detail-container">
    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-muted">Trang chủ</a></li>
          <li class="breadcrumb-item"><a href="/home/shop" class="text-decoration-none text-muted">Cửa hàng</a></li>
          <li class="breadcrumb-item active text-dark fw-bold" aria-current="page"><?php echo e($product['name']); ?></li>
        </ol>
    </nav>

    <div class="row g-5">
        <!-- Product Image -->
        <div class="col-lg-6">
            <div class="product-image-container">
                <?php if(!empty($product['image'])): ?>
                  <img src="/uploads/<?php echo e($product['image']); ?>" alt="<?php echo e($product['name']); ?>">
                <?php else: ?>
                  <div class="bg-white p-5 d-flex align-items-center justify-content-center" style="height: 400px; border-radius: 12px;">
                    <i class="fas fa-box fa-5x text-secondary opacity-25"></i>
                  </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-lg-6">
            <div class="product-info">
                <span class="product-category"><?php echo e($product['category_name']); ?></span>
                <h1 class="product-title"><?php echo e($product['name']); ?></h1>
                
                <div class="product-price">
                    <?php echo e(number_format($product['price'])); ?> đ
                </div>

                <div class="product-meta">
                    <div class="meta-item">
                        <span class="meta-label">Thương hiệu:</span>
                        <span class="meta-value"><?php echo e($product['brand_name']); ?></span>
                    </div>
                    <?php if(!empty($product['size_name'])): ?>
                    <div class="meta-item">
                        <span class="meta-label">Kích thước:</span>
                        <span class="meta-value badge bg-primary bg-opacity-10 text-primary"><?php echo e($product['size_name']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($product['color_name'])): ?>
                    <div class="meta-item">
                        <span class="meta-label">Màu sắc:</span>
                        <span class="meta-value badge bg-primary bg-opacity-10 text-primary"><?php echo e($product['color_name']); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="meta-item">
                        <span class="meta-label">Tình trạng:</span>
                        <span class="meta-value text-success">Còn hàng (<?php echo e($product['quantity']); ?>)</span>
                    </div>
                </div>

                <div class="product-description">
                    <h5 class="text-dark fw-bold mb-3">Mô tả sản phẩm</h5>
                    <p><?php echo e($product['description'] ? $product['description'] : 'Sản phẩm đang được cập nhật mô tả chi tiết. Vui lòng liên hệ hỗ trợ để biết thêm thông tin.'); ?></p>
                </div>

                <div class="d-flex align-items-center gap-3 mt-5">
                    <div class="d-flex align-items-center border rounded-3 overflow-hidden">
                        <button class="btn btn-light px-3 py-2 border-0" onclick="updateQty(-1)">-</button>
                        <input type="number" id="qty" value="1" class="form-control border-0 text-center fw-bold" style="width: 60px; background: transparent;" readonly>
                        <button class="btn btn-light px-3 py-2 border-0" onclick="updateQty(1)">+</button>
                    </div>
                    <a href="/cart/add/<?php echo e($product['id']); ?>" class="btn btn-primary btn-buy flex-grow-1">Mua ngay</a>
                    <a href="/wishlist/toggle/<?php echo e($product['id']); ?>" 
                       class="btn btn-outline-danger px-3 py-3 rounded-3 btn-wishlist <?php echo e($isInWishlist ? 'active' : ''); ?>" 
                       onclick="toggleWishlist(event, this)"
                       title="<?php echo e($isInWishlist ? 'Xóa khỏi yêu thích' : 'Thêm vào yêu thích'); ?>">
                        <i class="<?php echo e($isInWishlist ? 'fas' : 'far'); ?> fa-heart fa-lg"></i>
                    </a>
                    <a href="/cart/add/<?php echo e($product['id']); ?>" class="btn btn-outline-primary btn-add-cart">
                        <i class="fas fa-cart-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <?php if(!empty($relatedProducts)): ?>
    <div class="mt-5 pt-5 border-top">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="fw-bold mb-0">Sản phẩm liên quan</h3>
            <a href="/home/shop?category=<?php echo e($product['category_id']); ?>" class="text-primary text-decoration-none fw-600">
                Xem tất cả <i class="fas fa-arrow-right ms-1 small"></i>
            </a>
        </div>
        <div class="row g-4">
            <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative" style="transition: transform 0.3s ease;">
                    <?php if(!empty($item['image'])): ?>
                        <img src="/uploads/<?php echo e($item['image']); ?>" class="card-img-top" alt="<?php echo e($item['name']); ?>" style="height: 180px; object-fit: cover;">
                    <?php else: ?>
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                            <i class="fas fa-image fa-2x text-secondary opacity-25"></i>
                        </div>
                    <?php endif; ?>
                    <div class="card-body p-3">
                        <span class="text-primary fw-700 small text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;"><?php echo e($item['category_name']); ?></span>
                        <h6 class="card-title text-truncate mb-2 mt-1" style="font-size: 0.95rem;"><?php echo e($item['name']); ?></h6>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="text-primary fw-bold"><?php echo e(number_format($item['price'])); ?> đ</span>
                            <a href="/product/detail/<?php echo e($item['id']); ?>" class="btn btn-sm btn-link p-0 text-decoration-none text-dark fw-600" style="font-size: 0.8rem;">Chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <div class="container text-center">
      <div class="mb-4">
        <h5 class="fw-bold text-primary">MYSTORE</h5>
      </div>
      <div class="text-muted small">© 2026 MYSTORE Tech. Trải nghiệm mua sắm hiện đại.</div>
    </div>
  </footer>

  <script>
    function updateQty(val) {
        let qty = document.getElementById('qty');
        let current = parseInt(qty.value);
        if (current + val >= 1 && current + val <= <?php echo e($product['quantity']); ?>) {
            qty.value = current + val;
        }
    }

    async function toggleWishlist(event, element) {
        event.preventDefault();
        const url = element.getAttribute('href');
        const icon = element.querySelector('i');

        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();

            if (data.status === 'success') {
                if (data.action === 'added') {
                    element.classList.add('active');
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    element.title = "Xóa khỏi yêu thích";
                } else {
                    element.classList.remove('active');
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    element.title = "Thêm vào yêu thích";
                }
            } else if (data.status === 'unauthorized') {
                alert(data.message);
                window.location.href = '/auth/login';
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH D:\Xamppp\xampp moi\htdocs\php2-2026-main\app\views/product/detail.blade.php ENDPATH**/ ?>