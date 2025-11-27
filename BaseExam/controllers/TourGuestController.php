<?php
require_once PATH_MODEL . "Tour.php";
require_once PATH_MODEL . "TourGuest.php";

class TourGuestController {
    
    private $tour;
    private $guest;
    
    public function __construct() {
        $this->tour  = new Tour();
        $this->guest = new TourGuest();
    }

    // Danh sách khách theo tour
    public function index() {
        $tour_id = $_GET['tour_id'];
        $tour = $this->tour->find($tour_id);
        $guests = $this->guest->getByTour($tour_id);

        require PATH_VIEW . "tour_guest/index.php";
    }

    // Lưu khách + hiển thị trang success
    public function store() {
        $id = $this->guest->add($_POST);

        // Lấy tour để hiển thị trong success view
        $tour = $this->tour->find($_POST['tour_id']);

        require PATH_VIEW . "tour_guest/success.php";
    }

    // Chi tiết khách
    public function detail() {
        $id = $_GET['id'];
        $guest = $this->guest->find($id);
        $tour  = $this->tour->find($guest['tour_id']);

        require PATH_VIEW . "tour_guest/detail.php";
    }

    // Check-in cập nhật trạng thái
    public function updateCheckin() {
        $id = $_POST['id'];
        $status = $_POST['trang_thai'];

        $this->guest->updateCheckin($id, $status);

        header("Location: ?action=tour_guest&tour_id=" . $_GET['tour_id']);
    }

    // Cập nhật phòng
    public function updateRoom() {
        $id = $_POST['id'];
        $room = $_POST['phong'];

        $this->guest->updateRoom($id, $room);

        header("Location: ?action=tour_guest&tour_id=" . $_GET['tour_id']);
    }

    // In danh sách đoàn
    public function export() {
        $tour_id = $_GET['tour_id'];
        $tour = $this->tour->find($tour_id);
        $guests = $this->guest->export($tour_id);

        require PATH_VIEW . "tour_guest/export.php";
    }
}