@extends('admin.layout')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="mb-4">
    <a href="/Admin/orders" class="btn btn-link text-decoration-none p-0 mb-3 text-dark">
        <i class="fas fa-arrow-left me-1"></i> Quay lại danh sách
    </a>
    <div class="d-flex justify-content-between align-items-center">
        <h2>Chi tiết đơn hàng #ORD-{{ $order['id'] }}</h2>
        <div class="text-muted small">Ngày đặt: {{ date('d/m/Y H:i', strtotime($order['created_at'])) }}</div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <!-- Order Items -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white fw-bold">Sản phẩm trong đơn hàng</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Sản phẩm</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-end pe-4">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($details as $item)
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="fw-semibold">{{ $item['product_name'] }}</div>
                                    <small class="text-muted">{{ number_format($item['product_price']) }} đ</small>
                                </td>
                                <td class="text-center">{{ $item['quantity'] }}</td>
                                <td class="text-end pe-4 fw-bold">{{ number_format($item['product_price'] * $item['quantity']) }} đ</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="2" class="text-end fw-bold ps-4">Tổng cộng:</td>
                                <td class="text-end pe-4 fw-bold text-primary" style="font-size: 1.2rem;">{{ number_format($order['total_amount']) }} đ</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Customer Info -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white fw-bold">Thông tin khách hàng</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="text-muted small d-block mb-1">Họ tên</label>
                    <div class="fw-bold">{{ $order['customer_name'] }}</div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small d-block mb-1">Email</label>
                    <div>{{ $order['customer_email'] }}</div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small d-block mb-1">Số điện thoại</label>
                    <div>{{ $order['customer_phone'] }}</div>
                </div>
                <div class="mb-0">
                    <label class="text-muted small d-block mb-1">Địa chỉ giao hàng</label>
                    <div>{{ $order['customer_address'] }}</div>
                </div>
            </div>
        </div>

        <!-- Order Status Update -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold">Cập nhật trạng thái</div>
            <div class="card-body">
                <form action="/Admin/updateOrderStatus/{{ $order['id'] }}" method="POST">
                    <div class="mb-3">
                        <select name="status" class="form-select">
                            <option value="pending" {{ $order['status'] == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                            <option value="processing" {{ $order['status'] == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="shipped" {{ $order['status'] == 'shipped' ? 'selected' : '' }}>Đang giao</option>
                            <option value="completed" {{ $order['status'] == 'completed' ? 'selected' : '' }}>Đã hoàn thành</option>
                            <option value="cancelled" {{ $order['status'] == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">CẬP NHẬT</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
