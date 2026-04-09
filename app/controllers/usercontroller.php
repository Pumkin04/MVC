<?php
class usercontroller extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/auth/login');
            exit;
        }
    }
    public function User()
    {
        $user = $this->model('User');
        $data = $user->all();
        $title = "Quản lý Người dùng";
        $this->view("user/index", [
            'title' => $title,
            'users' => $data
        ]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return $this->view("user/add", ['title' => 'Thêm Người dùng']);
        } else {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'user';

            if ($username && $email && $password) {
                try {
                    $user = $this->model('User');
                    $user->add([
                        'username' => $username,
                        'email' => $email,
                        'password' => $password,
                        'role' => 'user' // Chốt cứng role là user khi thêm mới
                    ]);
                } catch (Exception $e) {
                    return $this->view("user/add", [
                        'error' => 'Email đã tồn tại!'
                    ]);
                }
            }
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/user/User');
            exit;
        }
    }

    public function update($id)
    {
        $userModel = $this->model('User');
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $data = $userModel->find($id);
            return $this->view("user/update", [
                'user' => $data,
                'title' => 'Sửa Người dùng'
            ]);
        } else {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'user';

            if ($username && $email) {
                try {
                    $userModel->update([
                        'username' => $username,
                        'email' => $email,
                        'password' => $password,
                        'role' => $role
                    ], $id);
                } catch (Exception $e) {
                    return $this->view("user/update", [
                        'error' => 'Email đã tồn tại!',
                        'user' => $userModel->find($id)
                    ]);
                }
            }
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/user/User');
            exit;
        }
    }

    public function delete($id)
    {
        $user = $this->model('User');
        $user->delete($id);
        header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/user/User');
        exit;
    }
}
