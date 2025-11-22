<?php
require_once __DIR__ . '/../configs/env.php';
require_once PATH_CONTROLLER . 'HomeController.php';
require_once PATH_CONTROLLER . 'TourController.php';
require_once PATH_CONTROLLER . 'NhanSuController.php';
require_once PATH_CONTROLLER . 'DanhMucTourController.php';
require_once PATH_CONTROLLER . 'NguoiDungController.php';

$action = $_GET['action'] ?? 'home';

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


    // NHÂN SỰ (HƯỚNG DẪN VIÊN)
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
    // 'registerForm'=> (new NguoiDungController)->registerForm(),
    // 'register'=> (new NguoiDungController)->register(),
    'loginForm'=> (new NguoiDungController)->loginForm(),
    'login'=> (new NguoiDungController)->login(),
    'logout'=> (new NguoiDungController)->logout(),

    // Mặc định
    default => (new HomeController)->index(),
};