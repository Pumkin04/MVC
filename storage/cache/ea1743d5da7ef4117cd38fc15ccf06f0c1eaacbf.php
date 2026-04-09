

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 bg-primary text-white p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <i class="fas fa-wallet fa-2x opacity-50"></i>
                <span class="badge bg-white text-primary rounded-pill">Hoàn thành</span>
            </div>
            <h6 class="fw-bold opacity-75 mb-1">TỔNG DOANH THU</h6>
            <h3 class="fw-bold mb-0 text-truncate"><?php echo e(number_format($totalRevenue)); ?> đ</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 bg-success text-white p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <i class="fas fa-shopping-cart fa-2x opacity-50"></i>
                <span class="badge bg-white text-success rounded-pill">Tất cả</span>
            </div>
            <h6 class="fw-bold opacity-75 mb-1">TỔNG ĐƠN HÀNG</h6>
            <h3 class="fw-bold mb-0 text-truncate"><?php echo e($totalOrders); ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 bg-warning text-dark p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <i class="fas fa-clock fa-2x opacity-50"></i>
                <span class="badge bg-dark text-white rounded-pill">Chờ xử lý</span>
            </div>
            <h6 class="fw-bold opacity-75 mb-1">ĐƠN CHỜ DUYỆT</h6>
            <h3 class="fw-bold mb-0 text-truncate"><?php echo e($pendingOrders); ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 bg-info text-white p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <i class="fas fa-users fa-2x opacity-50"></i>
                <span class="badge bg-white text-info rounded-pill">Thành viên</span>
            </div>
            <h6 class="fw-bold opacity-75 mb-1">TỔNG NGƯỜI DÙNG</h6>
            <h3 class="fw-bold mb-0 text-truncate"><?php echo e($totalUsers); ?></h3>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Đơn hàng mới nhất</h5>
                <a href="/Admin/orders" class="btn btn-sm btn-outline-dark rounded-pill px-3">Xem tất cả</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light small">
                        <tr>
                            <th>Mã đơn</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Ngày đặt</th>
                            <th class="text-end">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $latestOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="fw-bold">#ORD-<?php echo e($order['id']); ?></td>
                            <td><?php echo e($order['customer_name']); ?></td>
                            <td class="text-primary fw-bold"><?php echo e(number_format($order['total_amount'])); ?> đ</td>
                            <td class="small text-muted"><?php echo e(date('d/m/Y', strtotime($order['created_at']))); ?></td>
                            <td class="text-end">
                                <a href="/Admin/orderDetail/<?php echo e($order['id']); ?>" class="btn btn-sm btn-light rounded-pill"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted small">Chưa có đơn hàng nào.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-4 h-100">
            <h5 class="fw-bold mb-4">Công việc cần làm</h5>
            <div class="list-group list-group-flush small">
                <?php if($pendingOrders > 0): ?>
                <div class="list-group-item d-flex align-items-center py-3 border-0">
                    <i class="fas fa-exclamation-circle text-warning me-3 fa-lg"></i>
                    <div>
                        <div class="fw-bold">Xét duyệt đơn hàng</div>
                        <div class="text-muted">Bạn có <?php echo e($pendingOrders); ?> đơn hàng đang chờ xử lý.</div>
                        <a href="/Admin/orders" class="small text-decoration-none">Đi tới danh sách →</a>
                    </div>
                </div>
                <?php endif; ?>
                <div class="list-group-item d-flex align-items-center py-3 border-0">
                    <i class="fas fa-box text-primary me-3 fa-lg"></i>
                    <div>
                        <div class="fw-bold">Quản lý kho hàng</div>
                        <div class="text-muted">Có <?php echo e($totalProducts); ?> sản phẩm trong cửa hàng.</div>
                        <a href="/product/Product" class="small text-decoration-none">Kiểm tra ngay →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xamppp\xampp moi\htdocs\php2-2026-main\app\views/admin/dashboard.blade.php ENDPATH**/ ?>