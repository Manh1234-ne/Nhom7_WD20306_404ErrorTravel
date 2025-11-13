<?php
function db_connect() {
    try {
        $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USERNAME, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        die("Lỗi kết nối DB: ".$e->getMessage());
    }
}

function debug($data) {
    echo '<pre>'; print_r($data); die;
}

function upload_file($folder, $file) {
    $dir = PATH_ASSETS_UPLOADS . $folder;
    if(!file_exists($dir)) mkdir($dir, 0777, true);
    $targetFile = $folder . '/' . time() . '-' . basename($file["name"]);
    if(move_uploaded_file($file["tmp_name"], PATH_ASSETS_UPLOADS . $targetFile)) {
        return $targetFile;
    }
    throw new Exception('Upload file không thành công!');
}
