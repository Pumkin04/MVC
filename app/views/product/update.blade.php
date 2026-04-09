@extends('admin.layout')
@section('content')
    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">
                            Sửa Sản Phẩm
                        </h5>
                    </div>
                    <div class="card-body">
                        @if(isset($error))
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endif
                        <form action="/product/update/{{ $product['id'] }}" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $product['name'] }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="image" class="form-label">Ảnh sản phẩm</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    @if($product['image'])
                                        <div class="mt-2">
                                            <img src="/{{ $product['image'] }}" width="80" class="img-thumbnail" alt="Current Image">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="price" class="form-label">Giá</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ $product['price'] }}" step="0.01" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="quantity" class="form-label">Số lượng</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product['quantity'] }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="category_id" class="form-label">Danh mục</label>
                                    <select class="form-select" id="category_id" name="category_id" required>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat['id'] }}" {{ $product['category_id'] == $cat['id'] ? 'selected' : '' }}>{{ $cat['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="brand_id" class="form-label">Thương hiệu</label>
                                    <select class="form-select" id="brand_id" name="brand_id" required>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand['id'] }}" {{ $product['brand_id'] == $brand['id'] ? 'selected' : '' }}>{{ $brand['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="size_id" class="form-label">Size</label>
                                    <select class="form-select" id="size_id" name="size_id" required>
                                        @foreach($sizes as $size)
                                            <option value="{{ $size['id'] }}" {{ $product['size_id'] == $size['id'] ? 'selected' : '' }}>{{ $size['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="color_id" class="form-label">Màu sắc</label>
                                    <select class="form-select" id="color_id" name="color_id" required>
                                        @foreach($colors as $color)
                                            <option value="{{ $color['id'] }}" {{ $product['color_id'] == $color['id'] ? 'selected' : '' }}>{{ $color['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Mô tả</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ $product['description'] }}</textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-dark">
                                    Lưu Thay Đổi
                                </button>
                                <a href="/product/Product" class="btn btn-secondary">
                                    Hủy
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
