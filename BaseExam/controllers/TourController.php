<?php
require_once PATH_MODEL . 'Tour.php';
<<<<<<< HEAD
require_once PATH_MODEL . 'NhanSu.php';
=======
>>>>>>> lebang271206-ui

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
<<<<<<< HEAD
        // DEBUG: ghi log dữ liệu POST
        error_log('DEBUG store() - POST lich_trinh: ' . ($_POST['lich_trinh'] ?? 'NOT_SET'));
        error_log('DEBUG store() - hasColumn(lich_trinh): ' . ($this->model->hasColumn('lich_trinh') ? 'YES' : 'NO'));

=======
>>>>>>> lebang271206-ui
        $data = [
            'ten_tour' => $_POST['ten_tour'] ?? '',
            'loai_tour' => $_POST['loai_tour'] ?? '',
            'mo_ta' => $_POST['mo_ta'] ?? '',
            'gia' => $_POST['gia'] ?? 0,
            'chinh_sach' => $_POST['chinh_sach'] ?? '',
            'nha_cung_cap' => $_POST['nha_cung_cap'] ?? '',
<<<<<<< HEAD
            'mua' => $_POST['mua'] ?? '',
            'nhan_su_id' => $_POST['nhan_su_id'] ?? null, // Ưu tiên lấy từ form
            'hinh_anh' => null // Luôn gán giá trị mặc định (tránh lỗi NOT NULL)
        ];

        // Nếu DB có cột `lich_trinh`, gán trước (tránh lỗi nếu migration chưa chạy)
        if ($this->model->hasColumn('lich_trinh')) {
            $data['lich_trinh'] = $_POST['lich_trinh'] ?? '';
            error_log('DEBUG store() - data[lich_trinh] set to: ' . substr($data['lich_trinh'], 0, 100));
        } else {
            error_log('DEBUG store() - Skipping lich_trinh (column does not exist)');
        }

=======
            'mua' => $_POST['mua'] ?? ''
        ];

>>>>>>> lebang271206-ui
        // Upload ảnh đại diện tour
        if (!empty($_FILES['hinh_anh']['name'])) {
            $data['hinh_anh'] = upload_file('tour', $_FILES['hinh_anh']);
        }

<<<<<<< HEAD
=======
<<<<<<< HEAD
        // Fallback: nếu form không chọn HDV thì gán theo loại tour
        // if (empty($data['nhan_su_id'])) {
        //     $hdvList = $this->nhanSuModel->getHDVByLoaiTour($data['loai_tour']);
        //     $data['nhan_su_id'] = !empty($hdvList) ? $hdvList[0]['id'] : null;
        // }

=======
>>>>>>> lebang271206-ui
>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277
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

<<<<<<< HEAD
        // Upload ảnh cho lịch trình nếu có
=======
<<<<<<< HEAD
        // Xử lý upload ảnh cho từng mục lịch trình (nếu có)
        // Form gửi `lich_trinh` là mảng các ngày, mỗi ngày có `slots` (mảng các mốc).
        // File inputs được gán tên theo dạng it_images[DAY_INDEX][SLOT_INDEX]
