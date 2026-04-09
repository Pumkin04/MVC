@extends('admin.layout')
@section('title', 'Quản Lý Danh Mục')
@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Quản Lý Danh Mục</h2>
            <a href="/danhmuc/add" class="btn btn-dark">
                Thêm danh mục
            </a>
        </div>

        <div class="table-responsive shadow-sm">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Danh mục</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($danhmucs as $item)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $item['id'] }}</span></td>
                            <td>{{ $item['name'] }}</td>
                            <td>
                                <a href="/danhmuc/delete/{{ $item['id'] }}" class="btn btn-sm btn-danger px-3" onclick="return confirm('Xóa?')">Xóa</a>
                                <a href="/danhmuc/update/{{ $item['id'] }}" class="btn btn-sm btn-primary px-3">Sửa</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">Chưa có danh mục nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection