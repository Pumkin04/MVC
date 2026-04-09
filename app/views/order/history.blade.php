<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title }} - MyStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .order-card {
            border: none;
            border-radius: 12px;
            transition: all 0.3s;
        }
        .order-card:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        .badge-pending { bg-warning; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="/">MYSTORE</a>
            <div class="d-flex align-items-center gap-3">
                <a href="/" class="text-dark text-decoration-none small">Trang chủ</a>
                <a href="/order/history" class="btn btn-primary btn-sm rounded-pill px-3">Lịch sử</a>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <h2 class="fw-bold mb-4">Lịch sử đặt hàng</h2>

        @if(isset($_SESSION['error']))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ $_SESSION['error'] }}
            @php unset($_SESSION['error']); @endphp
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @forelse($orders as $order)
        <div class="card order-card mb-3 shadow-sm">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <div class="small text-muted mb-1">Mã đơn hàng</div>
                        <div class="fw-bold">#ORD-{{ $order['id'] }}</div>
                    </div>
                    <div class="col-md-3">
                        <div class="small text-muted mb-1">Ngày đặt</div>
                        <div>{{ date('d/m/Y H:i', strtotime($order['created_at'])) }}</div>
                    </div>
                    <div class="col-md-2">
                        <div class="small text-muted mb-1">Tổng tiền</div>
                        <div class="fw-bold text-primary">{{ number_format($order['total_amount']) }} đ</div>
                    </div>
                    <div class="col-md-3">
                        <div class="small text-muted mb-1">Trạng thái</div>
                        @php
                            $statusMap = [
                                'pending' => ['text' => 'Chờ xử lý', 'class' => 'bg-warning text-dark'],
                                'processing' => ['text' => 'Đang xử lý', 'class' => 'bg-info text-white'],
                                'shipped' => ['text' => 'Đang giao', 'class' => 'bg-primary text-white'],
                                'completed' => ['text' => 'Đã hoàn thành', 'class' => 'bg-success text-white'],
                                'cancelled' => ['text' => 'Đã hủy', 'class' => 'bg-danger text-white']
                            ];
                            $status = $statusMap[$order['status']] ?? ['text' => $order['status'], 'class' => 'bg-secondary'];
                        @endphp
                        <span class="badge {{ $status['class'] }} rounded-pill px-3">{{ $status['text'] }}</span>
                    </div>
                    <div class="col-md-2 text-md-end d-flex gap-2 justify-content-end align-items-center">
                        <a href="/order/reorder/{{ $order['id'] }}" class="btn btn-outline-primary btn-sm rounded-pill px-3" title="Mua lại tất cả sản phẩm trong đơn này">Mua lại</a>
                        <a href="/order/detail/{{ $order['id'] }}" class="btn btn-outline-dark btn-sm rounded-pill px-3">Chi tiết</a>
                        @if($order['status'] !== 'completed')
                        <a href="/order/delete/{{ $order['id'] }}" class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">Xóa</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-5 bg-white rounded-4 shadow-sm">
            <i class="fas fa-shopping-bag fa-3x text-light mb-3"></i>
            <h5 class="text-muted">Bạn chưa có đơn hàng nào.</h5>
            <a href="/home/shop" class="btn btn-primary mt-3">Mua sắm ngay</a>
        </div>
        @endforelse
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
