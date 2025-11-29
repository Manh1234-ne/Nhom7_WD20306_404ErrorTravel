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

    /** Danh sách tour */
    public function index()
    {
        $tours = $this->model->all();
        require PATH_VIEW . 'tours/index.php';
    }

    /** Form thêm tour */
    public function add()
    {
        // Nếu có loai_tour trên URL thì lọc theo loại, nếu không thì load toàn bộ HDV
        $loai_tour = $_GET['loai_tour'] ?? null;
        $hdvList = $loai_tour
            ? $this->nhanSuModel->getHDVByLoaiTour($loai_tour)
            : $this->nhanSuModel->getAllWithNguoiDung();

        require PATH_VIEW . 'tours/add.php';
    }

    /** Lưu tour mới */
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
            'hinh_anh' => null,
            'danh_muc' => $_POST['danh_muc'] ?? null,
            'nhan_su_id' => $_POST['nhan_su_id'] ?? null // Ưu tiên lấy từ form
        ];

        if (!empty($_FILES['hinh_anh']['name'])) {
            $data['hinh_anh'] = upload_file('tour', $_FILES['hinh_anh']);
        }

        // Fallback: nếu form không chọn HDV thì gán theo loại tour
        if (empty($data['nhan_su_id'])) {
            $hdvList = $this->nhanSuModel->getHDVByLoaiTour($data['loai_tour']);
            $data['nhan_su_id'] = !empty($hdvList) ? $hdvList[0]['id'] : null;
        }

        // Tạo tour
        $tour_id = $this->model->create($data);

        // Album ảnh
        if ($tour_id && !empty($_FILES['album']['name'][0])) {
            foreach ($_FILES['album']['name'] as $key => $name) {
                if (empty($_FILES['album']['tmp_name'][$key]))
                    continue;
                $file_arr = [
                    'name' => $_FILES['album']['name'][$key],
                    'tmp_name' => $_FILES['album']['tmp_name'][$key]
                ];
                $file_name = upload_file('tour/album', $file_arr);
                $this->model->insertAlbum($tour_id, $file_name);
            }
        }

        header('Location: ?action=tours');
        exit;
    }

    /** Form sửa tour */
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id)
            die("ID tour không tồn tại");

        $tour = $this->model->find($id);
        $album = $this->model->getAlbum($id);
        // Lọc HDV theo loại tour hiện tại để hiển thị dropdown đúng ngữ cảnh
        $hdvList = $this->nhanSuModel->getHDVByLoaiTour($tour['loai_tour']);

        require PATH_VIEW . 'tours/edit.php';
    }

    /** Cập nhật tour */
    public function update()
    {
        $id = $_POST['id'] ?? null;
        if (!$id)
            die("ID tour không tồn tại");

        $data = [
            'ten_tour' => $_POST['ten_tour'] ?? '',
            'loai_tour' => $_POST['loai_tour'] ?? '',
            'mo_ta' => $_POST['mo_ta'] ?? '',
            'gia' => $_POST['gia'] ?? 0,
            'chinh_sach' => $_POST['chinh_sach'] ?? '',
            'nha_cung_cap' => $_POST['nha_cung_cap'] ?? '',
            'mua' => $_POST['mua'] ?? '',
            'danh_muc' => $_POST['danh_muc'] ?? null,
            'nhan_su_id' => $_POST['nhan_su_id'] ?? null // Lấy từ dropdown edit.php
        ];

        if (!empty($_FILES['hinh_anh']['name'])) {
            $data['hinh_anh'] = upload_file('tour', $_FILES['hinh_anh']);
        }

        // Fallback: nếu dropdown không chọn HDV thì gán theo loại tour mới
        if (empty($data['nhan_su_id'])) {
            $hdvList = $this->nhanSuModel->getHDVByLoaiTour($data['loai_tour']);
            $data['nhan_su_id'] = !empty($hdvList) ? $hdvList[0]['id'] : null;
        }

        // Cập nhật tour
        $this->model->update($id, $data);

        // Xóa ảnh album được chọn
        if (!empty($_POST['delete_album'])) {
            foreach ($_POST['delete_album'] as $album_id) {
                $this->model->deleteAlbum($album_id);
            }
        }

        // Thêm ảnh album mới
        if (!empty($_FILES['album']['name'][0])) {
            foreach ($_FILES['album']['name'] as $key => $name) {
                if (empty($_FILES['album']['tmp_name'][$key]))
                    continue;
                $file_arr = [
                    'name' => $_FILES['album']['name'][$key],
                    'tmp_name' => $_FILES['album']['tmp_name'][$key]
                ];
                $file_name = upload_file('tour/album', $file_arr);
                $this->model->insertAlbum($id, $file_name);
            }
        }

        header('Location: ?action=tours');
        exit;
    }

    /** Xóa tour */
    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id)
            $this->model->delete($id);
        header('Location: ?action=tours');
        exit;
    }

    /** Chi tiết tour */
    public function detail()
    {
        $id = $_GET['id'] ?? null;
        if (!$id)
            die("Không tìm thấy ID tour");

        $tour = $this->model->find($id);
        $album = $this->model->getAlbum($id);

        // Lấy HDV theo nhan_su_id nếu có
        $hdv = $this->model->getHDVByTour($id);

        // Nếu không có HDV được gán, fallback theo loại tour
        if (!$hdv) {
            // Chuẩn hóa key: input form dùng tiếng Việt ("Trong nước", "Quốc tế", "Theo yêu cầu")
            // nên cần normalize để khớp với loai_hdv trong DB: trong_nuoc, quoc_te, yeu_cau
            $loai_key = strtolower(str_replace(' ', '_', $tour['loai_tour'] ?? ''));
            $hdv = $this->model->getDefaultHDVFromDB($loai_key);

            if (!$hdv) {
                $map = [
                    'trong_nuoc' => [
                        'id' => -1,
                        'ho_ten' => 'Nguyễn Văn A',
                        'so_dien_thoai' => '0909 111 222',
                        'email' => 'hdv-trongnuoc@travel.test',
                        'ngon_ngu' => 'Tiếng Việt, Tiếng Anh',
                        'kinh_nghiem' => '3 năm',
                        'danh_gia' => '4.5'
                    ],
                    'quoc_te' => [
                        'id' => -2,
                        'ho_ten' => 'Trần Thị B',
                        'so_dien_thoai' => '0909 222 333',
                        'email' => 'hdv-quocte@travel.test',
                        'ngon_ngu' => 'Tiếng Anh, Tiếng Nhật',
                        'kinh_nghiem' => '6 năm',
                        'danh_gia' => '4.9'
                    ],
                    'yeu_cau' => [
                        'id' => -3,
                        'ho_ten' => 'Phạm Minh C',
                        'so_dien_thoai' => '0909 333 444',
                        'email' => 'hdv-yeucau@travel.test',
                        'ngon_ngu' => 'Tiếng Việt, Tiếng Trung',
                        'kinh_nghiem' => '4 năm',
                        'danh_gia' => '4.7'
                    ]
                ];

                $hdv = $map[$loai_key] ?? [
                    'id' => -99,
                    'ho_ten' => 'Hướng dẫn viên mặc định',
                    'so_dien_thoai' => '0999 888 777',
                    'email' => 'default@travel.test',
                    'ngon_ngu' => 'Tiếng Việt',
                    'kinh_nghiem' => '2 năm',
                    'danh_gia' => '4.0'
                ];
            }
        }

        require PATH_VIEW . 'tours/detail.php';
    }
}
