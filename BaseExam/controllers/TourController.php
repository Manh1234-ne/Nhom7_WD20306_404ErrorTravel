<?php
require_once PATH_MODEL . 'Tour.php';
require_once PATH_MODEL . 'NhanSu.php';

class TourController
{
    protected $model;
    protected $nhanSuModel;

    public function __construct()
    {
        $this->model = new Tour();
        $this->nhanSuModel = new NhanSu();
    }

    // Trang danh sách tour
    public function index()
    {
        $tours = $this->model->all();
        require PATH_VIEW . 'tours/index.php';
    }

    // Trang thêm tour
    public function add()
    {
        require PATH_VIEW . 'tours/add.php';
    }

    // Xử lý thêm tour
    public function store()
    {
        $data = [
            'ten_tour' => $_POST['ten_tour'] ?? '',
            'loai_tour' => $_POST['loai_tour'] ?? '',
            'mo_ta' => $_POST['mo_ta'] ?? '',
            'gia' => $_POST['gia'] ?? 0,
            'chinh_sach' => $_POST['chinh_sach'] ?? '',
            'nha_cung_cap' => $_POST['nha_cung_cap'] ?? '',
            'mua' => $_POST['mua'] ?? '',
            'nhan_su_id' => $_POST['nhan_su_id'] ?? null,
            'hinh_anh' => null,
        ];

        // Nếu DB có cột lich_trinh thì lấy giá trị
        if ($this->model->hasColumn('lich_trinh')) {
            $data['lich_trinh'] = $_POST['lich_trinh'] ?? '';
        }

        // Upload ảnh đại diện
        if (!empty($_FILES['hinh_anh']['name'])) {
            $data['hinh_anh'] = upload_file('tour', $_FILES['hinh_anh']);
        }

        $tour_id = $this->model->insert($data);

        // Upload album nếu có
        if (!empty($_FILES['album']['name'][0])) {
            foreach ($_FILES['album']['tmp_name'] as $key => $tmp_name) {
                $file_name = upload_file('tour/album', [
                    'name' => $_FILES['album']['name'][$key],
                    'tmp_name' => $_FILES['album']['tmp_name'][$key]
                ]);
                $this->model->insertAlbum($tour_id, $file_name);
            }
        }

        // Upload ảnh lịch trình nếu có
        $items = [];
        if (!empty($_POST['lich_trinh'])) {
            $items = json_decode($_POST['lich_trinh'], true) ?: [];
        }

        if (!empty($_FILES['it_images']['name'])) {
            foreach ($_FILES['it_images']['name'] as $dayIdx => $slots) {
                if (!is_array($slots)) continue;
                foreach ($slots as $slotIdx => $filename) {
                    if (isset($_FILES['it_images']['error'][$dayIdx][$slotIdx])
                        && $_FILES['it_images']['error'][$dayIdx][$slotIdx] === UPLOAD_ERR_OK) {
                        $fileInfo = [
                            'name' => $_FILES['it_images']['name'][$dayIdx][$slotIdx],
                            'type' => $_FILES['it_images']['type'][$dayIdx][$slotIdx],
                            'tmp_name' => $_FILES['it_images']['tmp_name'][$dayIdx][$slotIdx],
                            'error' => $_FILES['it_images']['error'][$dayIdx][$slotIdx],
                            'size' => $_FILES['it_images']['size'][$dayIdx][$slotIdx],
                        ];
                        $uploadedPath = upload_file('tour/itinerary', $fileInfo);
                        if ($uploadedPath) {
                            if (!isset($items[$dayIdx])) $items[$dayIdx] = ['title' => '', 'slots' => []];
                            if (!isset($items[$dayIdx]['slots'][$slotIdx])) $items[$dayIdx]['slots'][$slotIdx] = [];
                            $items[$dayIdx]['slots'][$slotIdx]['image'] = $uploadedPath;
                        }
                    }
                }
            }
        }

        if (!empty($items) && $this->model->hasColumn('lich_trinh')) {
            $this->model->update($tour_id, ['lich_trinh' => json_encode($items)]);
        }

        header('Location: ?action=tours');
        exit;
    }

