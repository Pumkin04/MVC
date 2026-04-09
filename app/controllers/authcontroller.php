<?php
class authcontroller extends Controller
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return $this->view("auth/register", ['title' => 'Đăng ký']);
        } else {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($username && $email && $password) {
                $userModel = $this->model('User');
                // Check if email already exists
                if ($userModel->findByEmail($email)) {
                    return $this->view("auth/register", [
                        'title' => 'Đăng ký',
                        'error' => 'Email này đã được sử dụng!'
                    ]);
                }

                try {
                    $userModel->add([
                        'username' => $username,
                        'email' => $email,
                        'password' => $password,
                        'role' => 'user'
                    ]);
                    header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/auth/login');
                    exit;
                } catch (Exception $e) {
                    return $this->view("auth/register", [
                        'title' => 'Đăng ký',
                        'error' => 'Đã xảy ra lỗi khi đăng ký!'
                    ]);
                }
            }
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return $this->view("auth/login", ['title' => 'Đăng nhập']);
        } else {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($email && $password) {
                $userModel = $this->model('User');
                $user = $userModel->findByEmail($email);

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user;
                    header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/');
                    exit;
                } else {
                    return $this->view("auth/login", [
                        'title' => 'Đăng nhập',
                        'error' => 'Email hoặc mật khẩu không chính xác!'
                    ]);
                }
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/');
        exit;
    }

    public function forgotPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return $this->view("auth/forgot", ['title' => 'Quên mật khẩu']);
        } else {
            $email = $_POST['email'] ?? '';
            $userModel = $this->model('User');
            $user = $userModel->findByEmail($email);

            if ($user) {
                return $this->view("auth/reset", [
                    'title' => 'Đặt lại mật khẩu',
                    'email' => $email
                ]);
            } else {
                return $this->view("auth/forgot", [
                    'title' => 'Quên mật khẩu',
                    'error' => 'Email này không tồn tại trong hệ thống!'
                ]);
            }
        }
    }

    public function resetPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            if ($password !== $confirm_password) {
                return $this->view("auth/reset", [
                    'title' => 'Đặt lại mật khẩu',
                    'email' => $email,
                    'error' => 'Mật khẩu xác nhận không khớp!'
                ]);
            }

            $userModel = $this->model('User');
            $user = $userModel->findByEmail($email);

            if ($user) {
                $userModel->update([
                    'username' => $user['username'],
                    'email' => $email,
                    'password' => $password,
                    'role' => $user['role']
                ], $user['id']);

                return $this->view("auth/login", [
                    'title' => 'Đăng nhập',
                    'success' => 'Đổi mật khẩu thành công! Hãy đăng nhập lại.'
                ]);
            }
        }
        header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/auth/login');
        exit;
    }
}
