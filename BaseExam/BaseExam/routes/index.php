<?php
require_once __DIR__ . '/../configs/env.php';
require_once PATH_CONTROLLER.'TourController.php';
require_once PATH_CONTROLLER.'NhanSuController.php';
require_once PATH_CONTROLLER.'HomeController.php';

$action = $_GET['action'] ?? 'home';

$func = match ($action) {
    'home' => fn() => (new HomeController)->index(),
    'tours' => fn() => (new TourController)->index(),
    'tour_add' => fn() => (new TourController)->add(),
    'tour_add_post' => fn() => (new TourController)->store(),
    'tour_edit' => fn() => (new TourController)->edit(),
    'tour_edit_post' => fn() => (new TourController)->update(),
    'tour_delete' => fn() => (new TourController)->delete(),
    'nhansu' => fn() => (new NhanSuController)->index(),
    'nhansu_add' => fn() => (new NhanSuController)->add(),
    'nhansu_add_post' => fn() => (new NhanSuController)->store(),
    'nhansu_edit' => fn() => (new NhanSuController)->store(),
    'nhansu_edit_post' => fn() => (new NhanSuController)->update(),
    'nhansu_delete' => fn() => (new NhanSuController)->delete(),
    default => fn() => (new HomeController)->index(),
};

$func(); // gọi closure