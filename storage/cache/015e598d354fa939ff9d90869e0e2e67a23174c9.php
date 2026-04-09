
<?php $__env->startSection('title', 'Quản Lý Người Dùng'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Quản Lý Người Dùng</h2>
            <a href="/user/add" class="btn btn-dark">
                Thêm Người Dùng
            </a>
        </div>

        <div class="table-responsive shadow-sm">
            <table class="table table-hover table-striped mb-0 text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Họ và Tên</th>
                        <th>Email</th>
                        <th>Quyền</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><span class="badge bg-secondary"><?php echo e($item['id']); ?></span></td>
                            <td><?php echo e($item['username']); ?></td>
                            <td><?php echo e($item['email']); ?></td>
                            <td>
                                <?php if($item['role'] == 'admin'): ?>
                                    <span class="badge bg-info text-dark">Admin</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Người dùng</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="/user/delete/<?php echo e($item['id']); ?>" class="btn btn-sm btn-danger px-3" onclick="return confirm('Xóa người dùng này?')">Xóa</a>
                                <a href="/user/update/<?php echo e($item['id']); ?>" class="btn btn-sm btn-primary px-3">Sửa</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">Chưa có người dùng nào</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xamppp\xampp moi\htdocs\php2-2026-main\app\views/user/index.blade.php ENDPATH**/ ?>