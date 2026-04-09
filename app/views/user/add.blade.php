@extends('admin.layout')
@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">
                            Thêm Người Dùng Mới
                        </h5>
                    </div>
                    <div class="card-body">
                        @if(isset($error))
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endif
                        <form action="/user/add" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên người dùng" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                            </div>
                            <div class="mb-3">
                                <p class="text-muted small">Quyền hạn mặc định: <strong>Người dùng</strong></p>
                            </div>
                            <!-- Role hardcoded to user in controller add method -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-dark">
                                    Lưu Người Dùng
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
