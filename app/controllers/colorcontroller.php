
<?php
class colorcontroller extends Controller
{
    // private $role = ['admin'];
    // // handle
    // function __construct() {
    //     if(!in_array($_SESSION['role'],$this->role)) {
    //        header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/color/Color');
    //     exit;
    //     }
    // }
    public function Color()
    {
        $color = $this->model('Color');
        $data = $color->all();
        $title = "Danh sách màu sắc";
        $this->view("color/index", [
            'title' => $title,
            'colors' => $data
        ]);
    }

    public function delete($id){
        $color = $this->model('Color');
        $color->delete($id);
        
        header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/color/Color');
        exit;
    }
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            return $this->view("color/add",[]);
        }
        else {
            $name = $_POST['name'] ?? '';
            if ($name) {
                try {
                    $color = $this->model('Color');
                    $color->add(['name' => $name]);
                } catch (Exception $e) {
                    return $this->view("color/add", [
                        'error' => 'Màu sắc này đã tồn tại hoặc có lỗi xảy ra!'
                    ]);
                }
            }
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/color/Color');
            exit;
        }
    }
    public function update($id){
        $color = $this->model('Color');
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $data = $color->find($id);
            return $this->view("color/update",[
                'color' => $data
            ]);
        }
        else {
            $name = $_POST['name'] ?? '';
            if ($name) {
                try {
                    $color->update(['name' => $name], $id);
                } catch (Exception $e) {
                    return $this->view("color/update", [
                        'error' => 'Màu sắc này đã tồn tại hoặc có lỗi xảy ra!',
                        'color' => $color->find($id)
                    ]);
                }
            }
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/color/Color');
            exit;
        }
    }
    


}