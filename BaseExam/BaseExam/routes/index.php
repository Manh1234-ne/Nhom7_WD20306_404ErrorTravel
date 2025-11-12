<?php
require_once __DIR__ . '/../configs/env.php';
require_once PATH_CONTROLLER . 'HomeController.php';
require_once PATH_CONTROLLER . 'TourController.php';
require_once PATH_CONTROLLER . 'NhanSuController.php';

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

    // NHÂN SỰ (HƯỚNG DẪN VIÊN)
    'nhansu' => (new NhanSuController)->index(),
    'nhansu_add' => (new NhanSuController)->add(),
    'nhansu_add_post' => (new NhanSuController)->store(),
    'nhansu_edit' => (new NhanSuController)->edit(),
    'nhansu_edit_post' => (new NhanSuController)->update(),
    'nhansu_delete' => (new NhanSuController)->delete(),

    // Mặc định
    default => (new HomeController)->index(),
};
