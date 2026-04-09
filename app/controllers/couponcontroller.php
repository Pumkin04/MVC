<?php
class CouponController extends Controller
{
    public function index()
    {
        $couponModel = $this->model('Coupon');
        $coupons = $couponModel->all();
        $title = "Quản lý mã giảm giá";
        
        return $this->view("coupon/index", [
            'title' => $title,
            'coupons' => $coupons
        ]);
    }

    public function add()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') {
            return $this->view("coupon/add", [
                'title' => "Thêm mã giảm giá mới"
            ]);
        } else {
            $data = [
                'code'           => $_POST['code'] ?? '',
                'discount_type'  => $_POST['discount_type'] ?? '',
                'discount_value' => $_POST['discount_value'] ?? 0,
                'start_date'     => $_POST['start_date'] ?? '',
                'end_date'       => $_POST['end_date'] ?? '',
                'usage_limit'    => $_POST['usage_limit'] ?? 1,
            ];

            if (!empty($data['code'])) {
                try {
                    $couponModel = $this->model('Coupon');
                    $couponModel->add($data);
                } catch (Exception $e) {
                    return $this->view("coupon/add", [
                        'title' => "Thêm mã giảm giá mới",
                        'error' => "Mã giảm giá đã tồn tại hoặc có lỗi xảy ra!"
                    ]);
                }
            }

            // Chuyển hướng chuẩn Windows/Web
            $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
            header("Location: $base/coupon/index");
            exit;
        }
    }

    public function delete($id)
    {
        $couponModel = $this->model('Coupon');
        $couponModel->delete($id);
        
        $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
        header("Location: $base/coupon/index");
        exit;
    }
}
