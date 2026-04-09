@extends('admin.layout')
@section('title', 'Quản Lý Màu Sắc')
@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Quản Lý Màu Sắc</h2>
            <a href="/color/add" class="btn btn-dark">
                Thêm Màu Sắc
            </a>
        </div>

        <div class="table-responsive shadow-sm">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên Màu</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($colors as $item)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $item['id'] }}</span></td>
                            <td>{{ $item['name'] }}</td>
                            <td>
                                <a href="/color/delete/{{ $item['id'] }}" class="btn btn-sm btn-danger px-3" onclick="return confirm('Xóa?')">Xóa</a>
                                <a href="/color/update/{{ $item['id'] }}" class="btn btn-sm btn-primary px-3">Sửa</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">Chưa có màu sắc nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection