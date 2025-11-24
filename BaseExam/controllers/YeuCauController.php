<?php

require_once __DIR__ . '/../models/YeuCauModel.php';

class YeuCauController
{
    private $modelYeuCau;

    public function __construct()
    {
        $this->modelYeuCau = new YeuCauModel();
    }

    public function index()
    {
        $danhSach = $this->modelYeuCau->getAll();  // ID tăng dần
        include __DIR__ . '/../views/yeucau/index.php';
    }

    public function create()
    {
        include __DIR__ . '/../views/yeucau/create.php';
    }

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

            // Chuyển về trang danh sách sau khi tạo
            header("Location: index.php?action=yeu_cau");
            exit;

        } catch (PDOException $e) {
            echo "<h3>LỖI SQL:</h3>";
            echo htmlspecialchars($e->getMessage());
        }
    }

    public function edit($id)
    {
        $yeuCau = $this->modelYeuCau->find($id);
        include __DIR__ . '/../views/yeucau/edit.php';
    }

    public function update($id)
    {
        $old = $this->modelYeuCau->find($id);
        if (!$old) die('Yêu cầu không tồn tại.');

        $data = [
            'ten_khach'    => trim($_POST['ten_khach'] ?? $old['ten_khach']),
            'loai_yeu_cau' => $_POST['loai_yeu_cau'] ?? $old['loai_yeu_cau'],
            'mo_ta'        => trim($_POST['mo_ta'] ?? $old['mo_ta']),
            'trang_thai'   => $_POST['trang_thai'] ?? $old['trang_thai']
        ];

        $this->modelYeuCau->update($id, $data);

        header("Location: index.php?action=yeu_cau");
        exit;
    }

    public function delete($id)
    {
        $yeuCau = $this->modelYeuCau->find($id);
        if (!$yeuCau) die('Yêu cầu không tồn tại.');

        $this->modelYeuCau->delete($id);

        header("Location: index.php?action=yeu_cau");
        exit;
    }

    public function show($id)
    {
        $yeuCau = $this->modelYeuCau->find($id);
        include __DIR__ . '/../views/yeucau/show.php';
    }
}