<?php
require_once __DIR__ . '/../models/DanhMucTour.php';

class DanhMucTourController {
    public $modelDanhMuc;

    public function __construct() {
        $this->modelDanhMuc = new DanhMucTour();
    }

    // Trang danh sách
    public function index() {
        $tours = $this->modelDanhMuc->getAllDanhMuc();
        require_once __DIR__ . '/../views/danhmuc/index.php';
    }

    // Hiển thị form thêm
    public function add() {
        require_once __DIR__ . '/../views/danhmuc/add.php';
    }

    // Xử lý thêm mới
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ten_tour = $_POST['ten_tour'];
            $mo_ta = $_POST['mo_ta'];

            $this->modelDanhMuc->insertDanhMuc($ten_tour, $mo_ta);
            header("Location: ?action=danhmuc");
            exit;
        }
    }

    // Hiển thị form sửa
    public function edit() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $danhmuc = $this->modelDanhMuc->getDetailDanhMuc($id);
            require_once __DIR__ . '/../views/danhmuc/edit.php';
        } else {
            header("Location: ?action=danhmuc");
        }
    }

    // Xử lý cập nhật
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $ten_tour = $_POST['ten_tour'];
            $mo_ta = $_POST['mo_ta'];

            $this->modelDanhMuc->updateDanhMuc($id, $ten_tour, $mo_ta);
            header("Location: ?action=danhmuc");
            exit;
        }
    }

    // Xóa danh mục
    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelDanhMuc->destroyDanhMuc($id);
        }
        header("Location: ?action=danhmuc");
        exit;
    }
}