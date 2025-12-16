<?php
require_once PATH_MODEL . "Booking.php";
require_once PATH_MODEL . "Tour.php";

class BookingController
{
    private $model;
    private $tourModel;

    public function __construct()
    {
        $this->model = new Booking();
        $this->tourModel = new Tour();
    }

    public function create()
    {
        $id = $_GET['id'];
        $tour = $this->tourModel->find($id);

        require PATH_VIEW . "tours/create.php";
    }

    public function save()
    {
        $tour = $this->tourModel->find($_POST['tour_id']);
        $giaTour = $tour['gia'];

        // Lấy tiền cọc người dùng nhập
        $tien_coc = $_POST['tien_coc'] ?? 0;

        // -----------------------------
        // KIỂM TRA LOGIC TIỀN CỌC
        // -----------------------------
        if ($giaTour > 500000) {
            $tienCocBatBuoc = $giaTour * 0.4;

            // So sánh tiền cọc nhập với 40% giá tour
            if ($tien_coc != $tienCocBatBuoc) {
                $error = "Tiền cọc phải bằng 40% giá tour (" . number_format($tienCocBatBuoc) . " VNĐ)";
                require PATH_VIEW . "tours/create.php";
                return;
            }
        } else {
            $tien_coc = 0;
        }

        // -----------------------------
        // XỬ LÝ FILE UPLOAD DANH SÁCH KHÁCH
        // -----------------------------
        $danh_sach_file = null;
        if (isset($_FILES['danh_sach']) && $_FILES['danh_sach']['error'] === 0) {
            $folder = "uploads/danh_sach_khach/";
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            $fileName = time() . "_" . basename($_FILES['danh_sach']['name']);
            move_uploaded_file($_FILES['danh_sach']['tmp_name'], $folder . $fileName);

            $danh_sach_file = $fileName;
        }

        // -----------------------------
        // LƯU DỮ LIỆU BOOKING
        // -----------------------------
        $data = [
            'tour_id'              => $_POST['tour_id'],
            'ten_khach'            => $_POST['ten_khach'],
            'so_dien_thoai'        => $_POST['so_dien_thoai'],
            'email'                => $_POST['email'],
            'cccd'                 => $_POST['cccd'],
            'so_nguoi'             => $_POST['so_nguoi'],
            'ngay_khoi_hanh'       => $_POST['ngay_khoi_hanh'],
            'gia'                  => $_POST['gia'] ?? 0,
            'trang_thai'           => $_POST['trang_thai'],
            'ghi_chu'              => $_POST['ghi_chu'] ?? '',
            'tinh_trang_thanh_toan'=> $_POST['tinh_trang_thanh_toan'] ?? '',
            'tien_coc'             => $tien_coc,
            'yeu_cau_dac_biet'     => $_POST['yeu_cau_dac_biet'] ?? '',
            'danh_sach_file'       => $danh_sach_file
        ];

        $bookingId = $this->model->create($data);

        // Tự động tạo yêu cầu đặc biệt nếu có
        if (!empty($data['yeu_cau_dac_biet']) && trim($data['yeu_cau_dac_biet']) !== '') {
            try {
                require_once __DIR__ . '/../models/YeuCauModel.php';
                $yeuCauModel = new YeuCauModel();
                
                $yeuCauData = [
                    'booking_id' => $bookingId,
                    'tour_id' => $data['tour_id'],
                    'ten_khach' => $data['ten_khach'],
                    'loai_yeu_cau' => 'Khác', // Mặc định là "Khác"
                    'mo_ta' => $data['yeu_cau_dac_biet']
                ];
                
                $yeuCauModel->createFromBooking($bookingId, $yeuCauData);
            } catch (Exception $e) {
                // Không dừng quá trình nếu tạo yêu cầu thất bại
                error_log('Lỗi tạo yêu cầu đặc biệt: ' . $e->getMessage());
            }
        }

        header("Location: ?action=qlbooking");
        exit();
    }
}
