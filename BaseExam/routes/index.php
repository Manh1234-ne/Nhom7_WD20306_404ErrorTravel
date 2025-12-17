<?php
require_once __DIR__ . '/../configs/env.php';

// Controller
require_once PATH_CONTROLLER . 'HomeController.php';
require_once PATH_CONTROLLER . 'TourController.php';
require_once PATH_CONTROLLER . 'NhanSuController.php';
require_once PATH_CONTROLLER . 'DanhMucTourController.php';
require_once PATH_CONTROLLER . 'TourGuestController.php';
require_once PATH_CONTROLLER . 'NguoiDungController.php';
require_once PATH_CONTROLLER . 'YeuCauController.php';
require_once PATH_CONTROLLER . 'BookingController.php';
require_once PATH_CONTROLLER . 'QlBookingController.php';
// require_once PATH_CONTROLLER . 'GuestListController.php';
require_once PATH_CONTROLLER . 'BookingController.php'; // nếu có
require_once PATH_CONTROLLER . 'QlBookingController.php';
require_once PATH_CONTROLLER . 'YeuCauController.php';

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
  // Accept both 'tour_detail' and 'detail' for compatibility
  'tour_detail' => (new TourController)->detail(),
  'detail' => (new TourController)->detail(),
  'dat_tour' => (new BookingController)->create(),
  'save_booking' => (new BookingController)->save(),
  'tour_detail' => (new TourController)->detail(),
  'detail' => (new TourController)->detail(),

  // BOOKING
  'dat_tour' => (new BookingController)->create(),
  'save_booking' => (new BookingController)->save(),


  // QLBOOKING
  'qlbooking' => (new QlBookingController)->index(),
  'qlbooking_edit' => (new QlBookingController)->edit(),
  'qlbooking_edit_post' => (new QlBookingController)->update(),
  'qlbooking_detail' => (new QlBookingController)->detail(),
  'qlbooking_pay' => (new QlBookingController)->pay(),
  'qlbooking_pay_post' => (new QlBookingController)->paySubmit(),
  'qlbooking_phan_cong' => (new QlBookingController)->phanCongHDV(),

  // TOUR GUEST (từ file 1)
  'tour_guest'          => (new TourGuestController)->index(),
  'tour_guest_add'      => (new TourGuestController)->store(),
  'tour_guest_detail'   => (new TourGuestController)->detail(),
  'tour_guest_checkin'  => (new TourGuestController)->updateCheckin(),
  'tour_guest_room'     => (new TourGuestController)->updateRoom(),
  'tour_guest_export'   => (new TourGuestController)->export(),

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
  'yeu_cau_store' => (new YeuCauController)->store(),
  'yeu_cau_update' => fn() => (new YeuCauController)->update($id),
  'yeu_cau_delete' => fn() => (new YeuCauController)->delete($id),
  'yeu_cau_show' => fn() => (new YeuCauController)->show($id),

  // // // GUEST LIST MANAGEMENT (Sidebar mới)
  // // 'guest_list_management' => (new GuestListController)->index(),
  // // 'guest_list_import' => (new GuestListController)->import(),
  // // Quản lý khách theo tour
  // "tour_guest" => (new TourGuestController)->index(),
  // "tour_guest_store" => (new TourGuestController)->store(),
  // "guest_detail" => (new TourGuestController)->detail(),
  // "tour_guest_checkin" => (new TourGuestController)->updateCheckin(),
  // "tour_guest_room" => (new TourGuestController)->updateRoom(),
  // "tour_guest_export" => (new TourGuestController)->export(),
  // // 'registerForm'=> (new NguoiDungController)->registerForm(),
  // // 'register'=> (new NguoiDungController)->register(),
  // 'loginForm'=> (new NguoiDungController)->loginForm(),
  // 'login'=> (new NguoiDungController)->login(),
  // 'logout'=> (new NguoiDungController)->logout(),

  // QLBOOKING
  'qlbooking' => (new QlBookingController)->index(),
  'qlbooking_edit' => (new QlbookingController)->edit(),
  'qlbooking_edit_post' => (new QlBookingController)->update(),
  'qlbooking_detail' => (new QlBookingController)->detail(),
  'qlbooking_pay' => (new QlBookingController)->pay(),
  'qlbooking_pay_post' => (new QlBookingController)->paySubmit(),
  // DOWNLOAD FILE BOOKING (EXCEL)
  'download-booking-file' => (new BookingController)->download(),




  'yeu_cau' => (new YeuCauController)->index(),
  'yeu_cau_create' => (new YeuCauController)->create(),
  'yeu_cau_store' => (new YeuCauController)->store(),          // Lưu yêu cầu mới
  // 'yeu_cau_edit' => fn() => (new YeuCauController)->edit($id),
  'yeu_cau_update' => fn() => (new YeuCauController)->update($id),
  'yeu_cau_delete' => fn() => (new YeuCauController)->delete($id),
  'yeu_cau_show' => fn() => (new YeuCauController)->show($id),

  // Mặc định
  default => (new HomeController)->index(),
};