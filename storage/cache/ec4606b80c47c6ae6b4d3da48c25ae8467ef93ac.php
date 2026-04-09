
<?php $__env->startSection('content'); ?>
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
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger"><?php echo e($error); ?></div>
                        <?php endif; ?>
                        <form action="/user/update/<?php echo e($user['id']); ?>" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo e($user['username']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo e($user['email']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Quyền hạn</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="user" <?php echo e($user['role'] == 'user' ? 'selected' : ''); ?>>Người dùng</option>
                                    <option value="admin" <?php echo e($user['role'] == 'admin' ? 'selected' : ''); ?>>Admin</option>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xamppp\xampp moi\htdocs\php2-2026-main\app\views/user/update.blade.php ENDPATH**/ ?>