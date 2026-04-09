<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title }} - MyStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f5f5f7; }
        .detail-card { border: none; border-radius: 20px; }
        .status-header { background: #fff; border-radius: 15px; padding: 1.5rem; margin-bottom: 2rem; border: 1px solid #eee; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white border-bottom py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="/">MYSTORE</a>
            <a href="/order/history" class="btn btn-link text-dark text-decoration-none small">
                <i class="fas fa-arrow-left me-2"></i> Quay lại lịch sử
            </a>
        </div>
    </nav>

    <main class="container py-5">
        <div class="status-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">Mã đơn hàng: #ORD-{{ $order['id'] }}</h4>
                <div class="text-muted small">Ngày đặt: {{ date('d/m/Y H:i', strtotime($order['created_at'])) }}</div>
            </div>
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
            <div class="text-end">
                <div class="small text-muted mb-1">Trạng thái</div>
                <span class="badge {{ $status['class'] }} rounded-pill px-4 py-2">{{ $status['text'] }}</span>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card detail-card p-4 shadow-sm bg-white">
                    <h5 class="fw-bold mb-4">Danh sách sản phẩm</h5>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="text-muted small">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($details as $item)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $item['product_name'] }}</div>
                                        <small class="text-muted">{{ number_format($item['product_price']) }} đ</small>
                                    </td>
                                    <td class="text-center">{{ $item['quantity'] }}</td>
                                    <td class="text-end fw-bold">{{ number_format($item['product_price'] * $item['quantity']) }} đ</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 pt-4 border-top d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">TỔNG CỘNG:</h5>
                        <h4 class="fw-bold mb-0 text-primary">{{ number_format($order['total_amount']) }} đ</h4>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card detail-card p-4 shadow-sm bg-white">
                    <h5 class="fw-bold mb-4">Thông tin nhận hàng</h5>
                    <div class="mb-3">
                        <div class="text-muted small">Người nhận</div>
                        <div class="fw-bold">{{ $order['customer_name'] }}</div>
                    </div>
                    <div class="mb-3">
                        <div class="text-muted small">Số điện thoại</div>
                        <div>{{ $order['customer_phone'] }}</div>
                    </div>
                    <div class="mb-3">
                        <div class="text-muted small">Email</div>
                        <div>{{ $order['customer_email'] }}</div>
                    </div>
                    <div class="mb-0">
                        <div class="text-muted small">Địa chỉ</div>
                        <div>{{ $order['customer_address'] }}</div>
                    </div>
                </div>

                <div class="card border-0 bg-primary text-white p-4 mt-4 shadow-sm" style="border-radius: 20px;">
                    <h6 class="fw-bold mb-3"><i class="fas fa-headset me-2"></i> Hỗ trợ khách hàng</h6>
                    <p class="small mb-0 opacity-75">Nếu có bất kỳ thắc mắc nào về đơn hàng, vui lòng liên hệ hotline: **1900 1234** để được hỗ trợ nhanh nhất.</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-5 text-center text-muted small">
        © 2026 MYSTORE Tech. Cảm ơn quý khách.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
