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
        $qlbooking = $this->model->getAllWithHDV();
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
        $phan_cong = $this->model->getPhanCongByTour($qlb['tour_id']);
    $ds_hdv = $this->model->getDanhSachHDV();
$b = $qlb;
    require PATH_VIEW . 'qlbooking/detail.php';
    }
    public function phanCongHDV()
{
    $booking_id = $_POST['booking_id'] ?? null;
    $hdv_id     = $_POST['huong_dan_vien_id'] ?? null;
    $ghi_chu    = $_POST['ghi_chu'] ?? '';

    if (!$booking_id || !$hdv_id) die("Thiếu dữ liệu");

    $booking = $this->model->find($booking_id);
    if (!$booking) die("Booking không tồn tại");

    if (!$this->model->daTraCoc($booking_id)) {
        $_SESSION['error'] = 'Booking chưa cọc';
        require PATH_VIEW . 'qlbooking/detail.php';
        exit;
    }

    if ($this->model->daPhanCongHDV($booking['tour_id'])) {
        $_SESSION['error'] = 'Tour đã có HDV';
         require PATH_VIEW . 'qlbooking/detail.php';
        exit;
    }

    $this->model->phanCongHDV(
        $booking['tour_id'],
        $hdv_id,
        $ghi_chu
    );

    $_SESSION['success'] = 'Phân công HDV thành công';
      require PATH_VIEW . 'qlbooking/detail.php';
    exit;
}
public function doiHDV()
{
    $booking_id = $_POST['booking_id'] ?? null;
    $hdv_id     = $_POST['huong_dan_vien_id'] ?? null;

    if (!$booking_id || !$hdv_id) die("Thiếu dữ liệu");

    $booking = $this->model->find($booking_id);
    if (!$booking) die("Booking không tồn tại");

    $this->model->doiHDV($booking['tour_id'], $hdv_id);

    $_SESSION['success'] = 'Đổi HDV thành công';
    header('Location: ?action=qlbooking');
    exit;
}

}