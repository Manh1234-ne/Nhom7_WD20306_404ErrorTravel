<?php

require_once __DIR__ . '/../models/YeuCauModel.php';
require_once __DIR__ . '/../models/NhatKyYeuCau.php';

class YeuCauController
{
    private $modelYeuCau;
    private $modelNhatKy;

    public function __construct()
    {
        $this->modelYeuCau = new YeuCauModel();
        $this->modelNhatKy = new NhatKyYeuCau();
    }

    // ====================== DANH SÁCH ======================
    // public function index()
    // {
    //     $list = $this->modelYeuCau->getAll();
    //     require_once __DIR__ . '/../views/yeucau/index.php';
    // }

    public function index() {
    $model = new YeuCauModel();
    $danhSach = $model->getAll();   // <—— phải có dòng này
    include __DIR__ . '/../views/yeucau/index.php';

}


    // ====================== XEM CHI TIẾT ======================
    public function show($id)
    {
        $yeuCau = $this->modelYeuCau->find($id);
        $nhatKy = $this->modelNhatKy->getAllByYeuCau($id);
        require_once __DIR__ . '/../views/yeucau/show.php';
    }

    // ====================== FORM TẠO ======================
    public function create()
    {
        require_once __DIR__ . '/../views/yeucau/create.php';
    }

    // ====================== LƯU YÊU CẦU MỚI (CHUẨN) ======================
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('Phương thức không hợp lệ.');
        }

        $data = [
            'id_booking'   => (int)($_POST['id_booking'] ?? 0),
            'ten_khach'    => trim($_POST['ten_khach'] ?? ''),
            'loai_yeu_cau' => $_POST['loai_yeu_cau'] ?? '',
            'mo_ta'        => trim($_POST['mo_ta'] ?? '')
        ];

        if ($data['id_booking'] <= 0 || empty($data['ten_khach']) || empty($data['loai_yeu_cau'])) {
            die('Vui lòng điền đầy đủ thông tin hợp lệ.');
        }

        try {
            // Gọi model để tạo yêu cầu
            $newId = $this->modelYeuCau->create($data);

            echo "<h3>Thêm yêu cầu thành công!</h3>";
            echo "ID mới: {$newId}<br>";

            // Ghi nhật ký tạo mới
            $this->modelNhatKy->add([
                'id_yeu_cau'     => $newId,
                'nguoi_xu_ly'    => "Hệ thống",
                'ghi_chu'        => "Khởi tạo yêu cầu",
                'trang_thai_cu'  => null,
                'trang_thai_moi' => "cho_xu_ly"
            ]);

        } catch (PDOException $e) {
            echo "<h3>LỖI SQL:</h3>";
            echo $e->getMessage();
        }
    }

    // ====================== CẬP NHẬT ======================
    public function update($id)
    {
        $old = $this->modelYeuCau->find($id);
        if (!$old) die('Yêu cầu không tồn tại.');

        $data = [
            'ten_khach'  => trim($_POST['ten_khach'] ?? $old['ten_khach']),
            'loai_yeu_cau' => $_POST['loai_yeu_cau'] ?? $old['loai_yeu_cau'],
            'mo_ta'        => trim($_POST['mo_ta'] ?? $old['mo_ta']),
            'trang_thai'   => $_POST['trang_thai'] ?? $old['trang_thai']
        ];

        $nguoi_xu_ly = $_POST['nguoi_xu_ly'] ?? 'Nhân viên';
        $ghi_chu      = $_POST['ghi_chu'] ?? '';

        try {
            $this->modelYeuCau->update($id, $data);

            $this->modelNhatKy->add([
                'id_yeu_cau'     => $id,
                'nguoi_xu_ly'    => $nguoi_xu_ly,
                'ghi_chu'        => $ghi_chu,
                'trang_thai_cu'  => $old['trang_thai'],
                'trang_thai_moi' => $data['trang_thai']
            ]);

        } catch (PDOException $e) {
            echo "<pre>Lỗi SQL UPDATE:\n";
            echo $e->getMessage();
            echo "</pre>";
            exit;
        }

        echo "<p>Cập nhật thành công ID: $id</p>";
    }

    // ====================== XÓA ======================
    public function delete($id)
    {
        $yeuCau = $this->modelYeuCau->find($id);
        if (!$yeuCau) die('Yêu cầu không tồn tại.');

        try {
            $this->modelYeuCau->delete($id);
        } catch (PDOException $e) {
            echo "<pre>Lỗi SQL DELETE:\n";
            echo $e->getMessage();
            echo "</pre>";
            exit;
        }

        echo "<p>Xóa thành công ID: $id</p>";
    }
}
