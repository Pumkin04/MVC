<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title }} - MyShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .cart-item-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }
        .quantity-control {
            max-width: 120px;
        }
        .btn-quantity {
            width: 32px;
            height: 32px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        .card {
            border: none;
            border-radius: 12px;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="/home/index">MyShop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="nav" class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="/home/index">Home</a></li>
                </ul>
                <div class="d-flex gap-2 align-items-center">
                    <a href="/cart/index" class="btn btn-outline-dark position-relative">
                        Cart
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

    <main class="container py-5">
        <h1 class="h3 mb-4 fw-bold">Giỏ hàng của bạn</h1>

        @if(isset($_SESSION['error']))
            <div class="alert alert-warning alert-dismissible fade show rounded-4 shadow-sm border-0 mb-4" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ $_SESSION['error'] }}
                @php unset($_SESSION['error']); @endphp
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(!empty($cart))
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm p-3">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="text-muted small text-uppercase">
                                <tr>
                                    <th scope="col" class="border-0">Sản phẩm</th>
                                    <th scope="col" class="border-0 text-center">Số lượng</th>
                                    <th scope="col" class="border-0 text-end">Giá</th>
                                    <th scope="col" class="border-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($cart as $id => $item)
                                @php $total += $item['price'] * $item['quantity']; @endphp
                                <tr>
                                    <td class="border-0 py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            @if(!empty($item['image']))
                                                <img src="/uploads/{{ $item['image'] }}" class="cart-item-img" alt="{{ $item['name'] }}">
                                            @else
                                                <div class="cart-item-img bg-secondary-subtle d-flex align-items-center justify-content-center">
                                                    <span class="text-muted" style="font-size: 10px;">No Image</span>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-0 fw-semibold">{{ $item['name'] }}</h6>
                                                <small class="text-muted">{{ number_format($item['price'], 0, ',', '.') }} đ</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-0 text-center py-3">
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            <a href="/cart/update/{{ $id }}?type=minus" class="btn btn-sm btn-outline-secondary btn-quantity">-</a>
                                            <span class="fw-semibold px-2">{{ $item['quantity'] }}</span>
                                            <a href="/cart/update/{{ $id }}?type=plus" class="btn btn-sm btn-outline-secondary btn-quantity">+</a>
                                        </div>
                                    </td>
                                    <td class="border-0 text-end py-3 fw-bold">
                                        {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} đ
                                    </td>
                                    <td class="border-0 text-end py-3">
                                        <a href="/cart/delete/{{ $id }}" class="text-danger p-2" onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="/home/index" class="btn btn-link text-dark text-decoration-none">Tiếp tục mua sắm</a>
                    <a href="/cart/clear" class="btn btn-outline-danger" onclick="return confirm('Xóa sạch giỏ hàng?')">Xóa tất cả</a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm p-4">
                    <h5 class="fw-bold mb-4">Tổng cộng</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tạm tính</span>
                        <span>{{ number_format($total, 0, ',', '.') }} đ</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-muted">Phí vận chuyển</span>
                        <span class="text-success">Miễn phí</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4 mt-2">
                        <span class="fw-bold h5 mb-0">Thành tiền</span>
                        <span class="fw-bold h5 mb-0 text-danger">{{ number_format($total, 0, ',', '.') }} đ</span>
                    </div>
                    <a href="/checkout/index" class="btn btn-primary w-100 py-3 fw-bold">THANH TOÁN NGAY</a>
                    <div class="text-center mt-3">
                        <small class="text-muted">Đảm bảo an toàn 100%</small>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-5">
            <h4 class="fw-bold">Giỏ hàng của bạn đang trống</h4>
            <p class="text-muted">Hãy lấp đầy nó bằng những sản phẩm tuyệt vời!</p>
            <a href="/home/index" class="btn btn-primary px-5 py-3 mt-3 fw-bold">MUA SẮM NGAY</a>
        </div>
        @endif
    </main>

    <footer class="border-top bg-white py-4 mt-5">
        <div class="container text-center">
            <div class="text-muted small">© 2026 MyShop. All rights reserved.</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
