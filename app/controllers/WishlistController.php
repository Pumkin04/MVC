<?php
class WishlistController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/auth/login');
            exit;
        }

        $wishlistModel = $this->model('Wishlist');
        $wishlist = $wishlistModel->all($_SESSION['user']['id']);
        
        $title = "Sản phẩm yêu thích - MYSTORE";
        $this->view("wishlist/index", [
            'title' => $title,
            'wishlist' => $wishlist
        ]);
    }

    public function toggle($product_id)
    {
        if (!isset($_SESSION['user'])) {
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'unauthorized', 'message' => 'Vui lòng đăng nhập để yêu thích sản phẩm!']);
                exit;
            }
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/auth/login');
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $wishlistModel = $this->model('Wishlist');

        if ($wishlistModel->exists($user_id, $product_id)) {
            $wishlistModel->remove($user_id, $product_id);
            $action = 'removed';
        } else {
            $wishlistModel->add($user_id, $product_id);
            $action = 'added';
        }

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'action' => $action]);
            exit;
        }

        // Redirect back to previous page
        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/home/shop');
        }
        exit;
    }

    public function remove($product_id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/auth/login');
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $wishlistModel = $this->model('Wishlist');
        $wishlistModel->remove($user_id, $product_id);

        header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/wishlist/index');
        exit;
    }
}
