
<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-plus"></i> Thêm Màu Sắc Mới
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger"><?php echo e($error); ?></div>
                        <?php endif; ?>
                        <form action="/color/add" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên Màu Sắc</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên màu (vd: Đỏ, Xanh, Vàng...)" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-dark">
                                    <i class="fas fa-save"></i> Lưu
                                </button>
                                <a href="/color/Color" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Hủy
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xamppp\xampp moi\htdocs\php2-2026-main\app\views/color/add.blade.php ENDPATH**/ ?>