<?php 

session_start();

// Danh sách các action KHÔNG cần đăng nhập
$allow_guest = ['loginForm', 'login', 'home'];

$action = $_GET['action'] ?? 'home';

// Nếu chưa đăng nhập -> hiển thị trang login + thông báo
if (!isset($_SESSION['user']) && !in_array($action, $allow_guest)) {

    // Ghi vào SESSION để login.php nhận được
    $_SESSION['flash_success'] = "Bạn chưa đăng nhập. Vui lòng đăng nhập để sử dụng chức năng.";

    // Gọi thẳng giao diện login (KHÔNG redirect)
    $errors_str = [];
    $old = [];
    require_once __DIR__ . '/views/auth/login.php';
    exit;
}

spl_autoload_register(function ($class) {    
    $fileName = "$class.php";

    $fileModel              = PATH_MODEL . $fileName;
    $fileController         = PATH_CONTROLLER . $fileName;

    if (is_readable($fileModel)) {
        require_once $fileModel;
    } 
    else if (is_readable($fileController)) {
        require_once $fileController;
    }
});

require_once './configs/env.php';
require_once './configs/helper.php';

// Điều hướng
require_once __DIR__.'/routes/index.php';

?>
