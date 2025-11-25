<?php
require_once __DIR__ . '/../configs/env.php';

// Controller
require_once PATH_CONTROLLER . 'HomeController.php';
require_once PATH_CONTROLLER . 'TourController.php';
require_once PATH_CONTROLLER . 'NhanSuController.php';
require_once PATH_CONTROLLER . 'DanhMucTourController.php';
require_once PATH_CONTROLLER . 'NguoiDungController.php';
require_once PATH_CONTROLLER . 'YeuCauController.php';
require_once PATH_CONTROLLER . 'BookingController.php'; // nếu có

$action = $_GET['action'] ?? 'home';
$id = $_GET['id'] ?? null;

match ($action) {
    // Trang chủ
    'home' => (new HomeController)->index(),

    // TOUR
    'tours' => (new TourController)->index(),
    'tour_add' => (new TourController)->add(),
    'tour_add_post' => (new TourController)->store(),
    'tour_edit' => (new TourController)->edit(),
    'tour_edit_post' => (new TourController)->update(),
    'tour_delete' => (new TourController)->delete(),
    'tour_detail' => (new TourController)->detail(),
    'dat_tour' => (new BookingController)->create(),
    'save_booking' => (new BookingController)->save(),

    // QLBOOKING
    'qlbooking' => (new QlBookingController)->index(),
    'qlbooking_edit' => (new QlbookingController)->edit(),
    'qlbooking_edit_post' => (new QlBookingController)->update(),

    // NHÂN SỰ
    'nhansu' => (new NhanSuController)->index(),
    'nhansu_add' => (new NhanSuController)->add(),
    'nhansu_add_post' => (new NhanSuController)->store(),
    'nhansu_edit' => (new NhanSuController)->edit(),
    'nhansu_edit_post' => (new NhanSuController)->update(),
    'nhansu_delete' => (new NhanSuController)->delete(),

    // DANH MỤC TOUR
    'danhmuc' => (new DanhMucTourController)->index(),
    'danhmuc_add' => (new DanhMucTourController)->add(),
    'danhmuc_add_post' => (new DanhMucTourController)->store(),
    'danhmuc_edit' => (new DanhMucTourController)->edit(),
    'danhmuc_edit_post' => (new DanhMucTourController)->update(),
    'danhmuc_delete' => (new DanhMucTourController)->delete(),

    // LOGIN - LOGOUT
    'loginForm' => (new NguoiDungController)->loginForm(),
    'login' => (new NguoiDungController)->login(),
    'logout' => (new NguoiDungController)->logout(),

    // ====================== YÊU CẦU ĐẶC BIỆT ======================
    'yeu_cau' => (new YeuCauController)->index(),
    'yeu_cau_create' => (new YeuCauController)->create(),
    'yeu_cau_store' => (new YeuCauController)->store(),          // Lưu yêu cầu mới
    // 'yeu_cau_edit' => fn() => (new YeuCauController)->edit($id),
    'yeu_cau_update' => fn() => (new YeuCauController)->update($_GET['id']),
    'yeu_cau_delete' => fn() => (new YeuCauController)->delete($_GET['id']),
    'yeu_cau_show' => fn() => (new YeuCauController)->show($_GET['id']),

    // Mặc định
    default => (new HomeController)->index(),
};
