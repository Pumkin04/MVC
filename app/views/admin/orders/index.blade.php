@extends('admin.layout')

@section('title', 'Quản lý đơn hàng')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Danh sách đơn hàng</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Mã đơn</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th class="text-end pe-4">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-4 fw-bold">#ORD-{{ $order['id'] }}</td>
                        <td>
                            <div class="fw-semibold">{{ $order['customer_name'] }}</div>
                            <small class="text-muted">{{ $order['customer_email'] }}</small>
                        </td>
                        <td>{{ date('d/m/Y H:i', strtotime($order['created_at'])) }}</td>
                        <td class="fw-bold text-primary">{{ number_format($order['total_amount']) }} đ</td>
                        <td>
                            @php
                                $statusClass = [
                                    'pending' => 'bg-warning text-dark',
                                    'processing' => 'bg-info text-white',
                                    'shipped' => 'bg-primary text-white',
                                    'completed' => 'bg-success text-white',
                                    'cancelled' => 'bg-danger text-white'
                                ][$order['status']] ?? 'bg-secondary';
                                
                                $statusName = [
                                    'pending' => 'Chờ xử lý',
                                    'processing' => 'Đang xử lý',
                                    'shipped' => 'Đang giao',
                                    'completed' => 'Đã hoàn thành',
                                    'cancelled' => 'Đã hủy'
                                ][$order['status']] ?? $order['status'];
                            @endphp
                            <span class="badge {{ $statusClass }} rounded-pill px-3">{{ $statusName }}</span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="/Admin/orderDetail/{{ $order['id'] }}" class="btn btn-sm btn-outline-dark">Xem chi tiết</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Chưa có đơn hàng nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
