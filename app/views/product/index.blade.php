@extends('admin.layout')
@section('title', 'Quản Lý Sản Phẩm')
@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Quản Lý Sản Phẩm</h2>
            <a href="/product/add" class="btn btn-dark">
                Thêm Sản Phẩm
            </a>
        </div>

        <div class="table-responsive shadow-sm">
            <table class="table table-hover table-striped mb-0 align-middle text-center" style="font-size: 0.9rem;">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th>Size/Color</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $item)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $item['id'] }}</span></td>
                            <td>
                                @if($item['image'])
                                    <img src="/uploads/{{ $item['image'] }}" width="50" height="50" style="object-fit: cover; border-radius: 4px;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td class="text-start">{{ $item['name'] }}</td>
                            <td>{{ number_format($item['price'], 0, ',', '.') }}đ</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ $item['category_name'] }}</td>
                            <td>{{ $item['brand_name'] }}</td>
                            <td>
                                <span class="badge bg-info text-dark">{{ $item['size_name'] }}</span>
                                <span class="badge bg-warning text-dark">{{ $item['color_name'] }}</span>
                            </td>
                            <td>
                                <a href="/product/delete/{{ $item['id'] }}" class="btn btn-sm btn-danger px-3" onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
                                <a href="/product/update/{{ $item['id'] }}" class="btn btn-sm btn-primary px-3">Sửa</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-5">Chưa có sản phẩm nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
