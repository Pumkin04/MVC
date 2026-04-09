

<?php $__env->startSection('title', 'Chi tiết đơn hàng'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <a href="/Admin/orders" class="btn btn-link text-decoration-none p-0 mb-3 text-dark">
        <i class="fas fa-arrow-left me-1"></i> Quay lại danh sách
    </a>
    <div class="d-flex justify-content-between align-items-center">
        <h2>Chi tiết đơn hàng #ORD-<?php echo e($order['id']); ?></h2>
        <div class="text-muted small">Ngày đặt: <?php echo e(date('d/m/Y H:i', strtotime($order['created_at']))); ?></div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <!-- Order Items -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white fw-bold">Sản phẩm trong đơn hàng</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Sản phẩm</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-end pe-4">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="fw-semibold"><?php echo e($item['product_name']); ?></div>
                                    <small class="text-muted"><?php echo e(number_format($item['product_price'])); ?> đ</small>
                                </td>
                                <td class="text-center"><?php echo e($item['quantity']); ?></td>
                                <td class="text-end pe-4 fw-bold"><?php echo e(number_format($item['product_price'] * $item['quantity'])); ?> đ</td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="2" class="text-end fw-bold ps-4">Tổng cộng:</td>
                                <td class="text-end pe-4 fw-bold text-primary" style="font-size: 1.2rem;"><?php echo e(number_format($order['total_amount'])); ?> đ</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Customer Info -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white fw-bold">Thông tin khách hàng</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="text-muted small d-block mb-1">Họ tên</label>
                    <div class="fw-bold"><?php echo e($order['customer_name']); ?></div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small d-block mb-1">Email</label>
                    <div><?php echo e($order['customer_email']); ?></div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small d-block mb-1">Số điện thoại</label>
                    <div><?php echo e($order['customer_phone']); ?></div>
                </div>
                <div class="mb-0">
                    <label class="text-muted small d-block mb-1">Địa chỉ giao hàng</label>
                    <div><?php echo e($order['customer_address']); ?></div>
                </div>
            </div>
        </div>

        <!-- Order Status Update -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold">Cập nhật trạng thái</div>
            <div class="card-body">
                <form action="/Admin/updateOrderStatus/<?php echo e($order['id']); ?>" method="POST">
                    <div class="mb-3">
                        <select name="status" class="form-select">
                            <option value="pending" <?php echo e($order['status'] == 'pending' ? 'selected' : ''); ?>>Chờ xử lý</option>
                            <option value="processing" <?php echo e($order['status'] == 'processing' ? 'selected' : ''); ?>>Đang xử lý</option>
                            <option value="shipped" <?php echo e($order['status'] == 'shipped' ? 'selected' : ''); ?>>Đang giao</option>
                            <option value="completed" <?php echo e($order['status'] == 'completed' ? 'selected' : ''); ?>>Đã hoàn thành</option>
                            <option value="cancelled" <?php echo e($order['status'] == 'cancelled' ? 'selected' : ''); ?>>Đã hủy</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">CẬP NHẬT</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xamppp\xampp moi\htdocs\php2-2026-main\app\views/admin/orders/detail.blade.php ENDPATH**/ ?>