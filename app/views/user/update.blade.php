@extends('admin.layout')
@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">
                            Sửa Người Dùng
                        </h5>
                    </div>
                    <div class="card-body">
                        @if(isset($error))
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endif
                        <form action="/user/update/{{ $user['id'] }}" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ $user['username'] }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user['email'] }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Quyền hạn</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="user" {{ $user['role'] == 'user' ? 'selected' : '' }}>Người dùng</option>
                                    <option value="admin" {{ $user['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-dark">
                                    Lưu Thay Đổi
                                </button>
                                <a href="/user/User" class="btn btn-secondary">
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
