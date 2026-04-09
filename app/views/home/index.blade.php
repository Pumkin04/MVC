<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $title }}</title>
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

    /* Hero Section */
    .hero-banner {
      background: linear-gradient(rgba(0,0,0,0.05), rgba(0,0,0,0.05)), url('/uploads/Anno117PaxRomana.jpg');
      background-size: cover;
      background-position: center;
      padding: 100px 0;
      border-radius: 12px;
      margin: 2rem 0;
    }

    /* Modern Card */
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
    .product-card .card-img-top {
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
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

    /* Buttons */
    .btn-primary {
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
    }
    .btn-outline-primary {
        border-radius: 8px;
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
    @keyframes heartBeat {
        0% { transform: scale(1); }
        14% { transform: scale(1.3); }
        28% { transform: scale(1); }
        42% { transform: scale(1.3); }
        70% { transform: scale(1); }
    }
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
          <li class="nav-item"><a class="nav-link active" href="/">Trang chủ</a></li>
          <li class="nav-item"><a class="nav-link" href="/home/shop">Cửa hàng</a></li>
          <li class="nav-item"><a class="nav-link" href="/order/history">Đơn hàng</a></li>
          <li class="nav-item"><a class="nav-link" href="/contact/index">Liên hệ</a></li>
        </ul>

        <div class="d-flex gap-2 align-items-center">
            <form class="d-flex" role="search">
                <input class="form-control me-2 rounded-2" type="search" placeholder="Tìm sản phẩm..." />
                <button class="btn btn-outline-primary" type="submit">Tìm</button>
            </form>
            
            @if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin')
                <a href="/admin/Admin" class="btn btn-primary btn-sm">Admin</a>
            @endif

            <div class="ms-2">
                @if(isset($_SESSION['user']))
                    <div class="dropdown d-inline-block">
                        <a href="#" class="text-dark text-decoration-none small dropdown-toggle" data-bs-toggle="dropdown">
                            Chào, {{ $_SESSION['user']['username'] }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-3 mt-2">
                            <li><a class="dropdown-item py-2" href="/profile/index"><i class="fas fa-user-circle me-2"></i> Tài khoản</a></li>
                            <li><a class="dropdown-item py-2 text-danger" href="/auth/logout"><i class="fas fa-sign-out-alt me-2"></i> Đăng xuất</a></li>
                        </ul>
                    </div>
                @else
                    <a href="/auth/login" class="btn btn-link text-dark text-decoration-none fw-500">Đăng nhập</a>
                @endif
            </div>

            <a href="/wishlist/index" class="btn btn-outline-primary position-relative ms-2">
                <i class="fas fa-heart"></i>
                <!-- Future: Add wishlist count badge here -->
            </a>

            <a href="/cart/index" class="btn btn-outline-dark position-relative ms-2">
                <i class="fas fa-shopping-basket"></i>
                @if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ count($_SESSION['cart']) }}
                </span>
                @endif
            </a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <div class="container">
    <div class="hero-banner d-flex align-items-center">
        <div class="container px-5 text-white">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-3">Sản phẩm công nghệ mới nhất</h1>
                    <p class="lead mb-4">Trải nghiệm những thiết bị hàng đầu với giá cả hợp lý và dịch vụ tận tâm.</p>
                    <a href="/home/shop" class="btn btn-primary btn-lg px-5">Mua ngay</a>
                </div>
            </div>
        </div>
    </div>
  </div>

  <!-- Main Content -->
  <main class="container py-4">
    <div class="row g-4">


      <!-- Product Listing -->
      <section class="col-12">
        <div class="d-flex align-items-center justify-content-between mb-4">
          <h2 class="h4 fw-bold mb-0">Sản phẩm nổi bật</h2>
          <a href="/home/shop" class="text-primary text-decoration-none">Xem tất cả <i class="fas fa-arrow-right ms-1"></i></a>
        </div>

        <div class="row g-4">
          @forelse ($products as $product)
          <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card product-card h-100 border-0">
              @if(!empty($product['image']))
                <img src="/uploads/{{ $product['image'] }}" class="card-img-top" alt="{{ $product['name'] }}" style="height: 220px; object-fit: cover;">
              @else
                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 220px;">
                  <i class="fas fa-box fa-3x text-secondary opacity-25"></i>
                </div>
              @endif
              <div class="card-body p-3">
                <h6 class="card-title text-truncate mb-2">{{ $product['name'] }}</h6>
                <p class="product-price mb-3">{{ number_format($product['price']) }} đ</p>
                <div class="d-flex gap-2">
                   <a href="/product/detail/{{ $product['id'] }}" class="btn btn-sm btn-outline-primary w-100">Chi tiết</a>
                   @php $inWishlist = in_array($product['id'], $wishlistIds ?? []); @endphp
                   <a href="/wishlist/toggle/{{ $product['id'] }}" 
                      class="btn btn-sm btn-outline-danger btn-wishlist {{ $inWishlist ? 'active' : '' }}" 
                      data-id="{{ $product['id'] }}"
                      onclick="toggleWishlist(event, this)"
                      title="Yêu thích">
                        <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart"></i>
                   </a>
                   <a href="/cart/add/{{ $product['id'] }}" class="btn btn-sm btn-primary w-100">Mua ngay</a>
                </div>
              </div>
            </div>
          </div>
          @empty
          <div class="col-12 text-center py-5">
            <p class="text-muted">Chưa có sản phẩm nào được hiển thị.</p>
          </div>
          @endforelse
        </div>
      </section>
    </div>

    <!-- Contact Banner -->
    <div id="contact" class="mt-5 pt-4 pb-5">
        <div class="row g-0 rounded-4 overflow-hidden shadow-lg border">
            <div class="col-lg-5">
                <div class="contact-info-card h-100">
                    <h2 class="fw-bold mb-4">Liên hệ với chúng tôi</h2>
                    <p class="mb-5 opacity-75">Bạn có thắc mắc về sản phẩm hay dịch vụ? Đội ngũ hỗ trợ của MyStore luôn sẵn sàng giải đáp.</p>
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-white text-primary rounded-circle p-2 me-3">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>0123 456 789</div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-white text-primary rounded-circle p-2 me-3">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>support@mystore.com</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 bg-white p-4 p-md-5">
                @if(isset($_GET['contact_success']))
                    <div class="alert alert-success border-0 mb-4">
                        Cảm ơn bạn! Thông tin đã được gửi thành công.
                    </div>
                @endif
                <form action="/contact/submit" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Họ tên</label>
                            <input type="text" name="full_name" class="form-control" required />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" required />
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Lời nhắn</label>
                            <textarea name="message" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="col-12 mt-4 text-end">
                            <button type="submit" class="btn btn-primary px-5">Gửi thông tin</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-light mt-5 py-5 border-top">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-4">
          <h5 class="fw-bold mb-4 text-primary">MYSTORE</h5>
          <p class="text-muted small">Cung cấp giải pháp công nghệ hiện đại cho đời sống thông minh. Uy tín và chất lượng là ưu tiên hàng đầu.</p>
        </div>
        <div class="col-lg-2">
          <h6 class="fw-bold mb-4">Liên kết</h6>
          <ul class="list-unstyled small">
            <li class="mb-2"><a href="/" class="text-muted text-decoration-none">Trang chủ</a></li>
            <li class="mb-2"><a href="/home/shop" class="text-muted text-decoration-none">Cửa hàng</a></li>
            <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Chính sách</a></li>
          </ul>
        </div>
        <div class="col-lg-3">
          <h6 class="fw-bold mb-4">Hỗ trợ</h6>
          <p class="text-muted small mb-1">Thứ 2 - Chủ nhật</p>
          <p class="text-muted small">08:00 - 21:00</p>
        </div>
        <div class="col-lg-3 text-lg-end">
          <div class="d-flex gap-3 justify-content-lg-end">
            <a href="#" class="text-muted"><i class="fab fa-facebook fa-xl"></i></a>
            <a href="#" class="text-muted"><i class="fab fa-instagram fa-xl"></i></a>
            <a href="#" class="text-muted"><i class="fab fa-youtube fa-xl"></i></a>
          </div>
        </div>
      </div>
      <hr class="my-4 opacity-10">
      <div class="text-center text-muted small">© 2026 MYSTORE Tech. All rights reserved.</div>
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
