<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title }} - MyStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #007aff;
            --bg-light: #f5f5f7;
        }
        body {
            background-color: var(--bg-light);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        .checkout-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid #d2d2d7;
            background-color: #fff;
        }
        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(0, 122, 255, 0.1);
            border-color: var(--primary-color);
        }
        .order-summary-item {
            padding: 1rem 0;
            border-bottom: 1px solid #edeff2;
        }
        .order-summary-item:last-child {
            border-bottom: none;
        }
        .btn-confirm {
            background-color: var(--primary-color);
            border: none;
            border-radius: 12px;
            padding: 1rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-confirm:hover {
            background-color: #0062cc;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="/">MYSTORE</a>
            <a href="/cart/index" class="btn btn-link text-dark text-decoration-none small">
                <i class="fas fa-arrow-left me-2"></i> Quay lại giỏ hàng
            </a>
        </div>
    </nav>

    <main class="container py-5">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="checkout-card card p-4 p-md-5 bg-white">
                    <h2 class="h4 fw-bold mb-4">Thông tin giao hàng</h2>
                    <form action="/checkout/process" method="POST">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold text-muted">Họ và tên</label>
                                <input type="text" name="customer_name" class="form-control" value="{{ $user['username'] ?? '' }}" required placeholder="Nguyễn Văn A">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Email</label>
                                <input type="email" name="customer_email" class="form-control" value="{{ $user['email'] ?? '' }}" required placeholder="email@example.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Số điện thoại</label>
                                <input type="tel" name="customer_phone" class="form-control" required placeholder="0123 456 789">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-muted">Địa chỉ nhận hàng</label>
                                <textarea name="customer_address" class="form-control" rows="3" required placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố"></textarea>
                            </div>
                        </div>

                        <div class="mt-5">
                            <h2 class="h4 fw-bold mb-4">Phương thức thanh toán</h2>
                            <div class="border rounded-3 p-3 d-flex align-items-center bg-light">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" checked id="cod">
                                    <label class="form-check-label fw-semibold ms-2" for="cod">
                                        Thanh toán khi nhận hàng (COD)
                                    </label>
                                </div>
                                <i class="fas fa-money-bill-wave ms-auto text-success fa-lg"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-confirm w-100 mt-5">
                            XÁC NHẬN ĐẶT HÀNG
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="checkout-card card p-4 bg-white sticky-top" style="top: 100px;">
                    <h2 class="h5 fw-bold mb-4">Tóm tắt đơn hàng</h2>
                    <div class="order-summary-list">
                        @foreach($cart as $item)
                        <div class="order-summary-item d-flex gap-3">
                            <div class="position-relative">
                                @if(!empty($item['image']))
                                    <img src="/uploads/{{ $item['image'] }}" width="64" height="64" class="rounded-3 shadow-sm" style="object-fit: cover;">
                                @else
                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                                        <i class="fas fa-box text-secondary opacity-25"></i>
                                    </div>
                                @endif
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary" style="font-size: 10px;">
                                    {{ $item['quantity'] }}
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 small fw-bold text-truncate" style="max-width: 180px;">{{ $item['name'] }}</h6>
                                <small class="text-muted">{{ number_format($item['price']) }} đ</small>
                            </div>
                            <div class="text-end fw-semibold small">
                                {{ number_format($item['price'] * $item['quantity']) }} đ
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-4 pt-4 border-top">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Tạm tính</span>
                            <span class="fw-semibold">{{ number_format($total) }} đ</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-muted small">Phí vận chuyển</span>
                            <span class="text-success small fw-bold">Miễn phí</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="fw-bold mb-0">Tổng cộng</h5>
                            <h5 class="fw-bold mb-0 text-primary">{{ number_format($total) }} đ</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-5 text-center text-muted small">
        © 2026 MYSTORE Tech. An tâm mua sắm.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
