<?php
class HomeController extends Controller
{
    public function index()
    {
        $product = $this->model('product');
        $data = $product->all();
        
        $wishlistIds = [];
        if (isset($_SESSION['user'])) {
            $wishlistModel = $this->model('Wishlist');
            $wishlistIds = $wishlistModel->getWishlistIds($_SESSION['user']['id']);
        }

        $title = "Cyber Gaming Store - Home";
        $this->view("home/index", [
            'title' => $title,
            'products' => array_slice($data, 0, 8), // Show top 8 products on home
            'wishlistIds' => $wishlistIds
        ]);
    }

    public function shop($page = 1)
    {
        $product = $this->model('product');
        $category = $this->model('danhmuc');
        
        $cat_id = $_GET['category'] ?? null;
        $min_price = $_GET['min_price'] ?? null;
        $max_price = $_GET['max_price'] ?? null;
        $search = $_GET['search'] ?? null;

        $allProducts = $product->filter($cat_id, $min_price, $max_price, $search);
        $categories = $category->all();
        
        $itemPerPage = 6;
        $totalItems = count($allProducts);
        $totalPages = ceil($totalItems / $itemPerPage);
        $currentPage = max(1, min($totalPages, (int)$page));
        if ($totalPages == 0) $currentPage = 1;
        $offset = ($currentPage - 1) * $itemPerPage;
        
        $paginatedProducts = array_slice($allProducts, $offset, $itemPerPage);
        
        $wishlistIds = [];
        if (isset($_SESSION['user'])) {
            $wishlistModel = $this->model('Wishlist');
            $wishlistIds = $wishlistModel->getWishlistIds($_SESSION['user']['id']);
        }

        $title = "Cửa hàng - MyStore";
        $this->view("home/shop", [
            'title' => $title,
            'products' => $paginatedProducts,
            'categories' => $categories,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'cat_id' => $cat_id,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'search' => $search,
            'wishlistIds' => $wishlistIds
        ]);
    }
}