    // Trang sửa tour
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ?action=tours');
            exit;
        }

        $tour = $this->model->find($id);
        $album = $this->model->getAlbum($id);

        require PATH_VIEW . 'tours/edit.php';
    }

    // Xử lý update tour
    public function update()
    {
        $id = $_POST['id'] ?? $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ?action=tours');
            exit;
        }
        $id = (int)$id;

        $existing = $this->model->find($id);
        if (!$existing) {
            header('Location: ?action=tours');
            exit;
        }

        $fields = ['ten_tour', 'mo_ta', 'chinh_sach', 'nha_cung_cap', 'gia', 'thoi_gian', 'mua', 'nhan_su_id', 'lich_trinh'];

        // Loại bỏ lich_trinh nếu không có cột này trong DB
        if (!$this->model->hasColumn('lich_trinh')) {
            $fields = array_filter($fields, fn($f) => $f !== 'lich_trinh');
        }

        $data = [];
        foreach ($fields as $f) {
            if (isset($_POST[$f])) {
                $data[$f] = trim($_POST[$f]);
            } elseif (isset($existing[$f])) {
                $data[$f] = $existing[$f];
            }
        }

        // Upload ảnh đại diện mới
        if (!empty($_FILES['hinh_anh']['name'])) {
            $uploaded = upload_file('tour', $_FILES['hinh_anh']);
            if ($uploaded) $data['hinh_anh'] = $uploaded;
        }

        $this->model->update($id, $data);

        // Xóa album đã chọn
        if (!empty($_POST['delete_album']) && is_array($_POST['delete_album'])) {
            foreach ($_POST['delete_album'] as $albumId) {
                $albumId = (int)$albumId;
                if ($albumId > 0) {
                    $this->model->deleteAlbum($albumId);
                }
            }
        }

        // Upload album mới
        if (!empty($_FILES['album']['name'][0])) {
            foreach ($_FILES['album']['tmp_name'] as $key => $tmp_name) {
                $file_name = upload_file('tour/album', [
                    'name' => $_FILES['album']['name'][$key],
                    'tmp_name' => $_FILES['album']['tmp_name'][$key]
                ]);
                $this->model->insertAlbum($id, $file_name);
            }
        }

        // Upload ảnh lịch trình
        $items = [];
        if (!empty($_POST['lich_trinh'])) {
            $items = json_decode($_POST['lich_trinh'], true) ?: [];
        } else {
            $items = json_decode($existing['lich_trinh'] ?? '[]', true) ?: [];
        }

        if (!empty($_FILES['it_images']['name'])) {
            foreach ($_FILES['it_images']['name'] as $dayIdx => $slots) {
                if (!is_array($slots)) continue;
                foreach ($slots as $slotIdx => $filename) {
                    if (isset($_FILES['it_images']['error'][$dayIdx][$slotIdx])
                        && $_FILES['it_images']['error'][$dayIdx][$slotIdx] === UPLOAD_ERR_OK) {
                        $fileInfo = [
                            'name' => $_FILES['it_images']['name'][$dayIdx][$slotIdx],
                            'type' => $_FILES['it_images']['type'][$dayIdx][$slotIdx],
                            'tmp_name' => $_FILES['it_images']['tmp_name'][$dayIdx][$slotIdx],
                            'error' => $_FILES['it_images']['error'][$dayIdx][$slotIdx],
                            'size' => $_FILES['it_images']['size'][$dayIdx][$slotIdx],
                        ];
                        $uploadedPath = upload_file('tour/itinerary', $fileInfo);
                        if ($uploadedPath) {
                            if (!isset($items[$dayIdx])) $items[$dayIdx] = ['title' => '', 'slots' => []];
                            if (!isset($items[$dayIdx]['slots'][$slotIdx])) $items[$dayIdx]['slots'][$slotIdx] = [];
                            $items[$dayIdx]['slots'][$slotIdx]['image'] = $uploadedPath;
                        }
                    }
                }
            }
        }

        if ($this->model->hasColumn('lich_trinh')) {
            $this->model->update($id, ['lich_trinh' => json_encode($items)]);
        }

        header('Location: ?action=tours');
        exit;
    }

    // Xóa tour
    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ?action=tours');
            exit;
        }

        $this->model->deleteWithRelations((int)$id);

        header('Location: ?action=tours');
        exit;
    }

    // Chi tiết tour
    public function detail()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) die("Không tìm thấy ID tour");

        $tour = $this->model->find($id);
        $album = $this->model->getAlbum($id);

        require PATH_VIEW . 'tours/detail.php';
    }

    // Cập nhật ảnh đại diện từ album (AJAX)
    public function setMainImage()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $id = isset($input['id']) ? (int) $input['id'] : ($_POST['id'] ?? null);
        $filename = isset($input['filename']) ? trim($input['filename']) : ($_POST['filename'] ?? null);

        header('Content-Type: application/json');

        if (!$id || !$filename) {
            echo json_encode(['success' => false, 'message' => 'Thiếu dữ liệu']);
            return;
        }

        try {
            $updated = $this->model->update($id, ['hinh_anh' => $filename]);
            if ($updated) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Cập nhật thất bại']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
