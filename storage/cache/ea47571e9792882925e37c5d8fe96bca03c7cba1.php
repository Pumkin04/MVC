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

    /* Product Card */
    .product-card {
      border: 1px solid #eee;
      border-radius: 12px;
      transition: all 0.3s ease;
      background: #fff;
    }
    .product-card:hover {
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      transform: translateY(-5px);
    }
    .product-price {
      font-size: 1.1rem;
      font-weight: 700;
      color: var(--primary-color);
    }

    /* Sidebar */
    .sidebar-widget {
        background: var(--bg-light);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .list-group-item {
        background: transparent;
        border: none;
        padding: 0.75rem 0;
        color: var(--text-dark);
        font-weight: 500;
        transition: color 0.2s;
    }
    .list-group-item:hover {
        color: var(--primary-color);
    }
    .list-group-item.active {
        color: var(--primary-color);
        background: transparent;
        font-weight: 700;
    }

    .form-control {
      border-radius: 8px;
    }

    .btn-primary {
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-wishlist {
        border-radius: 8px;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .btn-wishlist:hover {
        transform: scale(1.15);
        background-color: #ff4757;
        color: white !important;
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
          <li class="nav-item"><a class="nav-link active" href="/home/shop">Cửa hàng</a></li>
          <li class="nav-item"><a class="nav-link" href="/order/history">Đơn hàng</a></li>
          <li class="nav-item"><a class="nav-link" href="/contact/index">Liên hệ</a></li>
        </ul>

        <div class="d-flex gap-2 align-items-center">
            <form class="d-flex" role="search" action="/home/shop" method="GET">
                <input class="form-control me-2 rounded-2" type="search" name="search" value="<?php echo e($search ?? ''); ?>" placeholder="Tìm sản phẩm..." />
                <button class="btn btn-outline-primary" type="submit">Tìm</button>
            </form>
            
            <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>
                <a href="/admin/Admin" class="btn btn-primary btn-sm">Admin</a>
            <?php endif; ?>

            <div class="ms-2">
                <?php if(isset($_SESSION['user'])): ?>
                    <div class="dropdown d-inline-block">
                        <a href="#" class="text-dark text-decoration-none small dropdown-toggle" data-bs-toggle="dropdown">
                            Chào, <?php echo e($_SESSION['user']['username']); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-3 mt-2">
                            <li><a class="dropdown-item py-2" href="/profile/index"><i class="fas fa-user-circle me-2"></i> Tài khoản</a></li>
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

  <!-- Main Content -->
  <main class="container py-5">
    <div class="row g-4">

      <!-- Sidebar -->
      <aside class="col-12 col-lg-3">
        <div class="sidebar-widget text-center py-4 bg-primary text-white mb-4">
            <h4 class="fw-bold mb-0">CỬA HÀNG</h4>
        </div>

        <div class="sidebar-widget">
            <h6 class="fw-bold mb-3 text-uppercase small">Danh mục sản phẩm</h6>
            <div class="list-group">
                <a href="/home/shop" class="list-group-item list-group-item-action <?php echo e(empty($cat_id) ? 'active' : ''); ?>">Tất cả</a>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="/home/shop?category=<?php echo e($cat['id']); ?>" class="list-group-item list-group-item-action <?php echo e((isset($cat_id) && $cat_id == $cat['id']) ? 'active' : ''); ?>"><?php echo e($cat['name']); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="sidebar-widget">
            <h6 class="fw-bold mb-3 text-uppercase small">Lọc theo giá</h6>
            <form action="/home/shop" method="GET">
                <?php if(!empty($cat_id)): ?> <input type="hidden" name="category" value="<?php echo e($cat_id); ?>"> <?php endif; ?>
                <?php if(!empty($search)): ?> <input type="hidden" name="search" value="<?php echo e($search); ?>"> <?php endif; ?>
                <div class="d-flex gap-2 mb-3">
                  <input class="form-control form-control-sm" name="min_price" value="<?php echo e($min_price ?? ''); ?>" placeholder="Từ" type="number" />
                  <input class="form-control form-control-sm" name="max_price" value="<?php echo e($max_price ?? ''); ?>" placeholder="Đến" type="number" />
                </div>
                <button type="submit" class="btn btn-primary btn-sm w-100">Áp dụng</button>
                <?php if(!empty($min_price) || !empty($max_price)): ?>
                    <a href="/home/shop<?php echo e(!empty($cat_id) ? '?category='.$cat_id : ''); ?>" class="btn btn-link btn-sm w-100 text-decoration-none mt-2">Xóa lọc giá</a>
                <?php endif; ?>
            </form>
        </div>
      </aside>

      <!-- Store Main -->
      <section class="col-12 col-lg-9">
        <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-muted">Trang chủ</a></li>
              <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
            </ol>
          </nav>

          <div class="d-flex gap-2">
            <select class="form-select form-select-sm" style="min-width: 150px;">
              <option selected>Sắp xếp mặc định</option>
              <option>Giá từ thấp đến cao</option>
              <option>Giá từ cao đến thấp</option>
              <option>Mới nhất</option>
            </select>
          </div>
        </div>

        <div class="row g-4">
          <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="card product-card h-100 border-0 shadow-sm">
              <?php if(!empty($product['image'])): ?>
                <img src="/uploads/<?php echo e($product['image']); ?>" class="card-img-top" alt="<?php echo e($product['name']); ?>" style="height: 200px; object-fit: cover;">
              <?php else: ?>
                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                  <i class="fas fa-image fa-3x text-secondary opacity-25"></i>
                </div>
              <?php endif; ?>
              <div class="card-body p-3">
                <h6 class="card-title text-truncate mb-2"><?php echo e($product['name']); ?></h6>
                <p class="product-price mb-3 text-primary"><?php echo e(number_format($product['price'])); ?> đ</p>
                <div class="d-flex gap-2">
                   <a href="/product/detail/<?php echo e($product['id']); ?>" class="btn btn-sm btn-outline-primary w-100">Chi tiết</a>
                   <?php $inWishlist = in_array($product['id'], $wishlistIds ?? []); ?>
                   <a href="/wishlist/toggle/<?php echo e($product['id']); ?>" 
                      class="btn btn-sm btn-outline-danger btn-wishlist <?php echo e($inWishlist ? 'active' : ''); ?>" 
                      data-id="<?php echo e($product['id']); ?>"
                      onclick="toggleWishlist(event, this)"
                      title="Yêu thích">
                        <i class="<?php echo e($inWishlist ? 'fas' : 'far'); ?> fa-heart"></i>
                   </a>
                   <a href="/cart/add/<?php echo e($product['id']); ?>" class="btn btn-sm btn-primary w-100">Thêm</a>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <div class="col-12 text-center py-5">
            <i class="fas fa-search fa-3x text-light mb-3"></i>
            <p class="text-muted">Không tìm thấy sản phẩm nào phù hợp.</p>
          </div>
          <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if($totalPages > 1): ?>
        <?php
            $queryString = [];
            if(!empty($cat_id)) $queryString['category'] = $cat_id;
            if(!empty($min_price)) $queryString['min_price'] = $min_price;
            if(!empty($max_price)) $queryString['max_price'] = $max_price;
            if(!empty($search)) $queryString['search'] = $search;
            $queryPart = count($queryString) > 0 ? '?' . http_build_query($queryString) : '';
        ?>
        <nav class="mt-5">
          <ul class="pagination justify-content-center">
            <li class="page-item <?php echo e($currentPage <= 1 ? 'disabled' : ''); ?>">
                <a class="page-link" href="/home/shop/<?php echo e($currentPage - 1); ?><?php echo e($queryPart); ?>">Trình trước</a>
            </li>
            
            <?php for($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo e($currentPage == $i ? 'active' : ''); ?>">
                <a class="page-link" href="/home/shop/<?php echo e($i); ?><?php echo e($queryPart); ?>"><?php echo e($i); ?></a>
            </li>
            <?php endfor; ?>

            <li class="page-item <?php echo e($currentPage >= $totalPages ? 'disabled' : ''); ?>">
                <a class="page-link" href="/home/shop/<?php echo e($currentPage + 1); ?><?php echo e($queryPart); ?>">Trình sau</a>
            </li>
          </ul>
        </nav>
        <?php endif; ?>
      </section>

    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-light mt-5 py-5 border-top">
    <div class="container text-center">
      <div class="mb-4">
        <h5 class="fw-bold text-primary">MYSTORE</h5>
        <div class="d-flex justify-content-center gap-4 mt-3">
          <a href="/" class="text-muted text-decoration-none small">Trang chủ</a>
          <a href="/home/shop" class="text-muted text-decoration-none small">Cửa hàng</a>
          <a href="/contact/index" class="text-muted text-decoration-none small">Hỗ trợ</a>
        </div>
      </div>
      <div class="text-muted small">© 2026 MYSTORE Tech. Sản phẩm được thiết kế chuyên nghiệp.</div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
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
                } else {
                    element.classList.remove('active');
                    icon.classList.remove('fas');
                    icon.classList.add('far');
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
</body>
</html>
<?php /**PATH D:\Xamppp\xampp moi\htdocs\php2-2026-main\app\views/home/shop.blade.php ENDPATH**/ ?>