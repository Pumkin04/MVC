
<?php $__env->startSection('title', 'Quản Lý Sản Phẩm'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Quản Lý Sản Phẩm</h2>
            <a href="/product/add" class="btn btn-dark">
                Thêm Sản Phẩm
            </a>
        </div>

        <div class="table-responsive shadow-sm">
            <table class="table table-hover table-striped mb-0 align-middle text-center" style="font-size: 0.9rem;">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th>Size/Color</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><span class="badge bg-secondary"><?php echo e($item['id']); ?></span></td>
                            <td>
                                <?php if($item['image']): ?>
                                    <img src="/uploads/<?php echo e($item['image']); ?>" width="50" height="50" style="object-fit: cover; border-radius: 4px;">
                                <?php else: ?>
                                    <span class="text-muted">No Image</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-start"><?php echo e($item['name']); ?></td>
                            <td><?php echo e(number_format($item['price'], 0, ',', '.')); ?>đ</td>
                            <td><?php echo e($item['quantity']); ?></td>
                            <td><?php echo e($item['category_name']); ?></td>
                            <td><?php echo e($item['brand_name']); ?></td>
                            <td>
                                <span class="badge bg-info text-dark"><?php echo e($item['size_name']); ?></span>
                                <span class="badge bg-warning text-dark"><?php echo e($item['color_name']); ?></span>
                            </td>
                            <td>
                                <a href="/product/delete/<?php echo e($item['id']); ?>" class="btn btn-sm btn-danger px-3" onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
                                <a href="/product/update/<?php echo e($item['id']); ?>" class="btn btn-sm btn-primary px-3">Sửa</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="10" class="text-center text-muted py-5">Chưa có sản phẩm nào</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xamppp\xampp moi\htdocs\php2-2026-main\app\views/product/index.blade.php ENDPATH**/ ?>