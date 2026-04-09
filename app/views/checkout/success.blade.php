<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Đặt hàng thành công - MyStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f5f5f7;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        .success-card {
            max-width: 500px;
            width: 100%;
            background: white;
            padding: 3rem;
            border-radius: 24px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        .success-icon {
            width: 80px;
            height: 80px;
            background: #e1f5fe;
            color: #007aff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 2.5rem;
            animation: bounceIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); opacity: 1; }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); }
        }
        .btn-home {
            background-color: #007aff;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        .btn-home:hover {
            background-color: #0062cc;
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        <h1 class="h3 fw-bold mb-3">Đặt hàng thành công!</h1>
        <p class="text-muted mb-4">Cảm ơn bạn đã mua sắm tại MyStore. Mã đơn hàng của bạn là **#ORD-{{ $order['id'] }}**. Chúng tôi đã gửi thông tin xác nhận qua email của bạn.</p>
        
        <div class="bg-light p-3 rounded-4 mb-4 text-start">
            <div class="d-flex justify-content-between mb-2 small">
                <span class="text-muted">Khách hàng:</span>
                <span class="fw-bold">{{ $order['customer_name'] }}</span>
            </div>
            <div class="d-flex justify-content-between mb-2 small">
                <span class="text-muted">Tổng cộng:</span>
                <span class="fw-bold text-primary">{{ number_format($order['total_amount']) }} đ</span>
            </div>
            <div class="d-flex justify-content-between small">
                <span class="text-muted">Trạng thái:</span>
                <span class="badge bg-primary rounded-pill">Đang chờ xử lý</span>
            </div>
        </div>

        <a href="/" class="btn-home w-100">QUAY LẠI TRANG CHỦ</a>
    </div>
</body>
</html>
