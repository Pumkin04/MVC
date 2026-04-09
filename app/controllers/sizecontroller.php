
<?php
class sizecontroller extends Controller
{
    // private $role = ['admin'];
    // // handle
    // function __construct() {
    //     if(!in_array($_SESSION['role'],$this->role)) {
    //        header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/size/Size');
    //        exit;
    //     }
    // }
    public function Size()
    {
        $size = $this->model('Size');
        $data = $size->all();
        $title = "Danh sách kich cỡ";
        $this->view("size/index", [
            'title' => $title,
            'sizes' => $data
        ]);
    }

    public function delete($id){
        $size = $this->model('Size');
        $size->delete($id);
        
        header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/size/Size');
        exit;
    }
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            return $this->view("size/add",[]);
        }
        else {
            $name = $_POST['name'] ?? '';
            if ($name) {
                try {
                    $size = $this->model('Size');
                    $size->add(['name' => $name]);
                } catch (Exception $e) {
                    return $this->view("size/add", [
                        'error' => 'size này đã tồn tại!'
                    ]);
                }
            }
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/size/Size');
            exit;
        }
    }
    public function update($id){
        $size = $this->model('Size');
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $data = $size->find($id);
            return $this->view("size/update",[
                'size' => $data
            ]);
        }
        else {
            $name = $_POST['name'] ?? '';
            if ($name) {
                try {
                    $size->update(['name' => $name], $id);
                } catch (Exception $e) {
                    return $this->view("size/update", [
                        'error' => 'Kích cỡ này đã tồn tại',
                        'size' => $size->find($id)
                    ]);
                }
            }
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/size/Size');
            exit;
        }
    }
    


}