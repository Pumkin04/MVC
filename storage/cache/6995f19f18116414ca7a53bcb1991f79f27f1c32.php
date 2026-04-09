
<?php $__env->startSection('title', 'Quản Lý Kích Cỡ'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Quản Lý Kích Cỡ</h2>
            <a href="/size/add" class="btn btn-dark">
                Thêm Kích cỡ
            </a>
        </div>

        <div class="table-responsive shadow-sm">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Kích cỡ</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><span class="badge bg-secondary"><?php echo e($item['id']); ?></span></td>
                            <td><?php echo e($item['name']); ?></td>
                            <td>
                                <a href="/size/delete/<?php echo e($item['id']); ?>" class="btn btn-sm btn-danger px-3" onclick="return confirm('Xóa?')">Xóa</a>
                                <a href="/size/update/<?php echo e($item['id']); ?>" class="btn btn-sm btn-primary px-3">Sửa</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">Chưa có kích cỡ nào</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xamppp\xampp moi\htdocs\php2-2026-main\app\views/size/index.blade.php ENDPATH**/ ?>