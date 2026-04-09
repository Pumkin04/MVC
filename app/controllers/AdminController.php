<?php
class AdminController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/auth/login');
            exit;
        }
    }
    public function Admin()
    {
        $orderModel = $this->model('Order');
        $productModel = $this->model('Product');
        $userModel = $this->model('User');

        $totalRevenue = $orderModel->getTotalRevenue();
        $totalOrders = $orderModel->getOrderCountByStatus();
        $pendingOrders = $orderModel->getOrderCountByStatus('pending');
        $completedOrders = $orderModel->getOrderCountByStatus('completed');
        $latestOrders = $orderModel->getLatestOrders(5);
        
        $totalProducts = 0;
        if (method_exists($productModel, 'all')) {
            $totalProducts = count($productModel->all());
        }
        
        $totalUsers = 0;
        if (method_exists($userModel, 'all')) {
            $totalUsers = count($userModel->all());
        }

        $this->view("admin/dashboard", [
            'title' => 'Bảng điều khiển',
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'pendingOrders' => $pendingOrders,
            'completedOrders' => $completedOrders,
            'latestOrders' => $latestOrders,
            'totalProducts' => $totalProducts,
            'totalUsers' => $totalUsers
        ]);
    }

    public function orders()
    {
        $orderModel = $this->model('Order');
        $orders = $orderModel->all();
        
        $this->view("admin/orders/index", [
            'title' => 'Quản lý đơn hàng',
            'orders' => $orders
        ]);
    }

    public function orderDetail($id)
    {
        $orderModel = $this->model('Order');
        $orderDetailModel = $this->model('OrderDetail');
        
        $order = $orderModel->find($id);
        $details = $orderDetailModel->getByOrderId($id);
        
        $this->view("admin/orders/detail", [
            'title' => 'Chi tiết đơn hàng #' . $id,
            'order' => $order,
            'details' => $details
        ]);
    }

    public function updateOrderStatus($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'];
            $orderModel = $this->model('Order');
            $orderDetailModel = $this->model('OrderDetail');
            $productModel = $this->model('Product');

            $oldOrder = $orderModel->find($id);
            $oldStatus = $oldOrder['status'];

            if ($orderModel->updateStatus($id, $status)) {
                // If order is cancelled, return stock
                if ($status === 'cancelled' && $oldStatus !== 'cancelled') {
                    $details = $orderDetailModel->getByOrderId($id);
                    foreach ($details as $item) {
                        $productModel->increaseStock($item['product_id'], $item['quantity']);
                    }
                }
                // If order was cancelled and now is restored to something else (unlikely but good to handle)
                elseif ($oldStatus === 'cancelled' && $status !== 'cancelled') {
                    $details = $orderDetailModel->getByOrderId($id);
                    foreach ($details as $item) {
                        $productModel->reduceStock($item['product_id'], $item['quantity']);
                    }
                }
            }
            
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/Admin/orderDetail/' . $id);
            exit;
        }
    }
}
