<?php
require_once PATH_MODEL . 'QlBookingModel.php';
require_once PATH_MODEL . "PaymentHistory.php";


class QlBookingController
{
    protected $model;

    public function __construct()
    {
        $this->model = new qlb();
    }

    // ===============================
    // Danh sách booking
    // ===============================
    public function index()
    {
        $qlbooking = $this->model->all();
        require PATH_VIEW . 'qlbooking/index.php';
    }

    // ===============================
    // Trang sửa booking
    // ===============================
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) die("Không tìm thấy ID booking");

        $qlb = $this->model->find($id);
        require PATH_VIEW . 'qlbooking/edit.php';
    }

    // ===============================
    // Update booking
    // ===============================
    public function update()
    {
        $id = $_POST['id'] ?? null;
        if (!$id) die("Không tìm thấy ID booking");

        $data = [
            'ten_khach' => $_POST['ten_khach'] ?? '',
            'so_dien_thoai' => $_POST['so_dien_thoai'] ?? '',
            'cccd' => $_POST['cccd'] ?? '',
            'so_nguoi' => $_POST['so_nguoi'] ?? '',
            'ngay_khoi_hanh' => $_POST['ngay_khoi_hanh'] ?? '',
            'gia' => $_POST['gia'] ?? 0,
            'trang_thai' => $_POST['trang_thai'] ?? '',
            'tinh_trang_thanh_toan' => $_POST['tinh_trang_thanh_toan'] ?? '',
            'yeu_cau_dac_biet' => $_POST['yeu_cau_dac_biet'] ?? '',
        ];

        $this->model->update($id, $data);
        header('Location: ?action=qlbooking');
        exit;
    }

    // ===============================
    // Chi tiết booking
    // ===============================
    public function detail()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) die("Không tìm thấy ID booking");

        $qlb = $this->model->find($id);
        if (!$qlb) die("Booking không tồn tại");

        $historyModel = new PaymentHistory();
        $lich_su = $historyModel->getByBooking($id);

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
 $phan_cong = null;
    if (!empty($qlb['lich_khoi_hanh_id'])) {
        $phan_cong = $this->model->getPhanCongHDV(
            $qlb['lich_khoi_hanh_id']
        );
    }
        require PATH_VIEW . 'qlbooking/detail.php';
    }

    // ===============================
    // 👉 DANH SÁCH KHÁCH CÙNG TOUR (THÊM MỚI)
    // ===============================
    public function customersSameTour()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) die("Thiếu booking ID");

        $booking = $this->model->find($id);
        if (!$booking) die("Không tìm thấy booking");

        $customers = $this->model->getCustomersByTour($booking['tour_id']);

        require PATH_VIEW . 'qlbooking/customers_same_tour.php';
    }

    // ===============================
    // Trang thanh toán
    // ===============================
    public function pay()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) die("Không tìm thấy booking");

        $qlb = $this->model->find($id);
        require PATH_VIEW . 'qlbooking/pay.php';
    }

    // ===============================
    // XỬ LÝ THANH TOÁN
    // ===============================
    public function paySubmit()
    {
        $id = $_POST['id'] ?? null;
        if (!$id) die("Không tìm thấy booking");

        $so_tien = (int)($_POST['so_tien'] ?? 0);
        $type = $_POST['type'] ?? 'coc';

        $qlb = $this->model->find($id);
        if (!$qlb) die("Không tìm thấy booking");

        $gia_tour = (int)$qlb['gia'];
        $da_tra_coc = (int)($qlb['tien_coc_da_tra'] ?? 0);
        $da_tra_full = (int)($qlb['tien_full_da_tra'] ?? 0);

        // THANH TOÁN CỌC
        if ($type === "coc") {
            $tien_coc_40 = $gia_tour * 0.4;
            if ($da_tra_coc >= $tien_coc_40) {
                header("Location: ?action=qlbooking");
                exit;
            }

            $this->model->update($id, [
                'tien_coc_da_tra' => $da_tra_coc + $so_tien,
                'trang_thai' => 'Đã xác nhận',
                'tinh_trang_thanh_toan' => 'Đã cọc'
            ]);

            (new PaymentHistory())->create($id, $so_tien);
            header("Location: ?action=qlbooking");
            exit;
        }

        // THANH TOÁN FULL
        if ($type === "full") {
            $this->model->update($id, [
                'tien_full_da_tra' => $da_tra_full + $so_tien,
                'trang_thai' => 'Đặt thành công',
                'tinh_trang_thanh_toan' => 'Đã thanh toán'
            ]);

            (new PaymentHistory())->create($id, $so_tien);
            header("Location: ?action=qlbooking");
            exit;
        }
    }
  // ===============================
// PHÂN CÔNG HDV CHO BOOKING
// ===============================
public function phanCongHDV()
{
    $booking_id = $_POST['booking_id'] ?? null;
    $hdv_id     = $_POST['huong_dan_vien_id'] ?? null;

    if (!$booking_id || !$hdv_id) {
        die("Thiếu dữ liệu phân công");
    }

    $booking = $this->model->find($booking_id);
    if (!$booking) {
        die("Booking không tồn tại");
    }

    // ❌ Chưa cọc → không cho phân công
    if (!$this->model->daTraCoc($booking_id)) {
        $_SESSION['error'] = 'Booking chưa thanh toán cọc';
        header("Location: ?action=qlbooking");
        exit;
    }

    $lich_khoi_hanh_id = $booking['lich_khoi_hanh_id'];

    // ❌ Đã phân công
    if ($this->model->daPhanCongHDV($lich_khoi_hanh_id)) {
        $_SESSION['error'] = 'Lịch khởi hành đã được phân công HDV';
        header("Location: ?action=qlbooking");
        exit;
    }

    // ✅ Phân công
    $this->model->phanCongHDV($lich_khoi_hanh_id, $hdv_id);

    $_SESSION['success'] = 'Phân công HDV thành công';
    header("Location: ?action=qlbooking");
    exit;
}
}