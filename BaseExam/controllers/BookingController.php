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
         $tour = $this->tourModel->find($_POST['tour_id']);
        $giaTour = $tour['gia'];

        // Lấy tiền cọc người dùng nhập
        $tien_coc = $_POST['tien_coc'] ?? 0;

        // -----------------------------
        //  KIỂM TRA LOGIC TIỀN CỌC
        // -----------------------------
        if ($giaTour > 500000) {

            // Nếu tour giá cao mà khách không nhập cọc
            if ($tien_coc <= 0) {
                $error = "Tour có giá trên 500.000 VNĐ bắt buộc phải đặt cọc!";
                $tour = $tour; // giữ lại dữ liệu
                require PATH_VIEW . "tours/create.php";
                return;
            }

        } else {
            // Tour giá ≤ 500.000 thì tự gán 0
            $tien_coc = 0;
        }

        $data = [
            'tour_id'        => $_POST['tour_id'],
            'ten_khach'      => $_POST['ten_khach'],
            'so_dien_thoai'  => $_POST['so_dien_thoai'],
            'email'          => $_POST['email'],
            'cccd'          => $_POST['cccd'],
            'so_nguoi'       => $_POST['so_nguoi'],
            'ngay_khoi_hanh' => $_POST['ngay_khoi_hanh'],
            'gia' => $_POST['gia'] ?? 0,
            'trang_thai'     => $_POST['trang_thai'],
            'ghi_chu'        => $_POST['ghi_chu'],
            'tinh_trang_thanh_toan' => $_POST['tinh_trang_thanh_toan'],
             'tien_coc' => $_POST['tien_coc'] ?? 0,
            'yeu_cau_dac_biet' => $_POST['yeu_cau_dac_biet'] ?? '',
        ];

        $this->model->create($data);

        header("Location: ?action=qlbooking");
exit();

    }
}