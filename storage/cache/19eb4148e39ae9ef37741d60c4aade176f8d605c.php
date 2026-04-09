
<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">
                            Sửa Thương Hiệu
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger"><?php echo e($error); ?></div>
                        <?php endif; ?>
                        <form action="/brand/update/<?php echo e($brand['id']); ?>" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên Thương Hiệu</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo e($brand['name']); ?>" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-dark">
                                    Lưu Thay Đổi
                                </button>
                                <a href="/brand/Brand" class="btn btn-secondary">
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

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xamppp\xampp moi\htdocs\php2-2026-main\app\views/brand/update.blade.php ENDPATH**/ ?>