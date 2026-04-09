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
      --bg-light: #f8f9fa;
      --text-dark: #212529;
    }
    body { font-family: 'Inter', sans-serif; background-color: #fff; }
    .navbar { background: #fff !important; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    .navbar-brand { font-weight: 700; color: var(--primary-color) !important; }
    .product-card { border: 1px solid #eee; border-radius: 12px; transition: all 0.3s; }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
    .btn-remove { color: #dc3545; background: #fff5f5; border: none; padding: 0.5rem; border-radius: 8px; transition: 0.2s; }
    .btn-remove:hover { background: #dc3545; color: #fff; transform: rotate(15deg); }
    
    .text-primary.position-relative i:hover {
        animation: heartBeat 0.8s infinite;
    }
    @keyframes heartBeat {
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
      <div id="nav" class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link" href="/">Trang chủ</a></li>
          <li class="nav-item"><a class="nav-link" href="/home/shop">Cửa hàng</a></li>
        </ul>
        <div class="d-flex align-items-center gap-3">
            <a href="/cart/index" class="text-dark position-relative"><i class="fas fa-shopping-basket fa-lg"></i></a>
            <a href="/wishlist/index" class="text-primary position-relative"><i class="fas fa-heart fa-lg"></i></a>
        </div>
      </div>
    </div>
  </nav>

  <main class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Sản phẩm yêu thích</h2>
        <p class="text-muted">Danh sách các sản phẩm bạn đã lưu lại</p>
    </div>

    @if(empty($wishlist))
    <div class="text-center py-5">
        <div class="mb-4 text-muted opacity-25">
            <i class="fas fa-heart fa-5x"></i>
        </div>
        <h5>Danh sách yêu thích trống</h5>
        <p class="text-muted">Hãy thêm những sản phẩm bạn yêu thích để xem lại sau nhé.</p>
        <a href="/home/shop" class="btn btn-primary mt-3">Tiếp tục mua sắm</a>
    </div>
    @else
    <div class="row g-4">
        @foreach($wishlist as $item)
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card product-card h-100 border-0 shadow-sm">
                <div class="position-absolute top-0 end-0 p-2">
                    <a href="/wishlist/remove/{{ $item['product_id'] }}" class="btn-remove">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>
                @if(!empty($item['image']))
                  <img src="/uploads/{{ $item['image'] }}" class="card-img-top" alt="{{ $item['name'] }}" style="height: 200px; object-fit: cover; border-radius: 12px 12px 0 0;">
                @else
                  <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px; border-radius: 12px 12px 0 0;">
                    <i class="fas fa-image fa-3x text-secondary opacity-25"></i>
                  </div>
                @endif
                <div class="card-body p-3">
                    <h6 class="card-title text-truncate mb-2">{{ $item['name'] }}</h6>
                    <p class="fw-bold text-primary mb-3">{{ number_format($item['price']) }} đ</p>
                    <div class="d-flex gap-2">
                        <a href="/product/detail/{{ $item['product_id'] }}" class="btn btn-sm btn-outline-primary w-100">Chi tiết</a>
                        <a href="/cart/add/{{ $item['product_id'] }}" class="btn btn-sm btn-primary w-100">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
