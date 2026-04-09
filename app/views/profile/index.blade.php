<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title }} - MyStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #007aff;
            --bg-light: #f5f5f7;
        }
        body {
            background-color: var(--bg-light);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        .profile-card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.05);
            background: #ffffff;
            overflow: hidden;
        }
        .profile-header {
            background: linear-gradient(135deg, #007aff 0%, #00c6ff 100%);
            padding: 3rem 2rem;
            text-align: center;
            color: white;
        }
        .avatar-placeholder {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin: 0 auto 1rem;
            border: 4px solid rgba(255, 255, 255, 0.3);
        }
        .form-control {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid #d2d2d7;
            background-color: #fbfbfd;
        }
        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(0, 122, 255, 0.1);
            border-color: var(--primary-color);
            background-color: #fff;
        }
        .btn-save {
            background-color: var(--primary-color);
            border: none;
            border-radius: 12px;
            padding: 0.8rem 2rem;
            font-weight: 600;
            transition: all 0.3s;
            color: white;
        }
        .btn-save:hover {
            background-color: #0062cc;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 122, 255, 0.3);
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="/">MYSTORE</a>
            <div class="collapse navbar-collapse d-flex justify-content-end">
                <a href="/" class="btn btn-link text-dark text-decoration-none small">
                    <i class="fas fa-home me-2"></i> Quay lại trang chủ
                </a>
            </div>
        </div>
    </nav>

    <main class="container py-5 mt-md-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="profile-card card">
                    <div class="profile-header">
                        <div class="avatar-placeholder">
                            <i class="fas fa-user"></i>
                        </div>
                        <h3 class="fw-bold mb-0">{{ $user['username'] }}</h3>
                        <p class="opacity-75 mb-0">{{ $user['email'] }}</p>
                    </div>
                    
                    <div class="card-body p-4 p-md-5">
                        @if(isset($success))
                        <div class="alert alert-success border-0 rounded-4 mb-4">
                            <i class="fas fa-check-circle me-2"></i> {{ $success }}
                        </div>
                        @endif

                        @if(isset($error))
                        <div class="alert alert-danger border-0 rounded-4 mb-4">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ $error }}
                        </div>
                        @endif

                        <form action="/profile/update" method="POST">
                            <h5 class="fw-bold mb-4">Cài đặt tài khoản</h5>
                            
                            <div class="row g-4 mb-5">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">Tên hiển thị</label>
                                    <input type="text" name="username" class="form-control" value="{{ $user['username'] }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">Địa chỉ Email</label>
                                    <input type="email" class="form-control" value="{{ $user['email'] }}" disabled>
                                </div>
                            </div>

                            <hr class="my-5 opacity-5">

                            <h5 class="fw-bold mb-4">Đổi mật khẩu</h5>
                            <p class="text-muted small mb-4">Để mật khẩu trống nếu bạn không muốn thay đổi.</p>

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">Mật khẩu mới</label>
                                    <input type="password" name="password" class="form-control" placeholder="••••••••">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">Xác nhận mật khẩu mới</label>
                                    <input type="password" name="confirm_password" class="form-control" placeholder="••••••••">
                                </div>
                            </div>

                            <div class="text-end mt-5">
                                <button type="submit" class="btn btn-primary btn-save">LƯU THAY ĐỔI</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-5 text-center text-muted small">
        © 2026 MYSTORE Tech. Thông tin cá nhân được bảo mật.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
