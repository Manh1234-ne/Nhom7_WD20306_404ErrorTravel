<?php
require_once PATH_MODEL . "Booking.php";
require_once PATH_MODEL . "Tour.php";
require_once PATH_MODEL . "TourLog.php";
require_once PATH_MODEL . "YeuCauModel.php";

class BookingController
{
    private $model;
    private $tourModel;

    public function __construct()
    {
        $this->model = new Booking();
        $this->tourModel = new Tour();
    }

    // ===============================
    // FORM ĐẶT TOUR
    // ===============================
    public function create()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) die("Không tìm thấy tour");

        $tour = $this->tourModel->find($id);
        if (!$tour) die("Tour không tồn tại");

        require PATH_VIEW . "tours/create.php";
    }

    // ===============================
    // LƯU BOOKING + FILE EXCEL
    // ===============================
    public function save()
    {
        $tour = $this->tourModel->find($_POST['tour_id']);
        if (!$tour) die("Tour không tồn tại");

        $giaTour = (int)$tour['gia'];
        $tien_coc = $_POST['tien_coc'] ?? 0;

        if ($giaTour > 500000) {
            $tienCocBatBuoc = $giaTour * 0.4;
            if ((int)$tien_coc !== (int)$tienCocBatBuoc) {
                $error = "Tiền cọc phải bằng 40% giá tour";
                require PATH_VIEW . "tours/create.php";
                return;
            }
        } else {
            $tien_coc = 0;
        }

        // Upload file Excel
        $danh_sach_file = null;
        if (!empty($_FILES['danh_sach_file']['name'])) {
            $file = $_FILES['danh_sach_file'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if (!in_array($ext, ['xls', 'xlsx'])) die("Chỉ cho phép file Excel");

            $uploadDir = "assets/uploads/";
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $fileName = time() . "_booking_" . uniqid() . "." . $ext;
            if (!move_uploaded_file($file['tmp_name'], $uploadDir . $fileName)) die("Upload file thất bại");

            $danh_sach_file = $fileName;
        }

        $data = [
            'tour_id'               => $_POST['tour_id'],
            'ten_khach'             => $_POST['ten_khach'],
            'so_dien_thoai'         => $_POST['so_dien_thoai'],
            'email'                 => $_POST['email'] ?? '',
            'cccd'                  => $_POST['cccd'],
            'so_nguoi'              => $_POST['so_nguoi'],
            'ngay_khoi_hanh'        => $_POST['ngay_khoi_hanh'],
            'gia'                   => $_POST['gia'],
            'trang_thai'            => $_POST['trang_thai'],
            'tinh_trang_thanh_toan' => $_POST['tinh_trang_thanh_toan'],
            'tien_coc'              => $tien_coc,
            'yeu_cau_dac_biet'      => $_POST['yeu_cau_dac_biet'] ?? '',
            'ghi_chu'               => $_POST['ghi_chu'] ?? '',
            'danh_sach_file'        => $danh_sach_file
        ];

        $bookingId = $this->model->create($data);

        // Ghi nhật ký tạo booking
        $logModel = new TourLog();
        $logModel->create(
            $bookingId,
            $_POST['lich_khoi_hanh_id'] ?? null,
            null,
            'Tạo booking',
            "Tạo booking cho khách: {$data['ten_khach']}, số người: {$data['so_nguoi']}"
        );

        // Tạo yêu cầu đặc biệt
        if (!empty($data['yeu_cau_dac_biet']) && trim($data['yeu_cau_dac_biet']) !== '') {
            $yeuCauModel = new YeuCauModel();
            $yeuCauData = [
                'booking_id' => $bookingId,
                'tour_id' => $data['tour_id'],
                'ten_khach' => $data['ten_khach'],
                'loai_yeu_cau' => 'Khác',
                'mo_ta' => $data['yeu_cau_dac_biet']
            ];
            $yeuCauModel->createFromBooking($bookingId, $yeuCauData);

            // Ghi nhật ký yêu cầu đặc biệt
            $logModel->create(
                $bookingId,
                $_POST['lich_khoi_hanh_id'] ?? null,
                null,
                'Yêu cầu đặc biệt',
                "Khách yêu cầu đặc biệt: {$data['yeu_cau_dac_biet']}"
            );
        }

        header("Location: ?action=qlbooking");
        exit;
    }

    // ===============================
    // DOWNLOAD FILE DANH SÁCH KHÁCH
    // ===============================
    public function download()
    {
        $file = $_GET['file'] ?? '';
        $file = basename($file);

        $fullPath = PATH_ASSETS_UPLOADS . $file;

        if (!file_exists($fullPath)) {
            http_response_code(404);
            die("File không tồn tại");
        }

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fullPath));

        readfile($fullPath);
        exit;
    }
}
