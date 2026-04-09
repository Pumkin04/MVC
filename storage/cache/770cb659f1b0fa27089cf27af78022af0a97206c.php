
<?php $__env->startSection('title', 'Quản lý mã giảm giá'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Quản lý mã giảm giá</h2>
        <a href="/coupon/add" class="btn btn-dark">
            <i class="fas fa-plus"></i> Thêm mã mới
        </a>
    </div>

    <div class="table-responsive shadow-sm">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Mã (Code)</th>
                    <th>Loại</th>
                    <th>Giá trị</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Giới hạn</th>
                    <th>Đã dùng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><strong><?php echo e($item['code']); ?></strong></td>
                    <td><?php echo e($item['discount_type']); ?></td>
                    <td><?php echo e(number_format($item['discount_value'], 0, ',', '.')); ?></td>
                    <td><?php echo e($item['start_date']); ?></td>
                    <td><?php echo e($item['end_date']); ?></td>
                    <td><?php echo e($item['usage_limit']); ?></td>
                    <td><?php echo e($item['used_count']); ?></td>
                    <td>
                        <a href="/coupon/delete/<?php echo e($item['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa mã giảm giá này?')">
                            <i class="fas fa-trash"></i> Xóa
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-5">Chưa có mã giảm giá nào</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xamppp\xampp moi\htdocs\php2-2026-main\app\views/coupon/index.blade.php ENDPATH**/ ?>