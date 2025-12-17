<?php
require_once PATH_MODEL . 'NhanSu.php';
require_once PATH_MODEL . 'BaseModel.php';

class NhanSuController {
    protected $model;

    public function __construct() {
        $this->model = new NhanSu();
    }

    public function index() {
        $nhansu = $this->model->getAllWithNguoiDung();
        if (!is_array($nhansu)) {
            $nhansu = []; 
        }
        require PATH_VIEW . 'nhansu/index.php';
    }

    public function add() {
        require PATH_VIEW . 'nhansu/add.php';
    }

    public function store() {
        $data = [
            'ho_ten' => $_POST['ho_ten'] ?? '',
            'email' => $_POST['email'] ?? '',
            'so_dien_thoai' => $_POST['so_dien_thoai'] ?? '',
            'ngon_ngu' => $_POST['ngon_ngu'] ?? '',
            'kinh_nghiem' => $_POST['kinh_nghiem'] ?? '',
            'danh_gia' => $_POST['danh_gia'] ?? 0,
            'vai_tro' => $_POST['vai_tro'] ?? 'huong_dan_vien'
        ];

        $this->model->createNhanSu($data);
        header('Location: ?action=nhansu');
        exit;
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ?action=nhansu');
            exit;
        }

        $nhansu = $this->model->findWithNguoiDung($id);
        if (!$nhansu) {
            echo "Không tìm thấy nhân sự!";
            return;
        }

        require PATH_VIEW . 'nhansu/edit.php';
    }

    public function update() {
        $id = $_GET['id'] ?? null;
        if (!$id) { 
            header('Location: ?action=nhansu'); 
            exit; 
        }

        $data = [
            'ho_ten' => $_POST['ho_ten'] ?? '',
            'email' => $_POST['email'] ?? '',
            'so_dien_thoai' => $_POST['so_dien_thoai'] ?? '',
            'ngon_ngu' => $_POST['ngon_ngu'] ?? '',
            'kinh_nghiem' => $_POST['kinh_nghiem'] ?? '',
            'danh_gia' => $_POST['danh_gia'] ?? 0
        ];

        // Nếu user hiện tại là admin, mới update vai trò
        if ($_SESSION['user']['vai_tro'] === 'admin' && isset($_POST['vai_tro'])) {
            $data['vai_tro'] = $_POST['vai_tro'];
        }

        $this->model->updateNhanSu($id, $data);
        header('Location: ?action=nhansu');
        exit;
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->deleteNhanSu($id);
        }
        header('Location: ?action=nhansu');
        exit;
    }
}