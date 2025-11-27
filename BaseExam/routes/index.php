<?php
require_once __DIR__ . '/../configs/env.php';
<<<<<<< HEAD
=======

// Controller
>>>>>>> d4da81ffadf928a5503fd8f3e4d87b0586e1186b
require_once PATH_CONTROLLER . 'HomeController.php';
require_once PATH_CONTROLLER . 'TourController.php';
require_once PATH_CONTROLLER . 'NhanSuController.php';
require_once PATH_CONTROLLER . 'DanhMucTourController.php';
require_once PATH_CONTROLLER . 'NguoiDungController.php';
<<<<<<< HEAD
require_once PATH_CONTROLLER . 'QlBookingController.php';
require_once PATH_CONTROLLER . 'YeuCauController.php';

$action = $_GET['action'] ?? 'home';
=======
require_once PATH_CONTROLLER . 'YeuCauController.php';
require_once PATH_CONTROLLER . 'BookingController.php'; // nếu có

$action = $_GET['action'] ?? 'home';
$id = $_GET['id'] ?? null;
>>>>>>> d4da81ffadf928a5503fd8f3e4d87b0586e1186b

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

<<<<<<< HEAD

    // NHÂN SỰ (HƯỚNG DẪN VIÊN)
=======
    // QLBOOKING
    'qlbooking' => (new QlBookingController)->index(),
    'qlbooking_edit' => (new QlbookingController)->edit(),
    'qlbooking_edit_post' => (new QlBookingController)->update(),
    'qlbooking_detail' => (new QlBookingController)->detail(),

    // NHÂN SỰ
>>>>>>> d4da81ffadf928a5503fd8f3e4d87b0586e1186b
    'nhansu' => (new NhanSuController)->index(),
    'nhansu_add' => (new NhanSuController)->add(),
    'nhansu_add_post' => (new NhanSuController)->store(),
    'nhansu_edit' => (new NhanSuController)->edit(),
    'nhansu_edit_post' => (new NhanSuController)->update(),
    'nhansu_delete' => (new NhanSuController)->delete(),
<<<<<<< HEAD
    
=======
>>>>>>> d4da81ffadf928a5503fd8f3e4d87b0586e1186b

    // DANH MỤC TOUR
    'danhmuc' => (new DanhMucTourController)->index(),
    'danhmuc_add' => (new DanhMucTourController)->add(),
    'danhmuc_add_post' => (new DanhMucTourController)->store(),
    'danhmuc_edit' => (new DanhMucTourController)->edit(),
    'danhmuc_edit_post' => (new DanhMucTourController)->update(),
    'danhmuc_delete' => (new DanhMucTourController)->delete(),

    // LOGIN - LOGOUT
<<<<<<< HEAD
    // 'registerForm'=> (new NguoiDungController)->registerForm(),
    // 'register'=> (new NguoiDungController)->register(),
    'loginForm'=> (new NguoiDungController)->loginForm(),
    'login'=> (new NguoiDungController)->login(),
    'logout'=> (new NguoiDungController)->logout(),

    // QLBOOKING
    'qlbooking' => (new QlBookingController)->index(),
    'qlbooking_edit' => (new QlBookingController)->edit(),
    'qlbooking_edit_post' => (new QlBookingController)->update(),
    'qlbooking_delete' => (new QlBookingController)->delete(),



    
    // Quản lý khách theo tour
    "tour_guest"         => (new TourGuestController)->index(),
    "tour_guest_store"   => (new TourGuestController)->store(),
    "guest_detail"       => (new TourGuestController)->detail(),
    "tour_guest_checkin" => (new TourGuestController)->updateCheckin(),
    "tour_guest_room"    => (new TourGuestController)->updateRoom(),
    "tour_guest_export"  => (new TourGuestController)->export(),



=======
    'loginForm' => (new NguoiDungController)->loginForm(),
    'login' => (new NguoiDungController)->login(),
    'logout' => (new NguoiDungController)->logout(),

    // ====================== YÊU CẦU ĐẶC BIỆT ======================
>>>>>>> d4da81ffadf928a5503fd8f3e4d87b0586e1186b
    'yeu_cau' => (new YeuCauController)->index(),
    'yeu_cau_create' => (new YeuCauController)->create(),
    'yeu_cau_store' => (new YeuCauController)->store(),          // Lưu yêu cầu mới
    // 'yeu_cau_edit' => fn() => (new YeuCauController)->edit($id),
<<<<<<< HEAD
    'yeu_cau_update' => fn() => (new YeuCauController)->update($id),
    'yeu_cau_delete' => fn() => (new YeuCauController)->delete($id),
    'yeu_cau_show' => fn() => (new YeuCauController)->show($id),

    // Mặc định
    default => (new HomeController)->index(),
};
=======
    'yeu_cau_update' => fn() => (new YeuCauController)->update($_GET['id']),
    'yeu_cau_delete' => fn() => (new YeuCauController)->delete($_GET['id']),
    'yeu_cau_show' => fn() => (new YeuCauController)->show($_GET['id']),

    // Quản lý khách theo tour
    "tour_guest"         => (new TourGuestController)->index(),
    "tour_guest_store"   => (new TourGuestController)->store(),
    "guest_detail"       => (new TourGuestController)->detail(),
    "tour_guest_checkin" => (new TourGuestController)->updateCheckin(),
    "tour_guest_room"    => (new TourGuestController)->updateRoom(),
    "tour_guest_export"  => (new TourGuestController)->export(),

    // Mặc định
    default => (new HomeController)->index(),
};
>>>>>>> d4da81ffadf928a5503fd8f3e4d87b0586e1186b
