<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <div class="container">
            <a class="navbar-brand" href="/">MyShop</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/">Quay lại trang chủ</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">Liên hệ với chúng tôi</h2>

                        <?php if(isset($_GET['success'])): ?>
                            <div class="alert alert-success border-0 shadow-sm text-center mb-4">
                                <strong>Gửi liên hệ thành công!</strong> Chúng tôi sẽ sớm phản hồi.
                            </div>
                        <?php endif; ?>

                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger border-0 shadow-sm mb-4">
                                <?php echo e($error); ?>

                            </div>
                        <?php endif; ?>

                        <form action="/contact/store" method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Họ và tên *</label>
                                <input type="text" name="full_name" class="form-control" 
                                    value="<?php echo e($old['full_name'] ?? ''); ?>" placeholder="Nhập họ tên của bạn">
                                <?php if(isset($errors['full_name'])): ?>
                                    <div class="text-danger small mt-1"><?php echo e($errors['full_name']); ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email *</label>
                                <input type="email" name="email" class="form-control" 
                                    value="<?php echo e($old['email'] ?? ''); ?>" placeholder="example@email.com">
                                <?php if(isset($errors['email'])): ?>
                                    <div class="text-danger small mt-1"><?php echo e($errors['email']); ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Số điện thoại *</label>
                                <input type="text" name="phone" class="form-control" 
                                    value="<?php echo e($old['phone'] ?? ''); ?>" placeholder="Nhập số điện thoại">
                                <?php if(isset($errors['phone'])): ?>
                                    <div class="text-danger small mt-1"><?php echo e($errors['phone']); ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Chủ đề *</label>
                                <input type="text" name="subject" class="form-control" 
                                    value="<?php echo e($old['subject'] ?? ''); ?>" placeholder="Vấn đề bạn cần hỗ trợ">
                                <?php if(isset($errors['subject'])): ?>
                                    <div class="text-danger small mt-1"><?php echo e($errors['subject']); ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Nội dung liên hệ *</label>
                                <textarea name="message" class="form-control" 
                                    rows="4" placeholder="Nhập nội dung tin nhắn"><?php echo e($old['message'] ?? ''); ?></textarea>
                                <?php if(isset($errors['message'])): ?>
                                    <div class="text-danger small mt-1"><?php echo e($errors['message']); ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary py-2 fw-semibold">Gửi liên hệ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH D:\Xamppp\xampp moi\htdocs\php2-2026-main\app\views/contact/create.blade.php ENDPATH**/ ?>