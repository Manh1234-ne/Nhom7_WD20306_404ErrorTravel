<?php
require_once PATH_MODEL . 'NhanSu.php';

class NhanSuController {
    private $model;

    public function __construct() {
        $this->model = new NhanSu();
    }

    public function index() {
        $nhansu = $this->model->getAllWithNguoiDung();
        require PATH_VIEW . 'nhansu/index.php';
    }

    public function add() {
        require PATH_VIEW . 'nhansu/add.php';
    }

    public function store() {
        $this->model->createNhanSu($_POST);
        header("Location: ?action=nhansu");
        exit;
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        $nhansu = $this->model->findWithNguoiDung($id);
        require PATH_VIEW . 'nhansu/edit.php';
    }

    public function update() {
        $id = $_POST['id'];
        $this->model->updateNhanSu($id, $_POST);
        header("Location: ?action=nhansu");
        exit;
    }

    public function delete() {
        $id = $_GET['id'];
        $this->model->deleteNhanSu($id);
        header("Location: ?action=nhansu");
        exit;
    }
}
