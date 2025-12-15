<?php

require_once __DIR__ . '/../models/YeuCauModel.php';

class YeuCauController
{
    private $modelYeuCau;

    public function __construct()
    {
        $this->modelYeuCau = new YeuCauModel();
    }

    // Danh sách yêu cầu
    public function index()
    {
        $filters = [
            'search' => $_GET['search'] ?? '',
            'loai' => $_GET['loai'] ?? '',
            'trang_thai' => $_GET['trang_thai'] ?? ''
        ];
        
        $danhSach = $this->modelYeuCau->getAll($filters);
        include __DIR__ . '/../views/yeucau/index.php';
    }

    // Form tạo mới
    public function create()
    {
        include __DIR__ . '/../views/yeucau/create.php';
    }

    // Xử lý lưu yêu cầu mới
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('Phương thức không hợp lệ.');
        }

        $data = [
            'ten_khach'    => trim($_POST['ten_khach'] ?? ''),
            'loai_yeu_cau' => $_POST['loai_yeu_cau'] ?? '',
            'mo_ta'        => trim($_POST['mo_ta'] ?? '')
        ];

        if (empty($data['ten_khach']) || empty($data['loai_yeu_cau'])) {
            die('Vui lòng điền đầy đủ thông tin hợp lệ.');
        }

        try {
            $newId = $this->modelYeuCau->create($data);
            header("Location: index.php?action=yeu_cau");
            exit;
        } catch (PDOException $e) {
            echo "<h3>LỖI SQL:</h3>";
            echo htmlspecialchars($e->getMessage());
        }
    }

    // Form chỉnh sửa
    public function edit($id)
    {
        $yeuCau = $this->modelYeuCau->find($id);
        if (!$yeuCau) {
            die('Yêu cầu không tồn tại.');
        }
        
        $logs = $this->modelYeuCau->getNhatKy($id);
        include __DIR__ . '/../views/yeucau/edit.php';
    }

    // Xử lý cập nhật
    public function update($id)
    {
        // Lấy ID từ POST nếu không có từ URL
        if (empty($id)) {
            $id = $_POST['id'] ?? null;
        }
        
        $old = $this->modelYeuCau->find($id);
        if (!$old) {
            die('Yêu cầu không tồn tại.');
        }

        $data = [
            'ten_khach'    => trim($_POST['ten_khach'] ?? $old['ten_khach']),
            'loai_yeu_cau' => $_POST['loai_yeu_cau'] ?? $old['loai_yeu_cau'],
            'mo_ta'        => trim($_POST['mo_ta'] ?? $old['mo_ta']),
            'trang_thai'   => $_POST['trang_thai'] ?? $old['trang_thai']
        ];

        // Kiểm tra xem có thay đổi trạng thái không
        $trangThaiCu = $old['trang_thai'];
        $trangThaiMoi = $data['trang_thai'];
        
        // Cập nhật dữ liệu
        $this->modelYeuCau->update($id, $data);

        // Nếu có thay đổi trạng thái, tự động tạo nhật ký
        if ($trangThaiCu !== $trangThaiMoi) {
            $trangThaiText = [
                'cho_xu_ly' => 'Chờ xử lý',
                'dang_xu_ly' => 'Đang xử lý', 
                'da_dap_ung' => 'Đã đáp ứng',
                'khong_the_dap_ung' => 'Không thể đáp ứng'
            ];
            
            $logData = [
                'id_yeu_cau' => $id,
                'nguoi_xu_ly' => $_SESSION['user']['ho_ten'] ?? 'Hệ thống',
                'ghi_chu' => 'Cập nhật trạng thái từ "' . ($trangThaiText[$trangThaiCu] ?? $trangThaiCu) . '" thành "' . ($trangThaiText[$trangThaiMoi] ?? $trangThaiMoi) . '"',
                'trang_thai_cu' => $trangThaiCu,
                'trang_thai_moi' => $trangThaiMoi
            ];
            
            try {
                $this->modelYeuCau->luuNhatKy($logData);
            } catch (Exception $e) {
                // Không dừng quá trình nếu lưu nhật ký thất bại
                error_log('Lỗi lưu nhật ký: ' . $e->getMessage());
            }
        }

        header("Location: index.php?action=yeu_cau");
        exit;
    }

    // Xóa yêu cầu
    public function delete($id)
    {
        $yeuCau = $this->modelYeuCau->find($id);
        if (!$yeuCau) die('Yêu cầu không tồn tại.');

        try {
            $this->modelYeuCau->delete($id);
            header("Location: index.php?action=yeu_cau");
            exit;
        } catch (PDOException $e) {
            echo "<pre>Lỗi SQL DELETE:\n";
            echo htmlspecialchars($e->getMessage());
            echo "</pre>";
            exit;
        }
    }

    // Xem chi tiết yêu cầu
    public function show($id)
    {
        $yeuCau = $this->modelYeuCau->find($id);
        if (!$yeuCau) {
            die('Yêu cầu không tồn tại.');
        }

        $logs = $this->modelYeuCau->getNhatKy($id);
        include __DIR__ . '/../views/yeucau/show.php';
    }

    // Lưu nhật ký xử lý
    public function luuNhatKy()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('Phương thức không hợp lệ.');
        }

        $data = [
            'id_yeu_cau' => $_POST['id_yeu_cau'] ?? '',
            'nguoi_xu_ly' => $_SESSION['user']['ho_ten'] ?? 'Admin',
            'ghi_chu' => trim($_POST['ghi_chu'] ?? ''),
            'trang_thai_cu' => $_POST['trang_thai_cu'] ?? '',
            'trang_thai_moi' => $_POST['trang_thai_moi'] ?? ''
        ];

        if (empty($data['id_yeu_cau']) || empty($data['ghi_chu'])) {
            die('Vui lòng điền đầy đủ thông tin.');
        }

        try {
            // Lưu nhật ký
            $this->modelYeuCau->luuNhatKy($data);
            
            // Cập nhật trạng thái nếu có
            if (!empty($data['trang_thai_moi'])) {
                $this->modelYeuCau->update($data['id_yeu_cau'], [
                    'trang_thai' => $data['trang_thai_moi']
                ]);
            }

            $_SESSION['flash_success'] = 'Đã lưu nhật ký xử lý thành công.';
            header("Location: index.php?action=yeu_cau_edit&id=" . $data['id_yeu_cau']);
            exit;
        } catch (PDOException $e) {
            echo "<h3>LỖI SQL:</h3>";
            echo htmlspecialchars($e->getMessage());
        }
    }
}
