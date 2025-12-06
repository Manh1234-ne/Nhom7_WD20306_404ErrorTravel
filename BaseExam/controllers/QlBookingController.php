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
     //Chi tiết booking
    public function detail()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            die("Không tìm thấy ID tour");
        }

        $qlb = $this->model->find($id);
        require_once PATH_MODEL . "PaymentHistory.php";
    $historyModel = new PaymentHistory();
    $lich_su = $historyModel->getByBooking($id);


        require PATH_VIEW . 'qlbooking/detail.php';
    }
    public function pay() { $id = $_GET['id'] ?? null; if (!$id) die("Không tìm thấy booking"); $qlb = $this->model->find($id); require PATH_VIEW . 'qlbooking/pay.php'; }
  public function paySubmit()
{
    $id = $_POST['id'];
    $so_tien = (int)$_POST['so_tien'];
    $type = $_POST['type'] ?? 'coc'; // coc | full

    // Lấy booking
    $qlb = $this->model->find($id);
    if (!$qlb) die("Không tìm thấy booking");

    $gia_tour = $qlb['gia'];
    $da_tra_coc = $qlb['tien_coc_da_tra'] ?? 0;
    $da_tra_full = $qlb['tien_full_da_tra'] ?? 0;

    // ================================================
    // 1) THANH TOÁN CỌC 40%
    // ================================================
    if ($type == "coc") {

        $tien_coc_40 = $gia_tour * 0.4;

        if ($da_tra_coc >= $tien_coc_40) {
            echo "<script>
                alert('Khách đã đóng đủ tiền cọc 40%.');
                window.location='?action=qlbooking_detail&id=$id';
            </script>";
            exit;
        }

        $so_tien_can_dong = $tien_coc_40 - $da_tra_coc;
        if ($so_tien > $so_tien_can_dong) $so_tien = $so_tien_can_dong;

        $tien_da_tra_moi = $da_tra_coc + $so_tien;

        // Lưu DB
        $this->model->update($id, [
            'tien_coc_da_tra' => $tien_da_tra_moi
        ]);

        // Lưu lịch sử
        $history = new PaymentHistory();
        $history->create($id, $so_tien);

        $con_lai = $tien_coc_40 - $tien_da_tra_moi;

        echo "<script>
            alert('Thanh toán cọc thành công! Còn lại: " . number_format($con_lai) . " VNĐ');
            window.location='?action=qlbooking_detail&id=$id';
        </script>";
        exit;
    }

    // ================================================
    // 2) THANH TOÁN TOÀN BỘ TOUR
    // ================================================
    if ($type == "full") {

        // Số đã thanh toán (cọc + full)
        $da_tra_tong = $da_tra_coc + $da_tra_full;

        if ($da_tra_tong >= $gia_tour) {
            echo "<script>
                alert('Khách đã thanh toán đủ toàn bộ tour.');
                window.location='?action=qlbooking_detail&id=$id';
            </script>";
            exit;
        }

        $so_tien_can_dong = $gia_tour - $da_tra_tong;
        if ($so_tien > $so_tien_can_dong) $so_tien = $so_tien_can_dong;

        $tien_full_moi = $da_tra_full + $so_tien;

        // Lưu DB
        $this->model->update($id, [
            'tien_full_da_tra' => $tien_full_moi
        ]);

        // Lưu lịch sử
        $history = new PaymentHistory();
        $history->create($id, $so_tien);

        $con_lai = $gia_tour - ($da_tra_coc + $tien_full_moi);

        echo "<script>
            alert('Thanh toán FULL thành công! Khách còn phải đóng: " . number_format($con_lai) . " VNĐ');
            window.location='?action=qlbooking_detail&id=$id';
        </script>";
        exit;
    }
}



}