

<?php $__env->startSection('title', 'Quản lý đơn hàng'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Danh sách đơn hàng</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Mã đơn</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th class="text-end pe-4">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="ps-4 fw-bold">#ORD-<?php echo e($order['id']); ?></td>
                        <td>
                            <div class="fw-semibold"><?php echo e($order['customer_name']); ?></div>
                            <small class="text-muted"><?php echo e($order['customer_email']); ?></small>
                        </td>
                        <td><?php echo e(date('d/m/Y H:i', strtotime($order['created_at']))); ?></td>
                        <td class="fw-bold text-primary"><?php echo e(number_format($order['total_amount'])); ?> đ</td>
                        <td>
                            <?php
                                $statusClass = [
                                    'pending' => 'bg-warning text-dark',
                                    'processing' => 'bg-info text-white',
                                    'shipped' => 'bg-primary text-white',
                                    'completed' => 'bg-success text-white',
                                    'cancelled' => 'bg-danger text-white'
                                ][$order['status']] ?? 'bg-secondary';
                                
                                $statusName = [
                                    'pending' => 'Chờ xử lý',
                                    'processing' => 'Đang xử lý',
                                    'shipped' => 'Đang giao',
                                    'completed' => 'Đã hoàn thành',
                                    'cancelled' => 'Đã hủy'
                                ][$order['status']] ?? $order['status'];
                            ?>
                            <span class="badge <?php echo e($statusClass); ?> rounded-pill px-3"><?php echo e($statusName); ?></span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="/Admin/orderDetail/<?php echo e($order['id']); ?>" class="btn btn-sm btn-outline-dark">Xem chi tiết</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Chưa có đơn hàng nào.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xamppp\xampp moi\htdocs\php2-2026-main\app\views/admin/orders/index.blade.php ENDPATH**/ ?>