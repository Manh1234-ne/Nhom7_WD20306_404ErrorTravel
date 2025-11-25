<?php
require_once PATH_MODEL . "Booking.php";
require_once PATH_MODEL . "Tour.php";

class BookingController {
    private $model;
    private $tourModel;

    public function __construct() {
        $this->model = new Booking();
        $this->tourModel = new Tour();
    }

    public function create() {
        $id = $_GET['id'];
        $tour = $this->tourModel->find($id);

        require PATH_VIEW . "tours/create.php";
    }

    public function save() {
        $data = [
            'tour_id'        => $_POST['tour_id'],
            'ten_khach'      => $_POST['ten_khach'],
            'so_dien_thoai'  => $_POST['so_dien_thoai'],
            'email'          => $_POST['email'],
            'so_nguoi'       => $_POST['so_nguoi'],
            'ngay_khoi_hanh' => $_POST['ngay_khoi_hanh'],
            'trang_thai'     => $_POST['trang_thai'],
            'ghi_chu'        => $_POST['ghi_chu']
        ];

        $this->model->create($data);

        header("Location: ?action=tours");
exit();

    }

    
}