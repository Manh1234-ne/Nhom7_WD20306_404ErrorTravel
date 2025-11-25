<?php
// controllers/AlbumController.php
require_once __DIR__ . '/../models/AlbumModel.php';

class AlbumController
{
    protected $db;
    protected $model;
    protected $uploadBase; // đường dẫn folder upload trên server
    protected $uploadWebPath; // đường dẫn web (relative) tới assets/uploads/albums

    public function __construct($db)
    {
        $this->db = $db;
        $this->model = new AlbumModel($db);
        // local path (adjust if your project root differs)
        $this->uploadBase = __DIR__ . '/../assets/uploads/albums/';
        $this->uploadWebPath = '/assets/uploads/albums/'; // dùng khi render URL (có thể cần ./ or base path)
        if (!file_exists($this->uploadBase)) {
            mkdir($this->uploadBase, 0755, true);
        }
    }

    public function index()
    {
        $albums = $this->model->getAllAlbums();
        require __DIR__ . '/../views/albums/index.php';
    }

    public function create()
    {
        // show create form
        require __DIR__ . '/../views/albums/create.php';
    }

    public function store()
    {
        // process POST create album + multiple uploads
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';

        $albumId = $this->model->createAlbum($title, $description);

        // create album folder
        $albumFolder = $this->uploadBase . $albumId . '/';
        if (!file_exists($albumFolder))
            mkdir($albumFolder, 0755, true);

        // handle files (input name="images[]")
        if (!empty($_FILES['images'])) {
            $files = $_FILES['images'];
            $count = count($files['name']);
            for ($i = 0; $i < $count; $i++) {
                if ($files['error'][$i] === UPLOAD_ERR_OK) {
                    $tmp = $files['tmp_name'][$i];
                    $origName = $files['name'][$i];
                    $mime = mime_content_type($tmp);
                    $size = filesize($tmp);

                    // validate
                    $allowed = ['image/png', 'image/jpeg', 'image/gif', 'image/webp'];
                    if (!in_array($mime, $allowed))
                        continue;

                    // safe filename
                    $ext = pathinfo($origName, PATHINFO_EXTENSION);
                    $safe = uniqid() . '.' . $ext;
                    $dest = $albumFolder . $safe;
                    if (move_uploaded_file($tmp, $dest)) {
                        // store relative path: albumId/filename
                        $this->model->addImage($albumId, $albumId . '/' . $safe, $origName, $mime, $size);
                    }
                }
            }
        }

        // redirect to album list or detail
        header('Location: index.php?controller=albums&action=index');
        exit;
    }

    public function show()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?controller=albums&action=index');
            exit;
        }
        $album = $this->model->getAlbum($id);
        $images = $this->model->getImages($id);
        require __DIR__ . '/../views/albums/detail.php';
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?controller=albums&action=index');
            exit;
        }
        $album = $this->model->getAlbum($id);
        $images = $this->model->getImages($id);
        require __DIR__ . '/../views/albums/edit.php';
    }

    public function update()
    {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: index.php?controller=albums&action=index');
            exit;
        }
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $this->model->updateAlbum($id, $title, $description);

        // same upload handling as store
        $albumFolder = $this->uploadBase . $id . '/';
        if (!file_exists($albumFolder))
            mkdir($albumFolder, 0755, true);

        if (!empty($_FILES['images'])) {
            $files = $_FILES['images'];
            $count = count($files['name']);
            for ($i = 0; $i < $count; $i++) {
                if ($files['error'][$i] === UPLOAD_ERR_OK) {
                    $tmp = $files['tmp_name'][$i];
                    $origName = $files['name'][$i];
                    $mime = mime_content_type($tmp);
                    $size = filesize($tmp);

                    $allowed = ['image/png', 'image/jpeg', 'image/gif', 'image/webp'];
                    if (!in_array($mime, $allowed))
                        continue;

                    $ext = pathinfo($origName, PATHINFO_EXTENSION);
                    $safe = uniqid() . '.' . $ext;
                    $dest = $albumFolder . $safe;
                    if (move_uploaded_file($tmp, $dest)) {
                        $this->model->addImage($id, $id . '/' . $safe, $origName, $mime, $size);
                    }
                }
            }
        }

        header('Location: index.php?controller=albums&action=edit&id=' . $id);
        exit;
    }

    public function deleteImage()
    {
        // delete image by id (AJAX or POST)
        $imgId = $_POST['image_id'] ?? null;
        if (!$imgId) {
            echo json_encode(['success' => false, 'msg' => 'Missing image id']);
            exit;
        }
        // get filename first
        $sql = "SELECT filename FROM album_images WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $imgId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $filepath = $this->uploadBase . $row['filename'];
            if (file_exists($filepath))
                unlink($filepath);
        }
        $this->model->deleteImage($imgId);
        echo json_encode(['success' => true]);
        exit;
    }

    public function destroy()
    {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: index.php?controller=albums&action=index');
            exit;
        }
        // remove folder + files
        $folder = $this->uploadBase . $id . '/';
        if (is_dir($folder)) {
            $files = glob($folder . '*', GLOB_MARK);
            foreach ($files as $f) {
                if (is_file($f))
                    unlink($f);
            }
            rmdir($folder);
        }
        $this->model->deleteAlbum($id);
        header('Location: index.php?controller=albums&action=index');
        exit;
    }
}
