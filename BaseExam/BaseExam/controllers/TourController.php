<?php
require_once PATH_MODEL.'Tour.php';

class TourController {
    protected $model;

    public function __construct() {
        $this->model = new Tour();
    }

    public function index() {
        $tours = $this->model->all();
        require PATH_VIEW.'tours/index.php';
    }

    public function add() {
        require PATH_VIEW.'tours/add.php';
    }

    public function store() {
        $data = [
            'ten_tour' => $_POST['ten_tour'],
            'loai_tour' => $_POST['loai_tour'],
            'mo_ta' => $_POST['mo_ta'],
            'gia' => $_POST['gia'],
            'chinh_sach' => $_POST['chinh_sach']
        ];

        if(!empty($_FILES['hinh_anh']['name'])) {
            $data['hinh_anh'] = upload_file('tour', $_FILES['hinh_anh']);
        }

        $tour_id = $this->model->insert($data);

        if(!empty($_FILES['album']['name'][0])) {
            foreach($_FILES['album']['tmp_name'] as $key => $tmp_name) {
                $file_name = upload_file('tour/album', [
                    'name' => $_FILES['album']['name'][$key],
                    'tmp_name' => $_FILES['album']['tmp_name'][$key]
                ]);
                $this->model->insertAlbum($tour_id, $file_name);
            }
        }

        header('Location: ?action=tours'); exit;
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        $tour = $this->model->find($id);
        $album = $this->model->getAlbum($id);
        require PATH_VIEW.'tours/edit.php';
    }

    public function update() {
        $id = $_POST['id'];
        $data = [
            'ten_tour' => $_POST['ten_tour'],
            'loai_tour' => $_POST['loai_tour'],
            'mo_ta' => $_POST['mo_ta'],
            'gia' => $_POST['gia'],
            'chinh_sach' => $_POST['chinh_sach']
        ];

        if(!empty($_FILES['hinh_anh']['name'])) {
            $data['hinh_anh'] = upload_file('tour', $_FILES['hinh_anh']);
        }

        $this->model->update($id, $data);

        if(!empty($_POST['delete_album'])) {
            foreach($_POST['delete_album'] as $album_id) {
                $this->model->deleteAlbum($album_id);
            }
        }

        if(!empty($_FILES['album']['name'][0])) {
            foreach($_FILES['album']['tmp_name'] as $key => $tmp_name) {
                $file_name = upload_file('tour/album', [
                    'name' => $_FILES['album']['name'][$key],
                    'tmp_name' => $_FILES['album']['tmp_name'][$key]
                ]);
                $this->model->insertAlbum($id, $file_name);
            }
        }

        header('Location: ?action=tours'); exit;
    }

    public function delete() {
        $id = $_GET['id'];
        $this->model->delete($id);
        header('Location: ?action=tours'); exit;
    }
} 
