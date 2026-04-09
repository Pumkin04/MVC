@extends('admin.layout')
@section('title', 'Quản Lý Liên Hệ')
@section('content')
    <div class="container-fluid mt-4">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="row align-items-center g-3">
                    <div class="col-md-4">
                        <h4 class="mb-0">Danh sách Liên hệ</h4>
                    </div>
                    <div class="col-md-8">
                        <form action="/contact/admin_list" method="GET" class="d-flex gap-2 justify-content-md-end">
                            <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Tìm tên, email hoặc chủ đề..." style="max-width: 300px;">
                            <button type="submit" class="btn btn-dark">Tìm kiếm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive shadow-sm">
            <table class="table table-hover table-striped mb-0 align-middle" style="font-size: 0.9rem;">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3" style="width: 50px;">ID</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Ngày gửi</th>
                        <th class="text-center" style="width: 150px;">Thaom tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contacts as $item)
                        <tr>
                            <td class="ps-3"><span class="badge bg-secondary">{{ $item['id'] }}</span></td>
                            <td class="fw-semibold">{{ $item['full_name'] }}</td>
                            <td><a href="mailto:{{ $item['email'] }}" class="text-decoration-none">{{ $item['email'] }}</a></td>
                            <td>{{ $item['phone'] }}</td>
                            <td>{{ $item['subject'] }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($item['created_at'])) }}</td>
                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="/contact/viewDetails/{{ $item['id'] }}" class="btn btn-sm btn-info text-white">Xem</a>
                                    <form action="/contact/delete?q={{ $q }}&page={{ $page }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa liên hệ này?')">
                                        <input type="hidden" name="id" value="{{ $item['id'] }}">
                                        <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">Không tìm thấy liên hệ nào phù hợp.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($totalPages > 1)
            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item {{ $page <= 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="/contact/admin_list?q={{ $q }}&page={{ $page - 1 }}">Trước</a>
                    </li>
                    @for ($i = 1; $i <= $totalPages; $i++)
                        <li class="page-item {{ $page == $i ? 'active' : '' }}">
                            <a class="page-link" href="/contact/admin_list?q={{ $q }}&page={{ $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $page >= $totalPages ? 'disabled' : '' }}">
                        <a class="page-link" href="/contact/admin_list?q={{ $q }}&page={{ $page + 1 }}">Sau</a>
                    </li>
                </ul>
            </nav>
        @endif
    </div>
@endsection
