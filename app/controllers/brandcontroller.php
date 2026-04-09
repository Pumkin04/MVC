<?php
class brandcontroller extends Controller
{
    public function Brand()
    {
        $brand = $this->model('Brand');
        $data = $brand->all();
        $title = "Danh sách thương hiệu";
        $this->view("brand/index", [
            'title' => $title,
            'brands' => $data
        ]);
    }

    public function delete($id){
        $brand = $this->model('Brand');
        $brand->delete($id);
        
        header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/brand/Brand');
        exit;
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            return $this->view("brand/add",[]);
        }
        else {
            $name = $_POST['name'] ?? '';

            if ($name) {
                try {
                    $brand = $this->model('Brand');
                    $brand->add([
                        'name' => $name
                    ]);
                } catch (Exception $e) {
                    return $this->view("brand/add", [
                        'error' => 'Thương hiệu này đã tồn tại!'
                    ]);
                }
            }
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/brand/Brand');
            exit;
        }
    }

    public function update($id){
        $brand = $this->model('Brand');
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $data = $brand->find($id);
            return $this->view("brand/update",[
                'brand' => $data
            ]);
        }
        else {
            $name = $_POST['name'] ?? '';

            if ($name) {
                try {
                    $brand->update([
                        'name' => $name
                    ], $id);
                } catch (Exception $e) {
                    return $this->view("brand/update", [
                        'error' => 'Đã tồn tại!',
                        'brand' => $brand->find($id)
                    ]);
                }
            }
            header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/brand/Brand');
            exit;
        }
    }
}
