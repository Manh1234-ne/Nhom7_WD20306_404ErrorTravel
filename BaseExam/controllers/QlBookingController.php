<?php
require_once PATH_MODEL . 'QlBookingModel.php';
require_once PATH_MODEL . 'PaymentHistory.php';
require_once PATH_MODEL . 'TourLog.php';

class QlBookingController
{
    protected $model;

    public function __construct()
    {
        $this->model = new qlb();
    }

    public function index()
    {
        $qlbooking = $this->model->all();
        require PATH_VIEW . 'qlbooking/index.php';
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) die('Không tìm thấy ID booking');

        $qlb = $this->model->find($id);
        if (!$qlb) die('Booking không tồn tại');

        require PATH_VIEW . 'qlbooking/edit.php';
    }

    public function update()
    {
        $id = $_POST['id'] ?? null;
        if (!$id) die('Không tìm thấy ID booking');

        $data = [
            'ten_khach' => $_POST['ten_khach'] ?? '',
            'so_dien_thoai' => $_POST['so_dien_thoai'] ?? '',
            'email' => $_POST['email'] ?? '',
            'cccd' => $_POST['cccd'] ?? '',
            'so_nguoi' => (int)($_POST['so_nguoi'] ?? 1),
            'ngay_khoi_hanh' => $_POST['ngay_khoi_hanh'] ?? '',
            'gia' => (int)($_POST['gia'] ?? 0),
            'trang_thai' => $_POST['trang_thai'] ?? '',
            'tinh_trang_thanh_toan' => $_POST['tinh_trang_thanh_toan'] ?? '',
            'yeu_cau_dac_biet' => $_POST['yeu_cau_dac_biet'] ?? '',
            'ghi_chu' => $_POST['ghi_chu'] ?? '',
        ];

        $this->model->update($id, $data);

        (new TourLog())->create(
    (int)$id,        // booking_id
    null,            // lich_khoi_hanh_id
    null,            // hdv_id
    'Cập nhật booking',
    'Cập nhật thông tin booking'
);


        header('Location: ?action=qlbooking');
        exit;
    }

    public function detail()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) die('Không tìm thấy booking');

        $qlb = $this->model->find($id);
        if (!$qlb) die('Booking không tồn tại');

        $lich_su = (new PaymentHistory())->getByBooking($id);
        $nhat_ky = (new TourLog())->getByBooking($id);

        // ⚠️ TẠM QUY ƯỚC booking_id = lich_khoi_hanh_id
        $phan_cong = $this->model->getPhanCongHDV($id);

    // ===============================
    // LẤY THÔNG TIN TOUR + LỊCH TRÌNH
    // ===============================
    $tour = null;
    $itinerary = [];

    if (!empty($qlb['tour_id'])) {
        require_once PATH_MODEL . 'Tour.php';
        $tourModel = new Tour();
        $tour = $tourModel->find($qlb['tour_id']);

        if (!empty($tour['lich_trinh'])) {
            $decoded = json_decode($tour['lich_trinh'], true);
            if (is_array($decoded)) {
                $itinerary = $decoded;
            }
        }
    }

    public function pay()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) die('Không tìm thấy booking');

        $qlb = $this->model->find($id);
        require PATH_VIEW . 'qlbooking/pay.php';
    }

    public function paySubmit()
    {
        $id = $_POST['id'] ?? null;
        $so_tien = (int)($_POST['so_tien'] ?? 0);
        $type = $_POST['type'] ?? 'coc';

        if (!$id || $so_tien <= 0) die('Thiếu dữ liệu');

        $qlb = $this->model->find($id);
        if (!$qlb) die('Không tìm thấy booking');

        if ($type === 'coc') {
            $this->model->update($id, [
                'tien_coc_da_tra' => ($qlb['tien_coc_da_tra'] ?? 0) + $so_tien,
                'trang_thai' => 'Đã xác nhận',
                'tinh_trang_thanh_toan' => 'Đã cọc'
            ]);

            (new PaymentHistory())->create($id, $so_tien);

            (new TourLog())->create(
    (int)$id,
    null,
    null,
    'Thanh toán cọc',
    "Cọc {$so_tien}"
);

        }

        if ($type === 'full') {
            $this->model->update($id, [
                'tien_full_da_tra' => ($qlb['tien_full_da_tra'] ?? 0) + $so_tien,
                'trang_thai' => 'Đặt thành công',
                'tinh_trang_thanh_toan' => 'Đã thanh toán'
            ]);

            (new PaymentHistory())->create($id, $so_tien);
            (new TourLog())->create(
    (int)$id,
    null,
    null,
    'Thanh toán full',
    "Full {$so_tien}"
);

        }

        header('Location: ?action=qlbooking');
        exit;
    }

    public function phanCongHDV()
    {
        $booking_id = $_POST['booking_id'] ?? null;
        $hdv_id = $_POST['huong_dan_vien_id'] ?? null;
        $ghi_chu = $_POST['ghi_chu'] ?? '';

        if (!$booking_id || !$hdv_id) die('Thiếu dữ liệu');

        if (!$this->model->daTraCoc($booking_id)) {
            $_SESSION['error'] = 'Booking chưa thanh toán cọc';
            header('Location: ?action=qlbooking');
            exit;
        }

        if ($this->model->daPhanCongHDV($booking_id)) {
            $_SESSION['error'] = 'Đã phân công HDV';
            header('Location: ?action=qlbooking');
            exit;
        }

        // ⚠️ booking_id == lich_khoi_hanh_id
        $this->model->phanCongHDV($booking_id, $hdv_id, $ghi_chu);

        (new TourLog())->create(
    (int)$booking_id,     // booking_id
    (int)$booking_id,     // lich_khoi_hanh_id (bé đang quy ước)
    (int)$hdv_id,         // huong_dan_vien_id
    'Phân công HDV',      // loai_hanh_dong
    "HDV ID {$hdv_id}"    // noi_dung
);


        $_SESSION['success'] = 'Phân công HDV thành công';
        header('Location: ?action=qlbooking');
        exit;
    }

    public function doiHDV()
    {
        $booking_id = $_POST['booking_id'] ?? null;
        $hdv_id = $_POST['huong_dan_vien_id'] ?? null;

        if (!$booking_id || !$hdv_id) die('Thiếu dữ liệu');

        $this->model->doiHDV($booking_id, $hdv_id);

        (new TourLog())->create(
    (int)$booking_id,
    (int)$booking_id,
    (int)$hdv_id,
    'Đổi HDV',
    "HDV mới {$hdv_id}"
);


        $_SESSION['success'] = 'Đổi HDV thành công';
        header('Location: ?action=qlbooking');
        exit;
    }
}
