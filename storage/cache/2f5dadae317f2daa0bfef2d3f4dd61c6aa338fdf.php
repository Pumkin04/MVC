
<?php $__env->startSection('title', 'Thêm mã giảm giá mới'); ?>
<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="fas fa-plus"></i> Thêm mã giảm giá mới</h5>
                </div>
                <div class="card-body">
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?php echo e($error); ?></div>
                    <?php endif; ?>
                    <form action="/coupon/add" method="POST">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="code" class="form-label">Mã giảm giá (Code)</label>
                                <input type="text" class="form-control" id="code" name="code" placeholder="Vd: GIAM50K" required>
                            </div>
                            <div class="col-md-6">
                                <label for="discount_type" class="form-label">Loại giảm giá</label>
                                <select class="form-select" id="discount_type" name="discount_type" required>
                                    <option value="phần trăm">Phần trăm (%)</option>
                                    <option value="cố định">Số tiền cố định (đ)</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="discount_value" class="form-label">Giá trị giảm</label>
                                <input type="number" class="form-control" id="discount_value" name="discount_value" required min="1">
                            </div>
                            <div class="col-md-6">
                                <label for="usage_limit" class="form-label">Giới hạn sử dụng</label>
                                <input type="number" class="form-control" id="usage_limit" name="usage_limit" value="1" min="1">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Ngày bắt đầu</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">Ngày kết thúc</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="/coupon/index" class="btn btn-secondary me-md-2">Hủy</a>
                            <button type="submit" class="btn btn-dark">Lưu mã giảm giá</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xamppp\xampp moi\htdocs\php2-2026-main\app\views/coupon/add.blade.php ENDPATH**/ ?>