<?php

class ProfileController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/auth/login');
            exit;
        }
    }

    public function index()
    {
        $userModel = $this->model('User');
        $user = $userModel->find($_SESSION['user']['id']);

        return $this->view("profile/index", [
            'title' => 'Thông tin tài khoản',
            'user' => $user
        ]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = $this->model('User');
            $user = $userModel->find($_SESSION['user']['id']);

            $data = [
                'username' => $_POST['username'] ?? $user['username'],
                'email' => $user['email'], // Keep email unchanged
                'role' => $user['role']
            ];

            // Change password if provided
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            if (!empty($password)) {
                if ($password !== $confirm_password) {
                    return $this->view("profile/index", [
                        'title' => 'Thông tin tài khoản',
                        'user' => $user,
                        'error' => 'Mật khẩu xác nhận không khớp!'
                    ]);
                }
                $data['password'] = $password;
            }

            try {
                $userModel->update($data, $user['id']);
                
                // Update session
                $_SESSION['user']['username'] = $data['username'];
                
                return $this->view("profile/index", [
                    'title' => 'Thông tin tài khoản',
                    'user' => $userModel->find($user['id']),
                    'success' => 'Cập nhật thông tin thành công!'
                ]);
            } catch (Exception $e) {
                return $this->view("profile/index", [
                    'title' => 'Thông tin tài khoản',
                    'user' => $user,
                    'error' => 'Đã xảy ra lỗi khi cập nhật!'
                ]);
            }
        }
        
        header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/profile/index');
        exit;
    }
}
