<?php
require_once PATH_MODEL . 'QlBookingModel.php';

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
    
    // Trang thêm ql booking
    public function add()
    {
        require PATH_VIEW . 'qlbooking/add.php';
    }

    // Xử lý thêm qlbooking
    public function store()
    {
        $data = [
            'dat_tour_id' => $_POST['dat_tour_id'] ?? '',
            'ho_ten' => $_POST['ho_ten'] ?? '',
            'gioi_tinh' => $_POST['gioi_tinh'] ?? '',
            'nam_sinh' => $_POST['nam_sinh'] ?? '',
            'so_giay_to' => $_POST['so_giay_to'] ?? '',
            'loai_phong' => $_POST['loai_phong'] ?? '',
            'tinh_trang_thanh_toan' => $_POST['tinh_trang_thanh_toan'] ?? '',
            'yeu_cau_dac_biet' => $_POST['yeu_cau_dac_biet'] ?? '',
        ];
         $qlbooking_id = $this->model->insert($data);
          header('Location: ?action=qlbooking');
        exit;
    }
     // Xóa booking
    public function delete()
    {
        $id = $_GET['id'];
        $this->model->delete($id);
        header('Location: ?action=qlbooking');
        exit;
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
            'dat_tour_id' => $_POST['dat_tour_id'] ?? '',
            'ho_ten' => $_POST['ho_ten'] ?? '',
            'gioi_tinh' => $_POST['gioi_tinh'] ?? '',
            'nam_sinh' => $_POST['nam_sinh'] ?? '',
            'so_giay_to' => $_POST['so_giay_to'] ?? '',
            'loai_phong' => $_POST['loai_phong'] ?? '',
            'tinh_trang_thanh_toan' => $_POST['tinh_trang_thanh_toan'] ?? '',
            'yeu_cau_dac_biet' => $_POST['yeu_cau_dac_biet'] ?? '',
        ];
    $this->model->update($id, $data);
    
        header('Location: ?action=qlbooking');
        exit;
    }
}