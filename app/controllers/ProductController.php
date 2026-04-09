<?php
class ProductController extends Controller
{
    public function Product()
    {
        $product = $this->model('Product');
        $data = $product->all();
        $title = "Danh sách sản phẩm";
        $this->view("product/index", [
            'title' => $title,
            'products' => $data
        ]);
    }

    public function detail($id)
    {
        $productModel = $this->model('Product');
        $product = $productModel->findWithDetails($id);
        
        $relatedProducts = [];
        $isInWishlist = false;
        if ($product) {
            $relatedProducts = $productModel->getRelated($id, $product['category_id'], 4);
            
            if (isset($_SESSION['user'])) {
                $wishlistModel = $this->model('Wishlist');
                $isInWishlist = $wishlistModel->exists($_SESSION['user']['id'], $id);
            }
        }

        $title = $product['name'] ?? "Chi tiết sản phẩm";
        $this->view("product/detail", [
            'title' => $title,
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'isInWishlist' => $isInWishlist
        ]);
    }

    public function delete($id)
    {
        $product = $this->model('Product');
        $product->delete($id);

        header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/product/Product');
        exit;
    }

    public function add()
    {
        $brandModel = $this->model('Brand');
        $categoryModel = $this->model('Danhmuc');
        $sizeModel = $this->model('Size');
        $colorModel = $this->model('Color');

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return $this->view("product/add", [
                'brands' => $brandModel->all(),
                'categories' => $categoryModel->all(),
                'sizes' => $sizeModel->all(),
                'colors' => $colorModel->all()
            ]);
        } else {
            $data = $_POST;
            $image = "";

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $filename = time() . "_" . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], APP_PATH . "/public/" . $filename);
                $image = $filename;
            }

            $data['image'] = $image;

            try {
                $product = $this->model('Product');
                $product->add($data);
            } catch (Exception $e) {
                return $this->view("product/add", [
                    'error' => 'Lỗi khi thêm sản phẩm: ' . $e->getMessage(),
                    'brands' => $brandModel->all(),
                    'categories' => $categoryModel->all(),
                    'sizes' => $sizeModel->all(),
                    'colors' => $colorModel->all()
                ]);
            }

            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/product/Product');
            exit;
        }
    }

    public function update($id)
    {
        $productModel = $this->model('Product');
        $brandModel = $this->model('Brand');
        $categoryModel = $this->model('Danhmuc');
        $sizeModel = $this->model('Size');
        $colorModel = $this->model('Color');

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $product = $productModel->find($id);
            return $this->view("product/update", [
                'product' => $product,
                'brands' => $brandModel->all(),
                'categories' => $categoryModel->all(),
                'sizes' => $sizeModel->all(),
                'colors' => $colorModel->all()
            ]);
        } else {
            $data = $_POST;
            $currentProduct = $productModel->find($id);
            $image = $currentProduct['image'];

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "uploads/";
                $filename = time() . "_" . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], APP_PATH . "/public/" . $target_dir . $filename);
                $image = $filename;
            }

            $data['image'] = $image;

            try {
                $productModel->update($data, $id);
            } catch (Exception $e) {
                return $this->view("product/update", [
                    'error' => 'Lỗi khi cập nhật sản phẩm: ' . $e->getMessage(),
                    'product' => $productModel->find($id),
                    'brands' => $brandModel->all(),
                    'categories' => $categoryModel->all(),
                    'sizes' => $sizeModel->all(),
                    'colors' => $colorModel->all()
                ]);
            }

            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/product/Product');
            exit;
        }
    }
}