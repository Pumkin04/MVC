<?php

class OrderController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/auth/login');
            exit;
        }
    }

    public function history()
    {
        $orderModel = $this->model('Order');
        $orders = $orderModel->getByUserId($_SESSION['user']['id']);

        return $this->view("order/history", [
            'title' => 'Lịch sử mua hàng',
            'orders' => $orders
        ]);
    }

    public function detail($id)
    {
        $orderModel = $this->model('Order');
        $orderDetailModel = $this->model('OrderDetail');

        $order = $orderModel->find($id);

        // Security: Ensure the order belongs to the logged-in user
        if (!$order || $order['user_id'] != $_SESSION['user']['id']) {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/order/history');
            exit;
        }

        $details = $orderDetailModel->getByOrderId($id);

        return $this->view("order/detail", [
            'title' => 'Chi tiết đơn hàng #' . $id,
            'order' => $order,
            'details' => $details
        ]);
    }

    public function delete($id)
    {
        $orderModel = $this->model('Order');
        $order = $orderModel->find($id);

        if (!$order || $order['user_id'] != $_SESSION['user']['id']) {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/order/history');
            exit;
        }

        if ($order['status'] !== 'cancelled') {
            $orderDetailModel = $this->model('OrderDetail');
            $productModel = $this->model('Product');
            $details = $orderDetailModel->getByOrderId($id);
            
            foreach ($details as $item) {
                $productModel->increaseStock($item['product_id'], $item['quantity']);
            }
        }

        $orderModel->delete($id);
        header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/order/history');
        exit;
    }

    public function reorder($id)
    {
        $orderModel = $this->model('Order');
        $orderDetailModel = $this->model('OrderDetail');
        $productModel = $this->model('Product');

        $order = $orderModel->find($id);

        if (!$order || $order['user_id'] != $_SESSION['user']['id']) {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/order/history');
            exit;
        }

        $details = $orderDetailModel->getByOrderId($id);

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        foreach ($details as $item) {
            $productId = $item['product_id'];
            $quantity = $item['quantity'];

            // Check if product still exists
            $product = $productModel->find($productId);
            if ($product) {
                // Determine how much we can add (respecting stock)
                $currentCartQty = isset($_SESSION['cart'][$productId]) && is_array($_SESSION['cart'][$productId]) 
                                  ? $_SESSION['cart'][$productId]['quantity'] : 0;
                
                $availableToBuy = $product['quantity'] - $currentCartQty;
                $toAdd = min($quantity, $availableToBuy);

                if ($toAdd > 0) {
                    if (isset($_SESSION['cart'][$productId]) && is_array($_SESSION['cart'][$productId])) {
                        $_SESSION['cart'][$productId]['quantity'] += $toAdd;
                    } else {
                        $_SESSION['cart'][$productId] = [
                            'id' => $product['id'],
                            'name' => $product['name'],
                            'price' => $product['price'],
                            'image' => $product['image'],
                            'quantity' => $toAdd
                        ];
                    }
                }

                if ($toAdd < $quantity) {
                    $_SESSION['error'] = "Một số sản phẩm đã được giới hạn số lượng theo kho hàng hiện có.";
                }
            }
        }

        header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/cart/index');
        exit;
    }
}
