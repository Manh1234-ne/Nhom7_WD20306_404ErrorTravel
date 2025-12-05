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
   public function pay()
{
    $id = $_GET['id'] ?? null;
    if (!$id) die("Không tìm thấy booking");

    $qlb = $this->model->find($id);
    require PATH_VIEW . 'qlbooking/pay.php';
}

public function paySubmit()
{
    $id = $_POST['id'];
    $so_tien = (int)$_POST['so_tien'];

    // Lấy booking
    $qlb = $this->model->find($id);

    if (!$qlb) die("Không tìm thấy booking");

    $gia_tour = $qlb['gia'];

    // ----------- TIỀN CỌC MẶC ĐỊNH 40% -------------
    $tien_coc_40 = $gia_tour * 0.4;

    // Nếu đã đóng >= 40% thì không cho đóng nữa
    $da_tra = $qlb['tien_coc_da_tra'] ?? 0;

    if ($da_tra >= $tien_coc_40) {
        echo "<script>
            alert('Khách đã đóng đủ tiền cọc 40%. Không thể đóng thêm!');
            window.location='?action=qlbooking_detail&id=$id';
        </script>";
        exit;
    }

    // Giới hạn số tiền nhập không vượt quá số cần đóng
    $so_tien_can_dong = $tien_coc_40 - $da_tra;

    if ($so_tien > $so_tien_can_dong) {
        $so_tien = $so_tien_can_dong; // tự động điều chỉnh
    }

    // Cộng tiền cọc
    $tien_da_tra_moi = $da_tra + $so_tien;

    // Lưu vào DB
    $this->model->update($id, [
        'tien_coc_da_tra' => $tien_da_tra_moi
    ]);

    // Tính còn lại
    $con_lai = $tien_coc_40 - $tien_da_tra_moi;

    $history = new PaymentHistory();
    $history->create($id, $so_tien);


    echo "<script>
        alert('Thanh toán thành công! Khách còn phải đóng: " . number_format($con_lai) . " VNĐ (đủ 40%)');
        window.location='?action=qlbooking_detail&id=$id';
    </script>";
    exit;
}


}