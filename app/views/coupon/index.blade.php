@extends('admin.layout')
@section('title', 'Quản lý mã giảm giá')
@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Quản lý mã giảm giá</h2>
        <a href="/coupon/add" class="btn btn-dark">
            <i class="fas fa-plus"></i> Thêm mã mới
        </a>
    </div>

    <div class="table-responsive shadow-sm">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Mã (Code)</th>
                    <th>Loại</th>
                    <th>Giá trị</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Giới hạn</th>
                    <th>Đã dùng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($coupons as $item)
                <tr>
                    <td><strong>{{ $item['code'] }}</strong></td>
                    <td>{{ $item['discount_type'] }}</td>
                    <td>{{ number_format($item['discount_value'], 0, ',', '.') }}</td>
                    <td>{{ $item['start_date'] }}</td>
                    <td>{{ $item['end_date'] }}</td>
                    <td>{{ $item['usage_limit'] }}</td>
                    <td>{{ $item['used_count'] }}</td>
                    <td>
                        <a href="/coupon/delete/{{ $item['id'] }}" class="btn btn-sm btn-danger" onclick="return confirm('Xóa mã giảm giá này?')">
                            <i class="fas fa-trash"></i> Xóa
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-5">Chưa có mã giảm giá nào</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
