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
    // Chi tiết booking + lịch sử thanh toán
    // ===============================
    public function detail()
{
    $id = $_GET['id'] ?? null;
    if (!$id) die("Không tìm thấy ID booking");

    // Booking
    $qlb = $this->model->find($id);
    if (!$qlb) die("Booking không tồn tại");

    // Lịch sử thanh toán
    $historyModel = new PaymentHistory();
    $lich_su = $historyModel->getByBooking($id);

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

    require PATH_VIEW . 'qlbooking/detail.php';
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
    // XỬ LÝ THANH TOÁN (LOGIC CHÍNH)
    // ===============================
    public function paySubmit()
    {
        $id = $_POST['id'] ?? null;
        if (!$id) die("Không tìm thấy booking");

        $so_tien = (int)($_POST['so_tien'] ?? 0);
        $type = $_POST['type'] ?? 'coc'; // coc | full

        $qlb = $this->model->find($id);
        if (!$qlb) die("Không tìm thấy booking");

        $gia_tour = (int)$qlb['gia'];
        $da_tra_coc = (int)($qlb['tien_coc_da_tra'] ?? 0);
        $da_tra_full = (int)($qlb['tien_full_da_tra'] ?? 0);

        // =========================================
        // 1️⃣ THANH TOÁN CỌC (40%)
        // =========================================
        if ($type === "coc") {

            $tien_coc_40 = $gia_tour * 0.4;

            if ($da_tra_coc >= $tien_coc_40) {
                echo "<script>
                    alert('Khách đã đóng đủ tiền cọc.');
                    window.location='?action=qlbooking=$id';
                </script>";
                exit;
            }

            $so_tien_can_dong = $tien_coc_40 - $da_tra_coc;

            if ($so_tien > $so_tien_can_dong) {
                echo "<script>
                    alert('Số tiền vượt quá tiền cọc còn lại!');
                    history.back();
                </script>";
                exit;
            }

            $tien_coc_moi = $da_tra_coc + $so_tien;

            // ✅ CẬP NHẬT TRẠNG THÁI: ĐÃ CỌC + ĐÃ XÁC NHẬN
            $this->model->update($id, [
                'tien_coc_da_tra' => $tien_coc_moi,
                'trang_thai' => 'Đã xác nhận',
                'tinh_trang_thanh_toan' => 'Đã cọc'
            ]);

            (new PaymentHistory())->create($id, $so_tien);

            echo "<script>
                alert('Thanh toán cọc thành công!');
                window.location='?action=qlbooking&id=$id';
            </script>";
            exit;
        }

        // =========================================
        // 2️⃣ THANH TOÁN FULL
        // =========================================
        if ($type === "full") {

            $da_tra_tong = $da_tra_coc + $da_tra_full;

            if ($da_tra_tong >= $gia_tour) {
                echo "<script>
                    alert('Khách đã thanh toán đủ tour.');
                    window.location='?action=qlbooking&id=$id';
                </script>";
                exit;
            }

            $so_tien_can_dong = $gia_tour - $da_tra_tong;

            if ($so_tien > $so_tien_can_dong) {
                echo "<script>
                    alert('Số tiền vượt quá số tiền còn lại!');
                    history.back();
                </script>";
                exit;
            }

            $tien_full_moi = $da_tra_full + $so_tien;

            // ✅ CẬP NHẬT TRẠNG THÁI: ĐÃ THANH TOÁN + ĐẶT THÀNH CÔNG
            $this->model->update($id, [
                'tien_full_da_tra' => $tien_full_moi,
                'trang_thai' => 'Đặt thành công',
                'tinh_trang_thanh_toan' => 'Đã thanh toán'
            ]);

            (new PaymentHistory())->create($id, $so_tien);

            echo "<script>
                alert('Thanh toán FULL thành công!');
                window.location='?action=qlbooking&id=$id';
            </script>";
            exit;
        }
    }
}
