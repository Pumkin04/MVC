@extends('admin.layout')
@section('title', 'Quản Lý Liên Hệ')
@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Danh sách lời nhắn</h2>
        </div>

        <div class="table-responsive shadow-sm">
            <table class="table table-hover table-striped mb-0 align-middle" style="font-size: 0.9rem;">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3">Họ tên</th>
                        <th>Email</th>
                        <th>Chủ đề</th>
                        <th>Ngày gửi</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contacts as $item)
                        <tr>
                            <td class="ps-3 fw-semibold">{{ $item['full_name'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ $item['subject'] }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($item['created_at'])) }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="/contact/viewDetails/{{ $item['id'] }}" class="btn btn-sm btn-info text-white">Xem</a>
                                    <a href="/contact/delete/{{ $item['id'] }}" class="btn btn-sm btn-danger" onclick="return confirm('Xóa lời nhắn này?')">Xóa</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">Chưa có liên hệ nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection