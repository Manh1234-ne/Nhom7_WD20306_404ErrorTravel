<?php
require_once PATH_MODEL . 'QlBookingModel.php';

class QlBookingController
{
    protected $model;

    public function __construct()
    {
        $this->model = new qlb();
    }

    // Trang danh sách ql booking
    public function index()
    {
        $qlbooking = $this->model->all();
        require PATH_VIEW . 'qlbooking/index.php';
    }
    
    // Trang sửa booking
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        $qlb = $this->model->find($id);
        require PATH_VIEW . 'qlbooking/edit.php';
    }

    // Xử lý update booking
    public function update()
    {
        $id = $_POST['id'];
        $data = [
            'ten_khach' => $_POST['ten_khach'] ?? '',
            'so_dien_thoai' => $_POST['so_dien_thoai'] ?? '',
            'so_nguoi' => $_POST['so_nguoi'] ?? '',
            'ngay_khoi_hanh' => $_POST['ngay_khoi_hanh'] ?? '',
            'trang_thai' => $_POST['trang_thai'] ?? '',
            'tinh_trang_thanh_toan' => $_POST['tinh_trang_thanh_toan'] ?? '',
            'yeu_cau_dac_biet' => $_POST['yeu_cau_dac_biet'] ?? '',
        ];
    $this->model->update($id, $data);
    
        header('Location: ?action=qlbooking');
        exit;
    }
    public function detail()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            die("Không tìm thấy ID tour");
        }

        $qlb = $this->model->find($id);

        require PATH_VIEW . 'qlbooking/detail.php';
    }
}