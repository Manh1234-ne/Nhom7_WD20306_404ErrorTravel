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
            'nhan_su_id' => $_POST['nhan_su_id'] ?? null // Ưu tiên lấy từ form
        ];

        // Upload ảnh đại diện tour
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

        // Upload ảnh cho lịch trình nếu có
        if (!empty($_POST['lich_trinh'])) {
            $items = json_decode($_POST['lich_trinh'], true) ?: [];
        } else {
            $items = [];
        }

        if (!empty($_FILES['it_images']) && !empty($_FILES['it_images']['name'])) {
            foreach ($_FILES['it_images']['name'] as $dayIdx => $slots) {
                if (!is_array($slots)) continue;
                foreach ($slots as $slotIdx => $filename) {
                    if (!isset($_FILES['it_images']['error'][$dayIdx][$slotIdx])) continue;
                    if ($_FILES['it_images']['error'][$dayIdx][$slotIdx] === UPLOAD_ERR_OK) {
                        $fileInfo = [
                            'name' => $_FILES['it_images']['name'][$dayIdx][$slotIdx],
                            'type' => $_FILES['it_images']['type'][$dayIdx][$slotIdx],
                            'tmp_name' => $_FILES['it_images']['tmp_name'][$dayIdx][$slotIdx],
                            'error' => $_FILES['it_images']['error'][$dayIdx][$slotIdx],
                            'size' => $_FILES['it_images']['size'][$dayIdx][$slotIdx],
                        ];
                        try {
                            $uploadedPath = upload_file('tour/itinerary', $fileInfo);
                            if ($uploadedPath) {
                                if (!isset($items[$dayIdx])) $items[$dayIdx] = ['title' => '', 'slots' => []];
                                if (!isset($items[$dayIdx]['slots'][$slotIdx])) $items[$dayIdx]['slots'][$slotIdx] = [];
                                $items[$dayIdx]['slots'][$slotIdx]['image'] = $uploadedPath;
                            }
                        } catch (Exception $e) {
                            error_log('Upload itinerary image error: ' . $e->getMessage());
                        }
                    }
                }
            }
        }

        if (!empty($items) && $this->model->hasColumn('lich_trinh')) {
            try {
                $this->model->update($tour_id, ['lich_trinh' => json_encode($items)]);
            } catch (Exception $e) {
                error_log('Update itinerary after upload error: ' . $e->getMessage());
            }
        }

        header('Location: ' . BASE_URL . '?action=tours');
        exit;
    }

    // Trang sửa tour
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        $tour = $this->model->find($id);
        $album = $this->model->getAlbum($id);
        require PATH_VIEW . 'tours/edit.php';
    }

    // Xử lý update tour
    public function update()
    {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : (isset($_GET['id']) ? (int)$_GET['id'] : null);
        if (!$id) {
            header('Location: ' . BASE_URL . '?action=tours');
            exit;
        }

        $existing = $this->model->find($id);
        if (!$existing) {
            header('Location: ' . BASE_URL . '?action=tours');
            exit;
        }

        $data = [];
        $fields = ['ten_tour', 'mo_ta', 'chinh_sach', 'nha_cung_cap', 'gia', 'thoi_gian', 'mua', 'nhan_su_id'];

        foreach ($fields as $f) {
            if (array_key_exists($f, $_POST) && $_POST[$f] !== '') {
                $data[$f] = trim($_POST[$f]);
            } elseif (isset($existing[$f])) {
                $data[$f] = $existing[$f];
            }
        }

        // Upload ảnh đại diện mới
        if (!empty($_FILES['hinh_anh']['name'])) {
            try {
                $uploaded = upload_file('tour', $_FILES['hinh_anh']);
                if ($uploaded) $data['hinh_anh'] = $uploaded;
            } catch (Exception $e) {
            }
        }

        if (!empty($data)) {
            try {
                $this->model->update($id, $data);
            } catch (Exception $e) {
                error_log('Update tour error: ' . $e->getMessage());
            }
        }

        // Xóa album
        if (!empty($_POST['delete_album']) && is_array($_POST['delete_album'])) {
            foreach ($_POST['delete_album'] as $albumId) {
                $albumId = (int)$albumId;
                if ($albumId > 0) $this->model->deleteAlbum($albumId);
            }
        }

        // Upload album mới
        if (!empty($_FILES['album']['name']) && is_array($_FILES['album']['name'])) {
            foreach ($_FILES['album']['name'] as $k => $name) {
                if ($_FILES['album']['error'][$k] === UPLOAD_ERR_OK) {
                    $fileInfo = [
                        'name' => $_FILES['album']['name'][$k],
                        'type' => $_FILES['album']['type'][$k],
                        'tmp_name' => $_FILES['album']['tmp_name'][$k],
                        'error' => $_FILES['album']['error'][$k],
                        'size' => $_FILES['album']['size'][$k],
                    ];
                    try {
                        $uploadedPath = upload_file('tour/album', $fileInfo);
                        if ($uploadedPath) $this->model->insertAlbum($id, $uploadedPath);
                    } catch (Exception $e) {
                        error_log('Upload album error: ' . $e->getMessage());
                    }
                }
            }
        }

        // Upload ảnh lịch trình
        if (!empty($_POST['lich_trinh'])) {
            $items = json_decode($_POST['lich_trinh'], true) ?: [];
        } else {
            $items = json_decode($existing['lich_trinh'] ?? '[]', true) ?: [];
        }

        if (!empty($_FILES['it_images']) && !empty($_FILES['it_images']['name'])) {
            foreach ($_FILES['it_images']['name'] as $dayIdx => $slots) {
                if (!is_array($slots)) continue;
                foreach ($slots as $slotIdx => $filename) {
                    if (!isset($_FILES['it_images']['error'][$dayIdx][$slotIdx])) continue;
                    if ($_FILES['it_images']['error'][$dayIdx][$slotIdx] === UPLOAD_ERR_OK) {
                        $fileInfo = [
                            'name' => $_FILES['it_images']['name'][$dayIdx][$slotIdx],
                            'type' => $_FILES['it_images']['type'][$dayIdx][$slotIdx],
                            'tmp_name' => $_FILES['it_images']['tmp_name'][$dayIdx][$slotIdx],
                            'error' => $_FILES['it_images']['error'][$dayIdx][$slotIdx],
                            'size' => $_FILES['it_images']['size'][$dayIdx][$slotIdx],
                        ];
                        try {
                            $uploadedPath = upload_file('tour/itinerary', $fileInfo);
                            if ($uploadedPath) {
                                if (!isset($items[$dayIdx])) $items[$dayIdx] = ['title' => '', 'slots' => []];
                                if (!isset($items[$dayIdx]['slots'][$slotIdx])) $items[$dayIdx]['slots'][$slotIdx] = [];
                                $items[$dayIdx]['slots'][$slotIdx]['image'] = $uploadedPath;
                            }
                        } catch (Exception $e) {
                            error_log('Upload itinerary image error: ' . $e->getMessage());
                        }
                    }
                }
            }
        }

        if ($this->model->hasColumn('lich_trinh')) {
            try {
                $this->model->update($id, ['lich_trinh' => json_encode($items)]);
            } catch (Exception $e) {
                error_log('Update itinerary after edit error: ' . $e->getMessage());
            }
        }

        header('Location: ' . BASE_URL . '?action=tours');
        exit;
    }

    // Xóa tour
    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . BASE_URL . '?action=tours');
            exit;
        }

        $this->model->deleteWithRelations($id);

        header('Location: ' . BASE_URL . '?action=tours');
        exit;
    }

    // Chi tiết tour
    public function detail()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) die("Không tìm thấy ID tour");

        $tour = $this->model->find($id);
        $album = $this->model->getAlbum($id);
        error_log('DEBUG album: ' . print_r($album, true));
        require PATH_VIEW . 'tours/detail.php';
    }

    // Cập nhật ảnh đại diện từ album (AJAX)
    public function setMainImage()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $id = isset($input['id']) ? (int)$input['id'] : ($_POST['id'] ?? null);
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
