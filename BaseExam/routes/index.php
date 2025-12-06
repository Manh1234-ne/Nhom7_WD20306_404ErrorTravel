<?php
require_once __DIR__ . '/../configs/env.php';
require_once PATH_CONTROLLER . 'HomeController.php';
require_once PATH_CONTROLLER . 'TourController.php';
require_once PATH_CONTROLLER . 'NhanSuController.php';
require_once PATH_CONTROLLER . 'DanhMucTourController.php';
require_once PATH_CONTROLLER . 'TourGuestController.php';

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

    // NHÂN SỰ
    'nhansu' => (new NhanSuController)->index(),
    'nhansu_add' => (new NhanSuController)->add(),
    'nhansu_add_post' => (new NhanSuController)->store(),
    'nhansu_edit' => (new NhanSuController)->edit(),
    'nhansu_edit_post' => (new NhanSuController)->update(),
    'nhansu_delete' => (new NhanSuController)->delete(),

    // DANH MỤC
    'danhmuc' => (new DanhMucTourController)->index(),
    'danhmuc_add' => (new DanhMucTourController)->add(),
    'danhmuc_add_post' => (new DanhMucTourController)->store(),
    'danhmuc_edit' => (new DanhMucTourController)->edit(),
    'danhmuc_edit_post' => (new DanhMucTourController)->update(),
    'danhmuc_delete' => (new DanhMucTourController)->delete(),

    // TOUR GUEST (Chi tiết tour)
    'tour_guest'          => (new TourGuestController)->index(),
    'tour_guest_add'      => (new TourGuestController)->store(),
    'tour_guest_detail'   => (new TourGuestController)->detail(),
    'tour_guest_checkin'  => (new TourGuestController)->updateCheckin(),
    'tour_guest_room'     => (new TourGuestController)->updateRoom(),
    'tour_guest_export'   => (new TourGuestController)->export(),

    // Mặc định
    default => (new HomeController)->index(),
};
