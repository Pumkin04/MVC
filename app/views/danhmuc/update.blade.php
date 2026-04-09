{{-- @extends('admin.lauout')
@section('title', $title)
@section('content')
    <a href="/color/create" class="btn btn-sm btn-light border text-succes">Add Size</a>
    <table class="table">
        <tr>
            <th> id </th>
            <th> name </th>
            <th>action</th>
        </tr>
        @foreach ($colors as $item)
            <tr>
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['name'] }}</td>
                <td>
                    <a href="/color/update/{{ $item['id'] }}" class="btn btn-sm btn-light border text-danger">Delete
                    </a>
                </td>
            </tr>
        @endforeach

    </table>
@endsection --}}
@extends('admin.layout')
@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">
                            Sửa Danh mục
                        </h5>
                    </div>
                    <div class="card-body">
                        @if(isset($error))
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endif
                        <form action="/danhmuc/update/{{ $danhmuc['id'] }}" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên danh mục</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $danhmuc['name'] }}" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-dark">
                                    Lưu
                                </button>
                                <a href="/danhmuc/Danhmuc" class="btn btn-secondary">
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