@extends('admin.layout')
@section('title', 'Quản Lý Thương Hiệu')
@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Quản Lý Thương Hiệu</h2>
            <a href="/brand/add" class="btn btn-dark">
                Thêm Thương Hiệu
            </a>
        </div>

        <div class="table-responsive shadow-sm">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên Thương Hiệu</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($brands as $item)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $item['id'] }}</span></td>
                            <td>{{ $item['name'] }}</td>
                            <td>
                                <a href="/brand/delete/{{ $item['id'] }}" class="btn btn-sm btn-danger px-3" onclick="return confirm('Xóa thương hiệu này?')">Xóa</a>
                                <a href="/brand/update/{{ $item['id'] }}" class="btn btn-sm btn-primary px-3">Sửa</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-5">Chưa có thương hiệu nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