>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277
        if (!empty($_POST['lich_trinh'])) {
            $items = json_decode($_POST['lich_trinh'], true) ?: [];
        } else {
            $items = [];
        }

        if (!empty($_FILES['it_images']) && !empty($_FILES['it_images']['name'])) {
            foreach ($_FILES['it_images']['name'] as $dayIdx => $slots) {
<<<<<<< HEAD
                if (!is_array($slots)) continue;
                foreach ($slots as $slotIdx => $filename) {
                    if (!isset($_FILES['it_images']['error'][$dayIdx][$slotIdx])) continue;
=======
                if (!is_array($slots))
                    continue;
                foreach ($slots as $slotIdx => $filename) {
                    if (!isset($_FILES['it_images']['error'][$dayIdx][$slotIdx]))
                        continue;
>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277
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
<<<<<<< HEAD
                                if (!isset($items[$dayIdx])) $items[$dayIdx] = ['title' => '', 'slots' => []];
                                if (!isset($items[$dayIdx]['slots'][$slotIdx])) $items[$dayIdx]['slots'][$slotIdx] = [];
=======
                                if (!isset($items[$dayIdx]))
                                    $items[$dayIdx] = ['title' => '', 'slots' => []];
                                if (!isset($items[$dayIdx]['slots'][$slotIdx]))
                                    $items[$dayIdx]['slots'][$slotIdx] = [];
>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277
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
<<<<<<< HEAD
=======
            // cập nhật lại trường lich_trinh để lưu đường dẫn ảnh vào JSON
>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277
            try {
                $this->model->update($tour_id, ['lich_trinh' => json_encode($items)]);
            } catch (Exception $e) {
                error_log('Update itinerary after upload error: ' . $e->getMessage());
            }
        }

        header('Location: ' . BASE_URL . '?action=tours');
=======
        header('Location: ?action=tours');
>>>>>>> lebang271206-ui
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
<<<<<<< HEAD
        $id = isset($_POST['id']) ? (int)$_POST['id'] : (isset($_GET['id']) ? (int)$_GET['id'] : null);
=======
<<<<<<< HEAD
        // lấy id an toàn
        $id = isset($_POST['id']) ? (int) $_POST['id'] : (isset($_GET['id']) ? (int) $_GET['id'] : null);
>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277
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
<<<<<<< HEAD
        $fields = ['ten_tour', 'mo_ta', 'chinh_sach', 'nha_cung_cap', 'gia', 'thoi_gian', 'mua', 'nhan_su_id'];
=======
        // Nếu form có những field rõ ràng, liệt kê ở đây; nếu không, bạn có thể lấy tất cả $_POST
        $fields = ['ten_tour', 'mo_ta', 'chinh_sach', 'nha_cung_cap', 'gia', 'thoi_gian', 'lich_trinh']; // sửa theo schema của bạn

        // Nếu DB không có cột lich_trinh, loại bỏ khỏi danh sách trường để tránh lỗi SQL
        if (!$this->model->hasColumn('lich_trinh')) {
            $fields = array_filter($fields, function ($f) {
                return $f !== 'lich_trinh';
            });
        }
>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277

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
<<<<<<< HEAD
                $albumId = (int)$albumId;
                if ($albumId > 0) $this->model->deleteAlbum($albumId);
=======
                $albumId = (int) $albumId;
                if ($albumId > 0) {
                    $this->model->deleteAlbum($albumId);
                }
>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277
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

<<<<<<< HEAD
        // Upload ảnh lịch trình
        if (!empty($_POST['lich_trinh'])) {
            $items = json_decode($_POST['lich_trinh'], true) ?: [];
        } else {
=======
        // Xử lý upload ảnh lịch trình (nếu có) tương tự như ở store: nếu form gửi lên lich_trinh và files it_images[]
        if (!empty($_POST['lich_trinh'])) {
            $items = json_decode($_POST['lich_trinh'], true) ?: [];
        } else {
            // fallback: giữ giá trị cũ
>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277
            $items = json_decode($existing['lich_trinh'] ?? '[]', true) ?: [];
        }

        if (!empty($_FILES['it_images']) && !empty($_FILES['it_images']['name'])) {
            foreach ($_FILES['it_images']['name'] as $dayIdx => $slots) {
<<<<<<< HEAD
                if (!is_array($slots)) continue;
                foreach ($slots as $slotIdx => $filename) {
                    if (!isset($_FILES['it_images']['error'][$dayIdx][$slotIdx])) continue;
=======
                if (!is_array($slots))
                    continue;
                foreach ($slots as $slotIdx => $filename) {
                    if (!isset($_FILES['it_images']['error'][$dayIdx][$slotIdx]))
                        continue;
>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277
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
<<<<<<< HEAD
                                if (!isset($items[$dayIdx])) $items[$dayIdx] = ['title' => '', 'slots' => []];
                                if (!isset($items[$dayIdx]['slots'][$slotIdx])) $items[$dayIdx]['slots'][$slotIdx] = [];
=======
                                if (!isset($items[$dayIdx]))
                                    $items[$dayIdx] = ['title' => '', 'slots' => []];
                                if (!isset($items[$dayIdx]['slots'][$slotIdx]))
                                    $items[$dayIdx]['slots'][$slotIdx] = [];
>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277
                                $items[$dayIdx]['slots'][$slotIdx]['image'] = $uploadedPath;
                            }
                        } catch (Exception $e) {
                            error_log('Upload itinerary image error: ' . $e->getMessage());
                        }
                    }
                }
            }
        }

<<<<<<< HEAD
=======
        // Lưu lại lich_trinh đã có cập nhật ảnh (nếu cột tồn tại)
>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277
        if ($this->model->hasColumn('lich_trinh')) {
            try {
                $this->model->update($id, ['lich_trinh' => json_encode($items)]);
            } catch (Exception $e) {
                error_log('Update itinerary after edit error: ' . $e->getMessage());
            }
        }

<<<<<<< HEAD
=======
        // redirect về index tour
>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277
        header('Location: ' . BASE_URL . '?action=tours');
=======
        $id = $_POST['id'];
        $data = [
            'ten_tour' => $_POST['ten_tour'] ?? '',
            'loai_tour' => $_POST['loai_tour'] ?? '',
            'mo_ta' => $_POST['mo_ta'] ?? '',
            'gia' => $_POST['gia'] ?? 0,
            'chinh_sach' => $_POST['chinh_sach'] ?? '',
            'nha_cung_cap' => $_POST['nha_cung_cap'] ?? '',
            'mua' => $_POST['mua'] ?? ''
        ];

        // Upload ảnh đại diện mới nếu có
        if (!empty($_FILES['hinh_anh']['name'])) {
            $data['hinh_anh'] = upload_file('tour', $_FILES['hinh_anh']);
        }

        $this->model->update($id, $data);

        // Xóa album đã chọn
        if (!empty($_POST['delete_album'])) {
            foreach ($_POST['delete_album'] as $album_id) {
                $this->model->deleteAlbum($album_id);
            }
        }

        // Thêm album mới
        if (!empty($_FILES['album']['name'][0])) {
            foreach ($_FILES['album']['tmp_name'] as $key => $tmp_name) {
                $file_name = upload_file('tour/album', [
                    'name' => $_FILES['album']['name'][$key],
                    'tmp_name' => $_FILES['album']['tmp_name'][$key]
                ]);
                $this->model->insertAlbum($id, $file_name);
            }
        }

        header('Location: ?action=tours');
>>>>>>> lebang271206-ui
        exit;
    }

    // Xóa tour
    public function delete()
    {
<<<<<<< HEAD
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . BASE_URL . '?action=tours');
            exit;
        }

        $this->model->deleteWithRelations($id);

        header('Location: ' . BASE_URL . '?action=tours');
=======
        $id = $_GET['id'];
        $this->model->delete($id);
        header('Location: ?action=tours');
>>>>>>> lebang271206-ui
        exit;
    }

    // Chi tiết tour
    public function detail()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) die("Không tìm thấy ID tour");

        $tour = $this->model->find($id);
        $album = $this->model->getAlbum($id);
<<<<<<< HEAD
        error_log('DEBUG album: ' . print_r($album, true));
=======
<<<<<<< HEAD
        error_log('DEBUG album: ' . print_r($album, true)); // xem trong Apache/Laragon log
>>>>>>> 75f56cf82ca89db6fc4daec0ea1c3efaf034d277
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
=======

        require PATH_VIEW . 'tours/detail.php';
    }

}
>>>>>>> lebang271206-ui
