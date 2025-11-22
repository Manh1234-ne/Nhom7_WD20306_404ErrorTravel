<?php
// controllers/NguoiDungController.php
require_once __DIR__ . '/../models/NguoiDung.php';

class NguoiDungController {
    private $model;

    public function __construct() {
        $this->model = new NguoiDung();
        if (session_status() == PHP_SESSION_NONE) session_start();
    }

    // // Hiển thị form đăng ký
    // public function registerForm() {
    //     require_once __DIR__ . '/../views/auth/register.php';
    // }

    // // Xử lý POST đăng ký
    // public function register() {
    //     $ho_ten = trim($_POST['ho_ten'] ?? '');
    //     $ten_dang_nhap = trim($_POST['ten_dang_nhap'] ?? '');
    //     $mat_khau = $_POST['mat_khau'] ?? '';
    //     $mat_khau_confirm = $_POST['mat_khau_confirm'] ?? '';
    //     $email = trim($_POST['email'] ?? '');
    //     $so_dien_thoai = trim($_POST['so_dien_thoai'] ?? '');

    //     $errors = [];

    //     if (strlen($ten_dang_nhap) < 3) $errors[] = "Tên đăng nhập ít nhất 3 ký tự.";
    //     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email không hợp lệ.";
    //     if (strlen($mat_khau) < 6) $errors[] = "Mật khẩu ít nhất 6 ký tự.";
    //     if ($mat_khau !== $mat_khau_confirm) $errors[] = "Mật khẩu xác nhận không khớp.";

    //     if ($this->model->findByUsername($ten_dang_nhap)) $errors[] = "Tên đăng nhập đã tồn tại.";
    //     if ($this->model->findByEmail($email)) $errors[] = "Email đã được sử dụng.";

    //     if (!empty($errors)) {
    //         $errors_str = $errors;
    //         $old = $_POST;
    //         require_once __DIR__ . '/../views/auth/register.php';
    //         return;
    //     }

    //     $hash = password_hash($mat_khau, PASSWORD_DEFAULT);
    //     $ok = $this->model->create([
    //         'ho_ten' => $ho_ten,
    //         'ten_dang_nhap' => $ten_dang_nhap,
    //         'mat_khau' => $hash,
    //         'email' => $email,
    //         'so_dien_thoai' => $so_dien_thoai,
    //         'vai_tro' => 0
    //     ]);

    //     if ($ok) {
    //         $_SESSION['flash_success'] = "Đăng ký thành công. Vui lòng đăng nhập.";
    //         header("Location: index.php?action=loginForm");
    //         exit;
    //     } else {
    //         $errors_str = ["Lỗi khi lưu dữ liệu. Vui lòng thử lại."];
    //         $old = $_POST;
    //         require_once __DIR__ . '/../views/auth/register.php';
    //         return;
    //     }
    // }

    // Hiển thị form đăng nhập
    public function loginForm() {
        $old = $_POST ?? [];
        $flash = $_SESSION['flash_success'] ?? null;
        if ($flash) unset($_SESSION['flash_success']);
        require_once __DIR__ . '/../views/auth/login.php';
    }

    // Xử lý POST đăng nhập
    public function login() {
        $username_or_email = trim($_POST['username_or_email'] ?? '');
        $mat_khau = $_POST['mat_khau'] ?? '';

        $errors = [];
        if (empty($username_or_email) || empty($mat_khau)) {
            $errors[] = "Vui lòng nhập đầy đủ thông tin.";
            $errors_str = $errors;
            $old = $_POST;
            require_once __DIR__ . '/../views/auth/login.php';
            return;
        }

        $user = $this->model->findByUsername($username_or_email);
        if (!$user) $user = $this->model->findByEmail($username_or_email);

        if (!$user || !password_verify($mat_khau, $user['mat_khau'])) {
            $errors_str = ["Tên đăng nhập/email hoặc mật khẩu không đúng."];
            $old = $_POST;
            require_once __DIR__ . '/../views/auth/login.php';
            return;
        }

        // Lưu session (chỉ lưu những gì cần thiết)
        $_SESSION['user'] = [
            'id' => $user['id'],
            'ho_ten' => $user['ho_ten'],
            'ten_dang_nhap' => $user['ten_dang_nhap'],
            'email' => $user['email'],
            'vai_tro' => $user['vai_tro']
        ];
        $_SESSION['flash_success'] = "Đăng nhập thành công.";

        header("Location: index.php?action=home");
        exit;
    }

    // Đăng xuất
    public function logout() {
        session_start();
        unset($_SESSION['user']);
        session_destroy();
        header("Location: index.php?action=home");
        exit;
    }
}
