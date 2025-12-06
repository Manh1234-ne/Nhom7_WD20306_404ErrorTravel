<?php
require_once PATH_MODEL . "Tour.php";
require_once PATH_MODEL . "TourGuest.php";

class TourGuestController
{
    private $tour;
    private $guest;

    public function __construct()
    {
        $this->tour  = new Tour();
        $this->guest = new TourGuest();
    }

    // ===========================
    // HIỂN THỊ DANH SÁCH KHÁCH
    // ===========================
    public function index()
    {
        $tour_id = $_GET['id'] ?? $_GET['tour_id'] ?? null;
        if (!$tour_id) die("Thiếu id tour!");

        $tour   = $this->tour->find($tour_id);
        $guests = $this->guest->getByTour($tour_id);

        require PATH_VIEW . "tour_guest/index.php";
    }

    // ===========================
    // THÊM KHÁCH
    // ===========================
    public function store()
    {
        $tour_id = $_POST['tour_id'] ?? null;
        if (!$tour_id) die("Thiếu tour_id!");

        $this->guest->add($_POST);

        header("Location: ?action=tour_guest&id=" . urlencode($tour_id));
        exit;
    }

    // ===========================
    // CHI TIẾT KHÁCH
    // ===========================
    public function detail()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) die("Thiếu ID khách!");

        $guest = $this->guest->find($id);
        if (!$guest) die("Không tìm thấy khách!");

        $tour = $this->tour->find($guest['tour_id']);

        require PATH_VIEW . "tour_guest/detail.php";
    }

    // ===========================
    // CẬP NHẬT CHECKIN
    // ===========================
    public function updateCheckin()
    {
        $id = $_POST['id'] ?? null;
        $tour_id = $_POST['tour_id'] ?? null;

        if (!$id || !$tour_id) die("Thiếu dữ liệu update checkin!");

        $status = $_POST['trang_thai'] ?? '';
        $this->guest->updateCheckin($id, $status);

        header("Location: ?action=tour_guest&id=" . urlencode($tour_id));
        exit;
    }

    // ===========================
    // CẬP NHẬT PHÒNG
    // ===========================
    public function updateRoom()
    {
        $id = $_POST['id'] ?? null;
        $tour_id = $_POST['tour_id'] ?? null;

        if (!$id || !$tour_id) die("Thiếu dữ liệu update phòng!");

        $room = $_POST['phong'] ?? '';
        $this->guest->updateRoom($id, $room);

        header("Location: ?action=tour_guest&id=" . urlencode($tour_id));
        exit;
    }

    // ===========================
    // EXPORT DANH SÁCH
    // ===========================
    public function export()
    {
        $tour_id = $_GET['id'] ?? $_GET['tour_id'] ?? null;
        if (!$tour_id) die("Thiếu ID tour!");

        $tour   = $this->tour->find($tour_id);
        $guests = $this->guest->export($tour_id);

        require PATH_VIEW . "tour_guest/export.php";
    }
}
