<?php

class ContactController extends Controller
{
    private function checkAdmin()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/auth/login');
            exit;
        }
    }

    public function index()
    {
        $this->view("contact/create", [
            'title' => 'Liên hệ với chúng tôi'
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/contact/index');
            exit;
        }

        $data = [
            'full_name' => trim($_POST['full_name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'subject' => trim($_POST['subject'] ?? ''),
            'message' => trim($_POST['message'] ?? '')
        ];

        $errors = [];
        if (empty($data['full_name'])) $errors['full_name'] = "Họ tên không được để trống";
        if (empty($data['email'])) {
            $errors['email'] = "Email không được để trống";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email không đúng định dạng";
        }
        if (empty($data['phone'])) $errors['phone'] = "Số điện thoại không được để trống";
        if (empty($data['subject'])) $errors['subject'] = "Chủ đề không được để trống";
        if (empty($data['message'])) $errors['message'] = "Nội dung không được để trống";

        if (!empty($errors)) {
            return $this->view("contact/create", [
                'title' => 'Liên hệ với chúng tôi',
                'errors' => $errors,
                'old' => $data
            ]);
        }

        $contactModel = $this->model('Contact');
        if ($contactModel->add($data)) {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/contact/index?success=1');
            exit;
        } else {
            return $this->view("contact/create", [
                'title' => 'Liên hệ với chúng tôi',
                'error' => 'Đã có lỗi xảy ra, vui lòng thử lại.',
                'old' => $data
            ]);
        }
    }

    public function admin_list()
    {
        $this->checkAdmin();
        
        $q = $_GET['q'] ?? '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $contactModel = $this->model('Contact');
        $contacts = $contactModel->search($q, $offset, $limit);
        $totalMatches = $contactModel->count($q);
        $totalAll = $contactModel->count();
        $totalPages = ceil($totalMatches / $limit);

        return $this->view("contact/admin_index", [
            'title' => 'Quản lý Liên hệ',
            'contacts' => $contacts,
            'totalAll' => $totalAll,
            'totalMatches' => $totalMatches,
            'q' => $q,
            'page' => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function delete()
    {
        $this->checkAdmin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/contact/admin_list');
            exit;
        }

        $id = $_POST['id'] ?? null;
        if ($id) {
            $contactModel = $this->model('Contact');
            $contactModel->delete($id);
        }

        $q = $_GET['q'] ?? '';
        $page = $_GET['page'] ?? '';
        $redirect = '/contact/admin_list?q=' . urlencode($q) . '&page=' . $page;
        header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . $redirect);
        exit;
    }
}
