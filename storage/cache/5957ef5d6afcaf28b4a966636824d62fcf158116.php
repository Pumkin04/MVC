
<?php $__env->startSection('title', 'Quản Lý Liên Hệ'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid mt-4">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="row align-items-center g-3">
                    <div class="col-md-4">
                        <h4 class="mb-0">Danh sách Liên hệ</h4>
                    </div>
                    <div class="col-md-8">
                        <form action="/contact/admin_list" method="GET" class="d-flex gap-2 justify-content-md-end">
                            <input type="text" name="q" value="<?php echo e($q); ?>" class="form-control" placeholder="Tìm tên, email hoặc chủ đề..." style="max-width: 300px;">
                            <button type="submit" class="btn btn-dark">Tìm kiếm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive shadow-sm">
            <table class="table table-hover table-striped mb-0 align-middle" style="font-size: 0.9rem;">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3" style="width: 50px;">ID</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Ngày gửi</th>
                        <th class="text-center" style="width: 150px;">Thaom tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="ps-3"><span class="badge bg-secondary"><?php echo e($item['id']); ?></span></td>
                            <td class="fw-semibold"><?php echo e($item['full_name']); ?></td>
                            <td><a href="mailto:<?php echo e($item['email']); ?>" class="text-decoration-none"><?php echo e($item['email']); ?></a></td>
                            <td><?php echo e($item['phone']); ?></td>
                            <td><?php echo e($item['subject']); ?></td>
                            <td><?php echo e(date('d/m/Y H:i', strtotime($item['created_at']))); ?></td>
                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="/contact/viewDetails/<?php echo e($item['id']); ?>" class="btn btn-sm btn-info text-white">Xem</a>
                                    <form action="/contact/delete?q=<?php echo e($q); ?>&page=<?php echo e($page); ?>" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa liên hệ này?')">
                                        <input type="hidden" name="id" value="<?php echo e($item['id']); ?>">
                                        <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">Không tìm thấy liên hệ nào phù hợp.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($totalPages > 1): ?>
            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php echo e($page <= 1 ? 'disabled' : ''); ?>">
                        <a class="page-link" href="/contact/admin_list?q=<?php echo e($q); ?>&page=<?php echo e($page - 1); ?>">Trước</a>
                    </li>
                    <?php for($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo e($page == $i ? 'active' : ''); ?>">
                            <a class="page-link" href="/contact/admin_list?q=<?php echo e($q); ?>&page=<?php echo e($i); ?>"><?php echo e($i); ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php echo e($page >= $totalPages ? 'disabled' : ''); ?>">
                        <a class="page-link" href="/contact/admin_list?q=<?php echo e($q); ?>&page=<?php echo e($page + 1); ?>">Sau</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xamppp\xampp moi\htdocs\php2-2026-main\app\views/contact/admin_index.blade.php ENDPATH**/ ?>