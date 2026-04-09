
<?php
class danhmuccontroller extends Controller
{
    // private $role = ['admin'];
    // // handle
    // function __construct() {
    //     if(!in_array($_SESSION['role'],$this->role)) {
    //         header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/danhmuc/Danhmuc');
    //         exit;
    //     }
    // }
    public function Danhmuc()
    {
        $danhmuc = $this->model('Danhmuc');
        $data = $danhmuc->all();
        $title = "Danh sách danh mục";
        $this->view("danhmuc/index", [
            'title' => $title,
            'danhmucs' => $data
        ]);
    }

    public function delete($id){
        $danhmuc = $this->model('Danhmuc');
        $danhmuc->delete($id);
        
        header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/danhmuc/Danhmuc');
        exit;
    }
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            return $this->view("danhmuc/add",[]);
        }
        else {
            $name = $_POST['name'] ?? '';

            if ($name) {
                try {
                    $danhmuc = $this->model('Danhmuc');
                    $danhmuc->add(['name' => $name]);
                } catch (Exception $e) {
                    return $this->view("danhmuc/add", [
                        'error' => 'danh mục này đã tồn tại!'
                    ]);
                }
            }
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/danhmuc/Danhmuc');
            exit;
        }
    }
    public function update($id){
        $danhmuc = $this->model('Danhmuc');
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $data = $danhmuc->find($id);
            return $this->view("danhmuc/update",[
                'danhmuc' => $data
            ]);
        }
        else {
            $name = $_POST['name'] ?? '';

            if ($name) {
                try {
                    $danhmuc->update(['name' => $name], $id);
                } catch (Exception $e) {
                    return $this->view("danhmuc/update", [
                        'error' => 'Đã tồn tại!',
                        'danhmuc' => $danhmuc->find($id)
                    ]);
                }
            }
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/danhmuc/Danhmuc');
            exit;
        }
    }
    


}