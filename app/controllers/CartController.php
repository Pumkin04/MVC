<?php

class CartController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $id => $item) {
                if (!is_array($item)) {
                    unset($_SESSION['cart'][$id]);
                }
            }
        }
        
        $cart = $_SESSION['cart'] ?? [];
        $title = "Giỏ hàng của bạn";
        
        return $this->view("cart/index", [
            'title' => $title,
            'cart' => $cart
        ]);
    }

    public function add($id)
    {
        $productModel = $this->model('Product');
        $product = $productModel->find($id);

        if (!$product) {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/home/index');
            exit;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            if ($_SESSION['cart'][$id]['quantity'] < $product['quantity']) {
                $_SESSION['cart'][$id]['quantity']++;
            } else {
                $_SESSION['error'] = "Sản phẩm này chỉ còn " . $product['quantity'] . " cái trong kho!";
            }
        } else {
            if ($product['quantity'] > 0) {
                $_SESSION['cart'][$id] = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'image' => $product['image'],
                    'quantity' => 1
                ];
            } else {
                $_SESSION['error'] = "Sản phẩm này đã hết hàng!";
            }
        }

        $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        header("Location: $base/cart/index");
        exit;
    }

    public function update($id)
    {
        $type = $_GET['type'] ?? 'plus';
        
        if (isset($_SESSION['cart'][$id])) {
            if ($type === 'plus') {
                $productModel = $this->model('Product');
                $product = $productModel->find($id);
                
                if ($_SESSION['cart'][$id]['quantity'] < $product['quantity']) {
                    $_SESSION['cart'][$id]['quantity']++;
                } else {
                    $_SESSION['error'] = "Sản phẩm này chỉ còn " . $product['quantity'] . " cái trong kho!";
                }
            } else {
                $_SESSION['cart'][$id]['quantity']--;
                if ($_SESSION['cart'][$id]['quantity'] < 1) {
                    unset($_SESSION['cart'][$id]);
                }
            }
        }

        $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        header("Location: $base/cart/index");
        exit;
    }

    public function delete($id)
    {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }

        $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        header("Location: $base/cart/index");
        exit;
    }

    public function clear()
    {
        unset($_SESSION['cart']);
        $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        header("Location: $base/cart/index");
        exit;
    }
}
