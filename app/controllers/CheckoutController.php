<?php

class CheckoutController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/cart/index');
            exit;
        }

        $cart = $_SESSION['cart'];
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $this->view("checkout/index", [
            'title' => 'Thanh toán đơn hàng',
            'cart' => $cart,
            'total' => $total,
            'user' => $_SESSION['user'] ?? null
        ]);
    }

    public function process()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/checkout/index');
            exit;
        }

        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/cart/index');
            exit;
        }

        $cart = $_SESSION['cart'];
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $data = [
            'user_id' => $_SESSION['user']['id'] ?? null,
            'customer_name' => $_POST['customer_name'],
            'customer_email' => $_POST['customer_email'],
            'customer_phone' => $_POST['customer_phone'],
            'customer_address' => $_POST['customer_address'],
            'total_amount' => $total
        ];

        $orderModel = $this->model('Order');
        $orderDetailModel = $this->model('OrderDetail');

        try {
            $order_id = $orderModel->create($data);

            if ($order_id) {
                $productModel = $this->model('Product');
                foreach ($cart as $item) {
                    $orderDetailModel->add([
                        'order_id' => $order_id,
                        'product_id' => $item['id'],
                        'product_name' => $item['name'],
                        'product_price' => $item['price'],
                        'quantity' => $item['quantity']
                    ]);
                    
                    // Reduce stock
                    $productModel->reduceStock($item['id'], $item['quantity']);
                }

                // Clear cart
                unset($_SESSION['cart']);

                header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/checkout/success/' . $order_id);
                exit;
            }
        } catch (Exception $e) {
            die("Lỗi khi tạo đơn hàng: " . $e->getMessage());
        }
    }

    public function success($order_id)
    {
        $orderModel = $this->model('Order');
        $order = $orderModel->find($order_id);

        if (!$order) {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/home/index');
            exit;
        }

        return $this->view("checkout/success", [
            'title' => 'Đặt hàng thành công',
            'order' => $order
        ]);
    }
}
