<?php
require_once PATH_MODEL.'Tour.php';

class TourController {
    protected $model;

    public function __construct() {
        $this->model = new Tour();
    }

    public function index() {
        $tours = $this->model->all();
        require PATH_VIEW.'tours/index.php';
    }

    public function add() {
        $loaiTours = ['Trong nước','Nước ngoài','Mạo hiểm','Nghỉ dưỡng'];
        require PATH_VIEW.'tours/add.php';
    }

    public function store() {
        $data = [
            'ten_tour' => $_POST['ten_tour'],
            'loai_tour' => $_POST['loai_tour'],
            'mo_ta' => $_POST['mo_ta'],
            'gia' => $_POST['gia'],
            'chinh_sach' => $_POST['chinh_sach']
        ];

        // Xử lý upload hình ảnh
        if (!empty($_FILES['hinh_anh']['name'])) {
            $fileName = time().'_'.$_FILES['hinh_anh']['name'];
            move_uploaded_file($_FILES['hinh_anh']['tmp_name'], 'assets/uploads/'.$fileName);
            $data['hinh_anh'] = $fileName;
        }

        $this->model->insert($data);
        header('Location: ?action=tours'); exit;
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        $tour = $this->model->find($id);
        $loaiTours = ['Trong nước','Nước ngoài','Mạo hiểm','Nghỉ dưỡng'];
        require PATH_VIEW.'tours/edit.php';
    }

    public function update() {
        $id = $_POST['id'];
        $data = [
            'ten_tour' => $_POST['ten_tour'],
            'loai_tour' => $_POST['loai_tour'],
            'mo_ta' => $_POST['mo_ta'],
            'gia' => $_POST['gia'],
            'chinh_sach' => $_POST['chinh_sach']
        ];

        if (!empty($_FILES['hinh_anh']['name'])) {
            $fileName = time().'_'.$_FILES['hinh_anh']['name'];
            move_uploaded_file($_FILES['hinh_anh']['tmp_name'], 'assets/uploads/'.$fileName);
            $data['hinh_anh'] = $fileName;
        }

        $this->model->update($id, $data);
        header('Location: ?action=tours'); exit;
    }

    public function delete() {
        $id = $_GET['id'];
        $this->model->delete($id);
        header('Location: ?action=tours'); exit;
    }
}
